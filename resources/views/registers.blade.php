@extends('layouts.admin')

@section('title', 'Matrículas')
@section('hero_img', 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=1400&auto=format&fit=crop&q=80')
@section('hero_icon', '🎓')
@section('hero_title') Gestión de <em>Matrículas</em> @endsection
@section('hero_subtitle', 'Administra el registro de estudiantes en sus respectivos cursos, horarios y notas.')

@section('content')

<div class="admin-container" style="max-width:100%;padding:0;">
    
    {{-- FORMULARIO DINÁMICO DE REGISTRO --}}
    @if(request()->routeIs('registers.create'))
    <div class="table-card" style="padding: 2rem; margin-bottom: 2rem; border: 1px solid rgba(167,139,250,.2); max-width: 100%;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="margin: 0; color: var(--accent);">✦ Nueva Matrícula de Estudiante</h3>
            <a href="{{ route('registers.index') }}" class="btn btn-line btn-sm" style="text-decoration: none;">Volver a la lista</a>
        </div>

        <form method="POST" action="{{ route('registers.store') }}">
            @csrf
            
            {{-- Fila 1: Estudiante, Curso y Profesor --}}
            <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem;">
                <div class="field" style="flex: 1; min-width: 250px;">
                    <label class="field-label">Estudiante</label>
                    <select name="student_id" class="field-input" style="background: var(--bg); color: var(--text);" required>
                        <option value="">-- Seleccione Alumno --</option>
                        @foreach($students ?? [] as $student)
                            <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field" style="flex: 1; min-width: 250px;">
                    <label class="field-label">Curso</label>
                    <select name="course_id" class="field-input" style="background: var(--bg); color: var(--text);" required>
                        <option value="">-- Seleccione Curso --</option>
                        @foreach($courses ?? [] as $course)
                            <option value="{{ $course->id }}">{{ $course->name_course }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field" style="flex: 1; min-width: 250px;">
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
            <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="field" style="flex: 1; min-width: 200px;">
                    <label class="field-label">Horario Asignado</label>
                    <select name="schedule_id" class="field-input" style="background: var(--bg); color: var(--text);" required>
                        <option value="">-- Seleccione Horario --</option>
                        @foreach($schedules ?? [] as $schedule)
                            <option value="{{ $schedule->id }}">{{ $schedule->day_of_week ?? 'Sin día' }} - {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</option>
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
                        
                        <td style="text-align:right; white-space: nowrap;">
                            <a href="{{ route('registers.edit', $registro->id) }}" class="btn btn-line btn-sm" style="color:#3b82f6;border-color:rgba(59,130,246,.3);text-decoration:none;margin-right:.4rem;">Editar</a>
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

<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-icon">⚠️</div>
        <h3>¿Eliminar matrícula?</h3>
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
@endsection