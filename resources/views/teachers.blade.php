@extends('layouts.admin')

@section('title', 'Profesores')
@section('hero_img', 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1400&auto=format&fit=crop&q=80')
@section('hero_icon', '🧑‍🏫')
@section('hero_title') Cuerpo <em>Docente</em> @endsection
@section('hero_subtitle', 'Gestiona los profesores, sus especialidades y asignaciones de cursos.')

@section('content')
{{-- ── ESTILOS PARA ESTIRAR TODA LA PANTALLA Y VER LOS DATOS ABAJO ── --}}


<div class="admin-container">

    {{-- SI LA RUTA ES 'create', MUESTRA EL FORMULARIO DE REGISTRO RESPECTANDO TU MODELO --}}
    @if(request()->routeIs('teachers.create'))
    <div class="table-card" style="padding: 2rem; margin-bottom: 2rem; border: 1px solid rgba(167,139,250,.2); max-width: 1000px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="margin: 0; color: var(--accent);">✦ Registrar Nuevo Profesor</h3>
            <a href="{{ route('teachers.index') }}" class="btn btn-line btn-sm" style="text-decoration: none;">Volver a la lista</a>
        </div>

        <form method="POST" action="{{ route('teachers.store') }}">
            @csrf
            
            {{-- Fila única: Nombres, Apellidos y Especialidad que coinciden con tu $fillable --}}
            <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="field" style="flex: 1;">
                    <label class="field-label">Nombres</label>
                    <input type="text" name="first_name" class="field-input" placeholder="Ej. Armando" required>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Apellidos</label>
                    <input type="text" name="last_name" class="field-input" placeholder="Ej. Mendoza" required>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Especialidad / Área</label>
                    <input type="text" name="specialty" class="field-input" placeholder="Ej. Desarrollo de Software" required>
                </div>
            </div>

            <button type="submit" class="btn btn-fill">Registrar Profesor</button>
        </form>
    </div>
    @endif

    <div class="prem-toolbar observe" style="width: 100%;">
        <div class="prem-toolbar-left">
            <div>
                <div style="font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:.2rem;">Total de profesores</div>
                <div style="font-size:1.4rem;font-weight:700;letter-spacing:-.03em;color:var(--accent);">{{ count($teachers) }} <span style="font-size:.8rem;color:var(--muted);font-weight:400;">docentes</span></div>
            </div>
        </div>
        <div class="prem-toolbar-right">
            <div class="search-wrap">
                <input type="text" class="field-input search-input" placeholder="Buscar profesor...">
            </div>
            <a href="{{ route('teachers.create') }}" class="btn btn-fill" style="text-decoration: none;"><span>+</span> Añadir profesor</a>
        </div>
    </div>

    {{-- TABLA EXTENDIDA ADAPTADA A TU MODELO --}}
    <div class="table-card observe">
        <div class="table-card-head" style="padding: 1.2rem 1.5rem;">
            <span style="font-size:.75rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);">Directorio docente</span>
            <span class="dash-row-badge">{{ count($teachers) }} profesores</span>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profesor</th>
                    <th>Especialidad</th>
                    <th>F. Inscripción</th>
                    <th style="text-align:right;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                <tr>
                    <td style="color:var(--muted);font-weight:700;">#{{ $teacher->id }}</td>
                    <td>
                        <div class="user-cell">
                            <div class="avatar" style="background:rgba(250,204,21,.07);border-color:rgba(250,204,21,.15);color:#fbbf24;">
                                {{ substr($teacher->first_name, 0, 1) }}
                            </div>
                            <div class="user-info">
                                {{-- Concatenamos first_name y last_name de tu modelo --}}
                                <div class="user-name" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $teacher->first_name }} {{ $teacher->last_name }}</div>
                                <div style="font-size:.72rem;color:var(--muted);">Docente Principal</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="dash-row-badge" style="background:rgba(250,204,21,.07);color:#fbbf24;border-color:rgba(250,204,21,.15);">
                            {{ $teacher->specialty ?? 'Sin especialidad' }}
                        </span>
                    </td>
                    <td style="color:var(--muted); font-size:.85rem; white-space: nowrap;">
                            {{ $teacher->created_at ? $teacher->created_at->format('d/m/Y') : '--' }}
                    </td>
                    <td style="text-align:right; white-space: nowrap;">
                        <button 
                            type="button" 
                            class="btn btn-line btn-sm" 
                            style="color:#3b82f6;border-color:rgba(59,130,246,.3);margin-right:.4rem;"
                            data-id="{{ $teacher->id }}"
                            data-fname="{{ $teacher->first_name }}"
                            data-lname="{{ $teacher->last_name }}"
                            data-specialty="{{ $teacher->specialty }}"
                            onclick="openEditTeacherModal(this, 'teachers')">
                            Editar
                        </button>
                        <button type="button" onclick="openModal({{ $teacher->id }}, 'teachers')" class="btn btn-line btn-sm" style="color:#f87171;border-color:rgba(248,113,113,.3);">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:3rem;color:var(--muted);">
                        <div style="font-size:2rem;margin-bottom:.8rem;">🧑‍🏫</div>
                        No hay profesores registrados en el sistema.
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
        <h3>¿Eliminar profesor?</h3>
        <p>Esta acción no se puede deshacer. El registro del profesor será eliminado permanentemente de la base de datos.</p>
        <form id="deleteForm" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <div class="modal-actions">
                <button type="button" onclick="closeModal()" class="btn btn-ghost">Cancelar</button>
                <button type="submit" class="btn btn-line" style="color:#f87171;border-color:#f87171;">Sí, eliminar</button>
            </div>
        </form>
    </div>
</div>

<div id="editTeacherModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 600px; width: 90%;">
        <div class="modal-icon" style="color: #3b82f6;">✏️</div>
        <h3 style="color: #3b82f6;">Editar Profesor</h3>
        
        <form id="editTeacherForm" method="POST">
            @csrf
            @method('PUT')
            
            <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; text-align: left;">
                <div class="field" style="flex: 1;">
                    <label class="field-label">Nombres</label>
                    <input type="text" id="edit_teacher_fname" name="first_name" class="field-input" required>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Apellidos</label>
                    <input type="text" id="edit_teacher_lname" name="last_name" class="field-input" required>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Especialidad</label>
                    <input type="text" id="edit_teacher_specialty" name="specialty" class="field-input" required>
                </div>
            </div>

            <div class="modal-actions" style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                <button type="button" onclick="closeEditTeacherModal()" class="btn btn-ghost">Cancelar</button>
                <button type="submit" class="btn btn-line" style="color:#3b82f6; border-color:#3b82f6;">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection