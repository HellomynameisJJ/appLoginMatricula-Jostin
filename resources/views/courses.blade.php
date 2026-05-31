@extends('layouts.app')

@section('title', 'Cursos')

@section('content')
<div class="admin-container">
    
    <div class="admin-toolbar">
        <div>
            <h1 class="dash-title" style="font-size: 2.2rem; margin-bottom: 0;">Tabla de <span>Cursos</span></h1>
        </div>
        
        <div class="admin-actions">
            <input type="text" class="field-input search-input" placeholder="Buscar curso...">
            <a href="{{ route('courses.create') }}" class="btn btn-fill" style="text-decoration: none;"><span>+</span> Agregar Curso</a>
        </div>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Curso</th>
                    <th>Codigo</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Usamos forelse para manejar el caso de vacío --}}
                @forelse($courses as $curso)
                <tr>
                    <td style="color:var(--muted);">{{ $curso->id }}</td>
                    <td>
                        <span class="user-name" style="font-weight: 600;">{{ $curso->name_course }}</span>
                    </td>
                    <td style="color:var(--muted);">{{ $curso->sku }}</td>   
                    <td style="color:var(--muted);">{{ $curso->description ?? 'Sin descripción' }}</td>
                    <td><span class="dash-row-badge">{{ $curso->credits }} Créditos</span></td>
                    <td>
                        <a href="{{ route('courses.edit', $curso->id) }}" class="btn btn-line btn-sm" style="color: #3b82f6; border-color: rgba(59,130,246,.3); text-decoration: none; margin-right: 0.5rem;">Editar</a>

                        <button type="button" onclick="openModal({{ $curso->id }}, 'courses')" class="btn btn-line btn-sm" style="color: #f87171; border-color: rgba(248,113,113,.3);">Eliminar</button>
                    </td>
                </tr>
                @empty
                {{-- Este tr solo aparece si $courses está vacío --}}
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem; color: var(--muted);">
                        No hay cursos registrados en el sistema.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- El modal debe ir FUERA de la tabla y del loop --}}
<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <h3>¿Eliminar curso?</h3>
        <p>Esta acción no se puede deshacer. ¿Estás seguro de continuar?</p>
        <form id="deleteForm" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeModal()" class="btn btn-ghost">Cancelar</button>
            <button type="submit" class="btn btn-line" style="color: #f87171; border-color: #f87171;">Sí, eliminar</button>
        </form>
    </div>
</div>
@endsection