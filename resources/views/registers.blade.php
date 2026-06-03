@extends('layouts.admin')

@section('title', 'Matrículas')
@section('hero_img', 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=1400&auto=format&fit=crop&q=80')
@section('hero_icon', '🎓')
@section('hero_title') Gestión de <em>Matrículas</em> @endsection
@section('hero_subtitle', 'Administra el registro de estudiantes en sus respectivos cursos, horarios y notas.')

@section('content')

<div class="admin-container" style="max-width:100%;padding:0;">
    
    {{-- FORMULARIO DINÁMICO DE REGISTRO CON MAGIA JS --}}
    @if(request()->routeIs('registers.create'))
    <div class="table-card" style="padding: 2rem; margin-bottom: 2rem; border: 1px solid rgba(167,139,250,.2); max-width: 100%;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="margin: 0; color: var(--accent);">✦ Nueva Matrícula de Estudiante</h3>
            <a href="{{ route('registers.index') }}" class="btn btn-line btn-sm" style="text-decoration: none;">Volver a la lista</a>
        </div>

        <form method="POST" action="{{ route('registers.store') }}">
            @csrf
            
            {{-- SECCIÓN MAGIA: DNI y Alumno --}}
            <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem; padding: 1rem; background: rgba(167,139,250,0.05); border-radius: 8px;">
                <div class="field" style="flex: 0.5; min-width: 150px;">
                    <label class="field-label" style="color: var(--accent);">🔍 Buscar DNI</label>
                    <input type="text" id="search_dni" class="field-input" placeholder="Escribe el DNI..." oninput="autoSelectStudent()">
                </div>
                <div class="field" style="flex: 1.5; min-width: 250px;">
                    <label class="field-label">Estudiante Encontrado</label>
                    <select name="student_id" id="auto_student_select" class="field-input" style="background: var(--bg); color: var(--text);" required>
                        <option value="">-- Esperando selección --</option>
                        @foreach($students ?? [] as $student)
                            <option value="{{ $student->id }}" data-dni="{{ $student->DNI }}">
                                {{ $student->DNI }} - {{ $student->first_name }} {{ $student->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Fila 1: Curso y Profesor --}}
            <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem;">
                <div class="field" style="flex: 1; min-width: 250px;">
                    <label class="field-label">Curso</label>
                    <select name="course_id" id="dynamic_course" class="field-input" style="background: var(--bg); color: var(--text);" onchange="filterSchedules()" required>
                        <option value="">-- Seleccione Curso --</option>
                        @foreach($courses ?? [] as $course)
                            <option value="{{ $course->id }}">{{ $course->name_course }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field" style="flex: 1; min-width: 250px;">
                    <label class="field-label">Profesor Asignado</label>
                    <select name="teacher_id" class="field-input" style="background: var(--bg); color: var(--text);" required>
                        <option value="">-- Seleccione Docente --</option>
                        @foreach($teachers ?? [] as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }} ({{ $teacher->specialty }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Fila 2: Horario, Semestre, Fecha y Estado --}}
            <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="field" style="flex: 1; min-width: 200px;">
                    <label class="field-label">Horario Disponible</label>
                    <select name="schedule_id" id="dynamic_schedule" class="field-input" style="background: var(--bg); color: var(--text);" required>
                        <option value="">-- Primero seleccione un curso --</option>
                        @foreach($schedules ?? [] as $schedule)
                            <option value="{{ $schedule->id }}" data-course="{{ $schedule->course_id }}">
                                {{ $schedule->day_of_week ?? 'Sin día' }} - {{ $schedule->start_time ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i') : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field" style="flex: 1; min-width: 150px;">
                    <label class="field-label">Semestre</label>
                    <input type="text" name="semester" class="field-input" placeholder="Ej. 6to Ciclo" required>
                </div>
                <div class="field" style="flex: 1; min-width: 150px;">
                    <label class="field-label">Fecha de Registro</label>
                    <input type="date" name="registration_date" class="field-input" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="field" style="flex: 1; min-width: 150px;">
                    <label class="field-label">Estado</label>
                    <select name="status" class="field-input" style="background: var(--bg); color: var(--text);">
                        <option value="Cursando">Cursando</option>
                        <option value="Aprobado">Aprobado</option>
                        <option value="Reprobado">Reprobado</option>
                    </select>
                </div>
            </div>
            
            <div style="text-align: right;">
                <button type="submit" class="btn btn-fill">Guardar Matrícula</button>
            </div>
        </form>
    </div>
    @endif
    
    <div class="prem-toolbar observe">
        <div class="prem-toolbar-left">
            <div>
                <div style="font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:.2rem;">Total de matrículas</div>
                <div style="font-size:1.4rem;font-weight:700;letter-spacing:-.03em;color:var(--accent);">{{ count($registers) ?? 0 }} <span style="font-size:.8rem;color:var(--muted);font-weight:400;">registros</span></div>
            </div>
        </div>
        <div class="prem-toolbar-right">
            <div class="search-wrap">
                <input type="text" class="field-input search-input" placeholder="Buscar matrícula...">
            </div>
            <a href="{{ route('registers.create') }}" class="btn btn-fill" style="text-decoration: none;"><span>+</span> Nueva Matrícula</a>
        </div>
    </div>

    {{-- AQUI ESTÁ LA MAGIA DEL SCROLL HORIZONTAL --}}
    <div class="table-card observe" style="overflow: hidden;">
        <div style="overflow-x: auto; width: 100%;">
            {{-- Le damos un min-width a la tabla para evitar que las columnas colapsen --}}
            <table class="data-table" style="min-width: 1300px; width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Estudiante</th>
                        <th>Curso</th>
                        <th>Profesor</th>
                        <th>Horario</th>
                        <th>Semestre</th>
                        <th>F. Matrícula</th>
                        <th>Estado</th>
                        <th>Nota Final</th>
                        <th style="text-align:right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registers as $registro)
                    <tr>
                        <td style="color:var(--muted); font-weight: 700;">#{{ $registro->id }}</td>
                        
                        {{-- COLUMNA DE ESTUDIANTE LIMPIA SIN EL AVATAR --}}
                        <td style="white-space: nowrap;">
                            <span class="user-name" style="font-weight: 600;">
                                {{ $registro->student->first_name ?? 'No asignado' }} {{ $registro->student->last_name ?? '' }}
                            </span>
                        </td>
                        
                        <td style="font-weight:500; white-space: nowrap;">{{ $registro->course->name_course ?? 'No asignado' }}</td>
                        
                        <td style="white-space: nowrap;">
                            <span style="font-weight: 500; color: var(--text);">
                                👨‍🏫 {{ $registro->teacher->first_name ?? 'Sin asignar' }} {{ $registro->teacher->last_name ?? '' }}
                            </span>
                        </td>

                        <td style="white-space: nowrap;">
                            <span class="badge" style="background: rgba(59,130,246,.1); color: #3b82f6;">
                                {{ $registro->schedule->day_of_week ?? 'Sin horario' }} 
                                @if($registro->schedule && $registro->schedule->start_time)
                                    - {{ \Carbon\Carbon::parse($registro->schedule->start_time)->format('H:i') }}
                                @endif
                            </span>
                        </td>

                        <td style="color:var(--muted); white-space: nowrap;">
                            {{ $registro->semester ?? '--' }}
                        </td>
                        
                        <td style="color:var(--muted);font-size:.85rem; white-space: nowrap;">{{ $registro->registration_date }}</td>
                        
                        <td style="white-space: nowrap;">
                            <span class="badge" style="background: rgba(167,139,250,.09); color: var(--accent);">
                                {{ $registro->status }}
                            </span>
                        </td>

                        <td style="white-space: nowrap;">
                            <span class="badge" style="background: rgba(59,130,246,.1); color: #3b82f6; font-size: .75rem;">
                                {{ $registro->final_note ? 'Nota: ' . $registro->final_note : 'Sin nota' }}
                            </span>
                        </td>

                        <td style="text-align:right; white-space: nowrap;">
                        <button 
                        type="button" 
                        class="btn btn-line btn-sm" 
                        style="color:#3b82f6;border-color:rgba(59,130,246,.3);margin-right:.4rem;"
                        data-id="{{ $registro->id }}"
                        data-student="{{ $registro->student->first_name ?? '' }} {{ $registro->student->last_name ?? '' }}"
                        data-course="{{ $registro->course->name_course ?? '' }}"
                        data-teacher="{{ $registro->teacher->first_name ?? '' }} {{ $registro->teacher->last_name ?? '' }}"
                        data-schedule="{{ $registro->schedule->day_of_week ?? 'Sin horario' }} {{ $registro->schedule->start_time ? '- ' . \Carbon\Carbon::parse($registro->schedule->start_time)->format('H:i') : '' }}"
                        data-semester="{{ $registro->semester }}"
                        data-note="{{ $registro->final_note }}"
                        data-status="{{ $registro->status }}"
                        onclick="openEditRegisterModal(this)">
                        Editar
                        </button>
                            <button type="button" onclick="openModal({{ $registro->id }}, 'registers')" class="btn btn-line btn-sm" style="color:#f87171;border-color:rgba(248,113,113,.3);">Eliminar</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="text-align:center;padding:3rem;color:var(--muted);">
                            <div style="font-size:2rem;margin-bottom:.8rem;">🎓</div>
                            No hay matrículas registradas en el sistema.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="editRegisterModal" class="modal-overlay" style="display: none;">
    <div class="modal-content" style="max-width: 700px; width: 95%;">
        <div class="modal-icon" style="color: #3b82f6;">✏️</div>
        <h3 style="color: #3b82f6;">Editar Matrícula</h3>
        
        <form id="editRegisterForm" method="POST">
            @csrf
            @method('PUT')
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem; text-align: left;">
                <div class="field">
                    <label class="field-label" style="font-size: 0.75rem;">Estudiante <span style="color: var(--muted);">(Ref)</span></label>
                    <input type="text" id="edit_reg_student" class="field-input" readonly style="opacity: 0.5; cursor: not-allowed; background: rgba(0,0,0,0.2);">
                </div>
                <div class="field">
                    <label class="field-label" style="font-size: 0.75rem;">Curso <span style="color: var(--muted);">(Ref)</span></label>
                    <input type="text" id="edit_reg_course" class="field-input" readonly style="opacity: 0.5; cursor: not-allowed; background: rgba(0,0,0,0.2);">
                </div>
                <div class="field">
                    <label class="field-label" style="font-size: 0.75rem;">Profesor <span style="color: var(--muted);">(Ref)</span></label>
                    <input type="text" id="edit_reg_teacher" class="field-input" readonly style="opacity: 0.5; cursor: not-allowed; background: rgba(0,0,0,0.2);">
                </div>
                <div class="field">
                    <label class="field-label" style="font-size: 0.75rem;">Horario <span style="color: var(--muted);">(Ref)</span></label>
                    <input type="text" id="edit_reg_schedule" class="field-input" readonly style="opacity: 0.5; cursor: not-allowed; background: rgba(0,0,0,0.2);">
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; text-align: left;">
                <div class="field" style="flex: 1;">
                    <label class="field-label">Semestre</label>
                    <input type="text" id="edit_reg_semester" name="semester" class="field-input" required>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Nota Final</label>
                    <input type="number" step="0.1" min="0" max="20" id="edit_reg_note" name="final_note" class="field-input" placeholder="Ej. 15">
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Estado</label>
                    <select id="edit_reg_status" name="status" class="field-input" style="background: var(--bg); color: var(--text);">
                        <option value="Cursando">Cursando</option>
                        <option value="Aprobado">Aprobado</option>
                        <option value="Reprobado">Reprobado</option>
                    </select>
                </div>
            </div>

            <div class="modal-actions" style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                <button type="button" onclick="closeEditRegisterModal()" class="btn btn-ghost">Cancelar</button>
                <button type="submit" class="btn btn-line" style="color:#3b82f6; border-color:#3b82f6;">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection