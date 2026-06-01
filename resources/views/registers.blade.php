@extends('layouts.admin')

@section('title', 'Matrículas')

@section('content')
{{-- ── ESTILOS PARA ESTIRAR TODA LA PANTALLA Y VER LOS DATOS ABAJO ── --}}
<style>
    /* Forzamos a que el contenedor principal se estire a la derecha según el contenido */
    .admin-container {
        max-width: none !important;
        width: max-content !important;
        min-width: 100% !important;
        padding-right: 4rem !important; /* Margen de respiro al final */
    }

    /* Quitamos cualquier scroll interno de la tarjeta para usar el del navegador abajo */
    .table-card {
        overflow: visible !important;
        width: 100% !important;
    }

    /* Definimos un ancho fijo cómodo para albergar todas tus columnas sin que se aplasten */
    .data-table {
        width: 1350px !important;
        table-layout: fixed !important;
    }

    /* Distribución exacta de los anchos para tus columnas */
    .data-table th:nth-child(1) { width: 60px; }  /* ID */
    .data-table th:nth-child(2) { width: 240px; } /* Estudiante */
    .data-table th:nth-child(3) { width: 200px; } /* Curso */
    .data-table th:nth-child(4) { width: 220px; } /* Profesor */
    .data-table th:nth-child(5) { width: 200px; } /* Horario */
    .data-table th:nth-child(6) { width: 140px; } /* Fecha Registro */
    .data-table th:nth-child(7) { width: 110px; } /* Estado */
    .data-table th:nth-child(8) { width: 140px; } /* Acciones */

    /* Habilitamos el desplazamiento horizontal global en la pantalla */
    body {
        overflow-x: auto !important;
    }
</style>

<div class="admin-container">
    
    {{-- FORMULARIO DINÁMICO DE REGISTRO (Aparece arriba si estás en la ruta de creación) --}}
    @if(request()->routeIs('registers.create'))
    <div class="table-card" style="padding: 2rem; margin-bottom: 2rem; border: 1px solid rgba(167,139,250,.2); max-width: 1200px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="margin: 0; color: var(--accent);">✦ Nueva Matrícula de Estudiante</h3>
            <a href="{{ route('registers.index') }}" class="btn btn-line btn-sm" style="text-decoration: none;">Volver a la lista</a>
        </div>

        <form method="POST" action="{{ route('registers.store') }}">
            @csrf
            
            {{-- Fila 1: Estudiante, Curso y Profesor (Usando los IDs de tu fillable) --}}
            <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                <div class="field" style="flex: 1;">
                    <label class="field-label">Estudiante</label>
                    <select name="student_id" class="field-input" style="background: var(--bg); color: var(--text);" required>
                        <option value="">-- Seleccione Alumno --</option>
                        @foreach($students ?? [] as $student)
                            <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Curso</label>
                    <select name="course_id" class="field-input" style="background: var(--bg); color: var(--text);" required>
                        <option value="">-- Seleccione Curso --</option>
                        @foreach($courses ?? [] as $course)
                            <option value="{{ $course->id }}">{{ $course->name_course }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Profesor</label>
                    <select name="teacher_id" class="field-input" style="background: var(--bg); color: var(--text);" required>
                        <option value="">-- Seleccione Docente --</option>
                        @foreach($teachers ?? [] as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Fila 2: Horario, Semestre, Fecha y Estado --}}
            <<div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
    <div class="field" style="flex: 1;">
        <label class="field-label">Horario Asignado</label>
        <select name="schedule_id" class="field-input" style="background: var(--bg); color: var(--text);" required>
            <option value="">-- Seleccione Horario --</option>
            @foreach($schedules ?? [] as $schedule)
                <option value="{{ $schedule->id }}">{{ $schedule->day ?? 'Sin día' }} - {{ $schedule->time ?? 'Sin hora' }}</option>
            @endforeach
        </select>
    </div>
    <div class="field" style="flex: 0.7;">
        <label class="field-label">Semestre</label>
        {{-- Importante: name="semester" tal cual está en tu modelo --}}
        <input type="text" name="semester" class="field-input" placeholder="Ej. 2026-I" required>
    </div>
    <div class="field" style="flex: 1;">
        <label class="field-label">Fecha de Registro</label>
        <input type="date" name="registration_date" class="field-input" value="{{ date('Y-m-d') }}" required>
    </div>
    <div class="field" style="flex: 0.8;">
        <label class="field-label">Estado</label>
        <select name="status" class="field-input" style="background: var(--bg); color: var(--text);">
            <option value="Activo">Activo</option>
            <option value="Pendiente">Pendiente</option>
            <option value="Inactivo">Inactivo</option>
        </select>
    </div>
</div>
            <button type="submit" class="btn btn-fill">Guardar Matrícula</button>
        </form>
    </div>
    @endif

    <div class="admin-toolbar">
        <div>
            <h1 class="dash-title" style="font-size: 2.2rem; margin-bottom: 0;">Tabla de <span>Matrículas</span></h1>
        </div>
        
        <div class="admin-actions">
            <input type="text" class="field-input search-input" placeholder="Buscar matrícula...">
            {{-- Botón unificado que dispara la vista de creación arriba de la tabla --}}
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
                    <th style="text-align: right;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registers as $registro)
                <tr>
                    <td style="color:var(--muted); font-weight: 700;">#{{ $registro->id }}</td>
                    
                    <td>
                        <div class="user-cell">
                            <div class="avatar">{{ substr($registro->student->first_name ?? 'S', 0, 1) }}</div>
                            <div class="user-info">
                                <span class="user-name" style="font-weight: 600; white-space: nowrap;">
                                    {{ $registro->student->first_name ?? 'No asignado' }} {{ $registro->student->last_name ?? '' }}
                                </span>
                            </div>
                        </div>
                    </td>
                    
                    <td>
                        <span style="font-weight: 500; white-space: nowrap;">{{ $registro->course->name_course ?? 'No asignado' }}</span>
                    </td>

                    <td style="color:var(--muted); white-space: nowrap;">
                        👨‍🏫 {{ $registro->teacher->first_name ?? 'Sin asignar' }} {{ $registro->teacher->last_name ?? '' }}
                    </td>

                    <td>
                        <span class="dash-row-badge" style="background: rgba(59,130,246,.1); color: #3b82f6; white-space: nowrap;">
                            {{ $registro->schedule->day ?? 'Sin horario' }} - {{ $registro->schedule->time ?? '' }}
                        </span>
                    </td>
                    
                    <td style="color:var(--muted); white-space: nowrap;">{{ $registro->registration_date }}</td>
                    
                    <td>
                        <span class="dash-row-badge" style="background: rgba(167,139,250,.09); color: var(--accent); white-space: nowrap;">
                            {{ $registro->status }}
                        </span>
                    </td>
                    
                    <td style="text-align: right; white-space: nowrap;">
                        <a href="{{ route('registers.edit', $registro->id) }}" class="btn btn-line btn-sm" style="color: #3b82f6; border-color: rgba(59,130,246,.3); text-decoration: none; margin-right: 0.5rem;">Editar</a>
                        <button type="button" onclick="openModal({{ $registro->id }}, 'registers')" class="btn btn-line btn-sm" style="color: #f87171; border-color: rgba(248,113,113,.3);">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 3rem; color: var(--muted);">
                        <div style="font-size:2rem; margin-bottom:.8rem;">📋</div>
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
        <div class="modal-icon" style="font-size: 2rem; margin-bottom: 0.5rem;">⚠️</div>
        <h3>¿Eliminar matrícula?</h3>
        <p>Esta acción no se puede deshacer. ¿Estás seguro de continuar?</p>
        <form id="deleteForm" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <div class="modal-actions" style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 0.5rem;">
                <button type="button" onclick="closeModal()" class="btn btn-ghost">Cancelar</button>
                <button type="submit" class="btn btn-line" style="color: #f87171; border-color: #f87171;">Sí, eliminar</button>
            </div>
        </form>
    </div>
</div>
@endsection