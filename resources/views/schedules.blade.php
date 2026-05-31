@extends('layouts.app')

@section('title', 'Horarios')

@section('content')
<div class="admin-container">
    
    <div class="admin-toolbar">
        <div>
            <h1 class="dash-title" style="font-size: 2.2rem; margin-bottom: 0;">Tabla de <span>Horarios</span></h1>
        </div>
        
        <div class="admin-actions">
            <input type="text" class="field-input search-input" placeholder="Buscar horario...">
            <a href="{{ route('schedules.create') }}" class="btn btn-fill" style="text-decoration: none;"><span>+</span> Nuevo Horario</a>
        </div>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Curso</th>
                    <th>Día</th>
                    <th>Horas</th>
                    <th>Aula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $horario)
                <tr>
                    <td style="color:var(--muted);">{{ $horario->id }}</td>
                    
                    <td>
                        <span style="font-weight: 600;">{{ $horario->course->name_course ?? 'Curso no asignado' }}</span>
                    </td>
                    
                    <td>
                        <span class="dash-row-badge" style="background: rgba(167,139,250,.09); color: var(--accent);">
                            {{ $horario->day_of_week }}
                        </span>
                    </td>
                    
                    <td style="color:var(--muted);">
                        {{ \Carbon\Carbon::parse($horario->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($horario->end_time)->format('H:i') }}
                    </td>
                    
                    <td style="color:var(--muted);">
                        {{ $horario->classroom_nro }}
                    </td>
                    
                    <td>
                        <a href="{{ route('schedules.edit', $horario->id) }}" class="btn btn-line btn-sm" style="color: #3b82f6; border-color: rgba(59,130,246,.3); text-decoration: none; margin-right: 0.5rem;">Editar</a>

                        <button type="button" onclick="openModal({{ $horario->id }}, 'schedules')" class="btn btn-line btn-sm" style="color: #f87171; border-color: rgba(248,113,113,.3);">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem; color: var(--muted);">
                        No hay horarios registrados en el sistema.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <h3>¿Eliminar horario?</h3>
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