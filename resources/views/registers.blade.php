@extends('layouts.app')

@section('title', 'Matrículas')

@section('content')
<div class="admin-container">
    
    <div class="admin-toolbar">
        <div>
            <h1 class="dash-title" style="font-size: 2.2rem; margin-bottom: 0;">Tabla de <span>Matrículas</span></h1>
        </div>
        
        <div class="admin-actions">
            <input type="text" class="field-input search-input" placeholder="Buscar matrícula...">
            <a href="{{ route('registers.create') }}" class="btn btn-fill" style="text-decoration: none;"><span>+</span> Nueva Matrícula</a>
        </div>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estudiante</th>
                    <th>Curso</th>
                    <th>Profesor</th>
                    <th>Horario</th>
                    <th>Fecha Registro</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registers as $registro)
                <tr>
                    <td style="color:var(--muted);">{{ $registro->id }}</td>
                    
                    <td>
                        <div class="user-cell">
                            <div class="avatar">{{ substr($registro->student->first_name ?? 'S', 0, 1) }}</div>
                            <div class="user-info">
                                <span class="user-name" style="font-weight: 600;">
                                    {{ $registro->student->first_name ?? 'No asignado' }} {{ $registro->student->last_name ?? '' }}
                                </span>
                            </div>
                        </div>
                    </td>
                    
                    <td>
                        <span style="font-weight: 500;">{{ $registro->course->name_course ?? 'No asignado' }}</span>
                    </td>

                    <td style="color:var(--muted);">
                        {{ $registro->teacher->first_name ?? 'Sin asignar' }} {{ $registro->teacher->last_name ?? '' }}
                    </td>

                    <td>
                        <span class="dash-row-badge" style="background: rgba(59,130,246,.1); color: #3b82f6;">
                            {{ $registro->schedule->day ?? 'Sin horario' }} - {{ $registro->schedule->time ?? '' }}
                        </span>
                    </td>
                    
                    <td style="color:var(--muted);">{{ $registro->registration_date }}</td>
                    
                    <td>
                        <span class="dash-row-badge" style="background: rgba(167,139,250,.09); color: var(--accent);">
                            {{ $registro->status }}
                        </span>
                    </td>
                    
                    <td>
                        <a href="{{ route('registers.edit', $registro->id) }}" class="btn btn-line btn-sm" style="color: #3b82f6; border-color: rgba(59,130,246,.3); text-decoration: none; margin-right: 0.5rem;">Editar</a>
                        <button type="button" onclick="openModal({{ $registro->id }}, 'registers')" class="btn btn-line btn-sm" style="color: #f87171; border-color: rgba(248,113,113,.3);">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 2rem; color: var(--muted);">
                        No hay matrículas registradas en el sistema.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <h3>¿Eliminar matrícula?</h3>
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