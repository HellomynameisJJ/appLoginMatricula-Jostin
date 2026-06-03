@extends('layouts.admin')

@section('title', 'Horarios')
@section('hero_img', 'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=1400&auto=format&fit=crop&q=80')
@section('hero_icon', '🗓️')
@section('hero_title') Gestión de <em>Horarios</em> @endsection
@section('hero_subtitle', 'Administra los horarios por curso, día de la semana y aula asignada.')

@section('content')
<div class="admin-container" style="max-width:100%;padding:0;">

    {{-- SI LA RUTA ES 'create', SE MUESTRA EL FORMULARIO DE REGISTRO --}}
    @if(request()->routeIs('schedules.create'))
    <div class="table-card" style="padding: 2rem; margin-bottom: 2rem; border: 1px solid rgba(167,139,250,.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="margin: 0; color: var(--accent);">✦ Registrar Nuevo Horario</h3>
            <a href="{{ route('schedules.index') }}" class="btn btn-line btn-sm" style="text-decoration: none;">Volver a la lista</a>
        </div>

        <form method="POST" action="{{ route('schedules.store') }}">
            @csrf
            <div class="field" style="margin-bottom: 1rem;">
                <label class="field-label">Asignar Curso</label>
                <select name="course_id" class="field-input" style="background: var(--bg); color: var(--text);" required>
                    <option value="">Seleccione un curso...</option>
                    @foreach($courses as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->name_course }} ({{ $curso->sku }})</option>
                    @endforeach
                </select>
            </div>
            <div class="field" style="margin-bottom: 1rem;">
                <label class="field-label">Día de la Semana</label>
                <select name="day_of_week" class="field-input" style="background: var(--bg); color: var(--text);" required>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miércoles">Miércoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sábado">Sábado</option>
                </select>
            </div>
            <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                <div class="field" style="flex: 1;">
                    <label class="field-label">Hora de Inicio</label>
                    <input type="time" name="start_time" class="field-input" required>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Hora de Fin</label>
                    <input type="time" name="end_time" class="field-input" required>
                </div>
            </div>
            <div class="field" style="margin-bottom: 1.5rem;">
                <label class="field-label">Número de Aula</label>
                <input type="text" name="classroom_nro" class="field-input" placeholder="Ej. Aula 402-B" required>
            </div>
            <button type="submit" class="btn btn-fill">Guardar Horario</button>
        </form>
    </div>
    @endif

    <div class="prem-toolbar observe">
        <div class="prem-toolbar-left">
            <div>
                <div style="font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:.2rem;">Total de horarios</div>
                <div style="font-size:1.4rem;font-weight:700;letter-spacing:-.03em;color:var(--accent);">{{ count($schedules) }} <span style="font-size:.8rem;color:var(--muted);font-weight:400;">horarios</span></div>
            </div>
        </div>
        <div class="prem-toolbar-right">
            <div class="search-wrap">
                <input type="text" class="field-input search-input" placeholder="Buscar horario...">
            </div>
            <a href="{{ route('schedules.create') }}" class="btn btn-fill" style="text-decoration: none;"><span>+</span> Añadir horario</a>
        </div>
    </div>

    <div class="table-card observe">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Curso</th>
                    <th>Día</th>
                    <th>Horario</th>
                    <th>Aula</th>
                    <th>F. Creación</th>
                    <th>F. Actualización</th>
                    <th style="text-align:right;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $horario)
                <tr>
                    <td style="color:var(--muted); font-weight:700;">#{{ $horario->id }}</td>
                    <td style="font-weight:600;color:var(--text);">{{ $horario->course->name_course ?? 'Curso no asignado' }}</td>
                    <td><span class="badge">{{ $horario->day_of_week }}</span></td>
                    <td style="color:var(--accent); font-weight:600;">{{ $horario->start_time }} - {{ $horario->end_time }}</td>
                    <td><span style="color:var(--muted);">🚪 {{ $horario->classroom_nro }}</span></td>
                    <td style="color:var(--muted); font-size:.85rem; white-space: nowrap;">
                        {{ $horario->created_at ? $horario->created_at->format('d/m/Y') : '--' }}
                    </td>
                    <td style="color:var(--muted); font-size:.85rem; white-space: nowrap;">
                        {{ $horario->updated_at ? $horario->updated_at->format('d/m/Y') : '--' }}
                    </td>
                    <td style="text-align:right;">
                        <button type="button" 
                        class="btn btn-line btn-sm" 
                        style="color:#3b82f6;border-color:rgba(59,130,246,.3);margin-right:.4rem;"
                        data-id="{{ $horario->id }}"
                        data-name="{{ $horario->course->name_course ?? 'Curso no asignado' }}"
                        data-dow="{{ $horario->day_of_week ?? '' }}"
                        data-st="{{ $horario->start_time ?? '' }}"
                        data-et="{{ $horario->end_time ?? '' }}"
                        data-cn="{{ $horario->classroom_nro ?? '' }}"
                        onclick="openEditScheduleModal(this)">
                        Editar
                    </button>
                        <button type="button" onclick="openModal({{ $horario->id }}, 'schedules')" class="btn btn-line btn-sm" style="color:#f87171;border-color:rgba(248,113,113,.3);">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:3rem;color:var(--muted);">
                        <div style="font-size:2rem;margin-bottom:.8rem;">🗓️</div>
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
        <div class="modal-icon">⚠️</div>
        <h3>¿Eliminar horario?</h3>
        <p>Esta acción no se puede deshacer. ¿Estás seguro de continuar?</p>
        <form id="deleteForm" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <div class="modal-actions">
                <button type="button" onclick="closeModal()" class="btn btn-ghost">Cancelar</button>
                <button type="submit" class="btn btn-line" style="color:#f87171; border-color:#f87171;">Sí, eliminar</button>
            </div>
        </form>
    </div>
</div>

<div id="editScheduleModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 600px; width: 90%;">
        <div class="modal-icon" style="color: #3b82f6;">✏️</div>
        <h3 style="color: #3b82f6;">Editar Horario</h3>
        
        <form id="editScheduleForm" method="POST">
            @csrf
            @method('PUT')
            
            <div style="display: flex; gap: 1rem; margin-bottom: 1rem; text-align: left;">
                <div class="field" style="flex: 1;">
                    <label class="field-label">Curso <span style="font-size: 0.7rem; color: var(--muted);">(No editable)</span></label>
                    <input type="text" id="edit_sched_course" class="field-input" readonly style="opacity: 0.5; cursor: not-allowed; background: rgba(0,0,0,0.2);">
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Día de la Semana</label>
                    <select id="edit_sched_dow" name="day_of_week" class="field-input" style="background: var(--bg); color: var(--text);" required>
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miércoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Sábado">Sábado</option>
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; text-align: left;">
                <div class="field" style="flex: 1;">
                    <label class="field-label">Hora de inicio</label>
                    <input type="time" id="edit_sched_st" name="start_time" class="field-input" required>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Hora de finalización</label>
                    <input type="time" id="edit_sched_et" name="end_time" class="field-input" required>
                </div>
                <div class="field" style="flex: 1.5;">
                    <label class="field-label">Aula</label>
                    <input type="text" id="edit_sched_cn" name="classroom_nro" class="field-input" required>
                </div>
            </div>

            <div class="modal-actions" style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                <button type="button" onclick="closeEditScheduleModal()" class="btn btn-ghost">Cancelar</button>
                <button type="submit" class="btn btn-line" style="color:#3b82f6; border-color:#3b82f6;">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection