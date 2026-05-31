@extends('layouts.app')

@section('title', 'Profesores')

@section('content')
<div class="admin-container">
    
    <div class="admin-toolbar">
        <div>
            <h1 class="dash-title" style="font-size: 2.2rem; margin-bottom: 0;">Tabla de <span>Profesores</span></h1>
        </div>
        <div class="admin-actions">
            <input type="text" class="field-input search-input" placeholder="Buscar profesor...">
            <button class="btn btn-fill"><span>+</span> Agregar Profesor</button>
        </div>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profesor</th>
                    <th>Especialidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                <tr>
                    <td style="color:var(--muted);">{{ $teacher->id }}</td>
                    <td>
                        <span class="user-name" style="font-weight: 600;">{{ $teacher->first_name }} {{ $teacher->last_name }}</span>
                    </td>
                    <td style="color:var(--muted);">{{ $teacher->specialty ?? 'Sin especialidad' }}</td>
                    <td>
                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-line btn-sm" style="color: #3b82f6; border-color: rgba(59,130,246,.3); text-decoration: none; margin-right: 0.5rem;">Editar</a>

                        <button type="button" onclick="openModal({{ $teacher->id }}, 'teachers')" class="btn btn-line btn-sm" style="color: #f87171; border-color: rgba(248,113,113,.3);">Eliminar</button>
                    </td>
                </tr>
                @empty
                {{-- Este tr solo aparece si $teachers está vacío --}}
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem; color: var(--muted);">
                        No hay profesores registrados en el sistema.
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
        <h3>¿Eliminar profesor?</h3>
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