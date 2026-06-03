@extends('layouts.admin')

@section('title', 'Cursos')
@section('hero_img', 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1400&auto=format&fit=crop&q=80')
@section('hero_icon', '📚')
@section('hero_title') Catálogo de <em>Cursos</em> @endsection
@section('hero_subtitle', 'Administra los cursos disponibles, sus créditos y descripciones académicas.')

@section('content')
<div class="admin-container" style="max-width:100%;padding:0;">

    {{-- SI LA RUTA ES 'create', SE MUESTRA EL FORMULARIO DE REGISTRO --}}
    @if(request()->routeIs('courses.create'))
    <div class="table-card" style="padding: 2rem; margin-bottom: 2rem; border: 1px solid rgba(167,139,250,.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="margin: 0; color: var(--accent);">✦ Registrar Nuevo Curso</h3>
            <a href="{{ route('courses.index') }}" class="btn btn-line btn-sm" style="text-decoration: none;">Volver a la lista</a>
        </div>

        <form method="POST" action="{{ route('courses.store') }}">
            @csrf
            <div class="field" style="margin-bottom: 1rem;">
                <label class="field-label">Nombre del Curso</label>
                <input type="text" name="name_course" class="field-input" placeholder="Ej. Algorítmica y Estructura de Datos" required>
            </div>
            
            <div class="field" style="margin-bottom: 1rem;">
                <label class="field-label">Código / SKU</label>
                <input type="text" name="sku" class="field-input" placeholder="Ej. INF-102" required>
            </div>
            
            <div class="field" style="margin-bottom: 1rem;">
                <label class="field-label">Créditos</label>
                <input type="number" name="credits" class="field-input" min="1" placeholder="Ej. 4" required>
            </div>

            <div class="field" style="margin-bottom: 1.5rem;">
                <label class="field-label">Descripción del Curso</label>
                <textarea name="description" class="field-input" rows="3" placeholder="Ej. Curso introductorio sobre estructuras de datos..."></textarea>
            </div>

            <button type="submit" class="btn btn-fill">Guardar Curso</button>
        </form>
    </div>
    @endif

    <div class="prem-toolbar observe">
        <div class="prem-toolbar-left">
            <div>
                <div style="font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:.2rem;">Total de cursos</div>
                <div style="font-size:1.4rem;font-weight:700;letter-spacing:-.03em;color:var(--accent);">{{ count($courses) }} <span style="font-size:.8rem;color:var(--muted);font-weight:400;">cursos</span></div>
            </div>
        </div>
        <div class="prem-toolbar-right">
            <div class="search-wrap">
                <input type="text" class="field-input search-input" placeholder="Buscar curso...">
            </div>
            <a href="{{ route('courses.create') }}" class="btn btn-fill" style="text-decoration: none;"><span>+</span> Añadir curso</a>
        </div>
    </div>

    <div class="table-card observe">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código/SKU</th>
                    <th>Nombre del Curso</th>
                    <th>Créditos</th>
                    <th>Descripción</th>
                    <th>F. Creación</th>
                    <th>F. Actualización</th>
                    <th style="text-align:right;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $curso)
                <tr>
                    <td style="color:var(--muted); font-weight: 700;">#{{ $curso->id }}</td>
                    <td><span class="badge">{{ $curso->sku }}</span></td>
                    <td style="font-weight:600;color:var(--text);">{{ $curso->name_course }}</td>
                    <td>{{ $curso->credits }} créditos</td>
                    <td>{{ $curso->description ? Str::limit($curso->description, 60) : '--' }}</td>
                    <td style="color:var(--muted);font-size:.85rem;">{{ $curso->created_at ? $curso->created_at->format('d/m/Y') : '--' }}</td>
                    <td style="color:var(--muted);font-size:.85rem;">{{ $curso->updated_at ? $curso->updated_at->format('d/m/Y') : '--' }}</td>
                    <td style="text-align:right;">
                    <button type="button" 
                        class="btn btn-line btn-sm" 
                        style="color:#3b82f6;border-color:rgba(59,130,246,.3);margin-right:.4rem;"
                        data-id="{{ $curso->id }}"
                        data-name="{{ $curso->name_course }}"
                        data-sku="{{ $curso->sku }}"
                        data-credits="{{ $curso->credits }}"
                        data-desc="{{ $curso->description }}"
                        onclick="openEditCourseModal(this)">
                        Editar
                    </button>
                    
                        <button type="button" onclick="openModal({{ $curso->id }}, 'courses')" class="btn btn-line btn-sm" style="color:#f87171;border-color:rgba(248,113,113,.3);">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:3rem;color:var(--muted);">
                        <div style="font-size:2rem;margin-bottom:.8rem;">📚</div>
                        No hay cursos registrados en el sistema.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-icon">⚠️</div>
        <h3>¿Eliminar curso?</h3>
        <p>Esta acción no se puede deshacer. ¿Estás seguro de continuar?</p>
        <form id="deleteForm" method="POST" style="display:inline;">
            @csrf 
            @method('DELETE')
            <div class="modal-actions">
                <button type="button" onclick="closeModal()" class="btn btn-ghost">Cancelar</button>
                <button type="submit" class="btn btn-line" style="color:#f87171; border-color:#f87171;">Sí, eliminar</button>
            </div>
        </form>
    </div>
</div>

<div id="editCourseModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 600px; width: 90%;">
        <div class="modal-icon" style="color: #3b82f6;">✏️</div>
        <h3 style="color: #3b82f6;">Editar Curso</h3>
        
        <form id="editCourseForm" method="POST">
            @csrf
            @method('PUT')
            
            <div style="display: flex; gap: 1rem; margin-bottom: 1rem; text-align: left;">
                <div class="field" style="flex: 1;">
                    <label class="field-label">Nombre del Curso</label>
                    <input type="text" id="edit_course_name" name="name_course" class="field-input" required>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">SKU <span style="font-size: 0.7rem; color: var(--muted);">(No editable)</span></label>
                    <input type="text" id="edit_course_sku" name="sku" class="field-input" readonly style="opacity: 0.5; cursor: not-allowed; background: rgba(0,0,0,0.2);">
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; text-align: left;">
                <div class="field" style="flex: 0.5;">
                    <label class="field-label">Créditos</label>
                    <input type="number" id="edit_course_credits" name="credits" class="field-input" min="1" required>
                </div>
                <div class="field" style="flex: 1.5;">
                    <label class="field-label">Descripción del Curso</label>
                    <textarea id="edit_course_desc" name="description" class="field-input" rows="2"></textarea>
                </div>
            </div>

            <div class="modal-actions" style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                <button type="button" onclick="closeEditCourseModal()" class="btn btn-ghost">Cancelar</button>
                <button type="submit" class="btn btn-line" style="color:#3b82f6; border-color:#3b82f6;">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection