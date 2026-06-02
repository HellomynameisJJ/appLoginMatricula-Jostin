@extends('layouts.admin')

@section('title', 'Estudiantes')
@section('hero_img', 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1400&auto=format&fit=crop&q=80')
@section('hero_icon', '👥')
@section('hero_title') Gestión de <em>Estudiantes</em> @endsection
@section('hero_subtitle', 'Administra el registro, datos personales y estado de matrícula de cada alumno.')

@section('content')

<!-- Contenedor principal sin estilos destructivos -->
<div class="admin-container" style="max-width:100%;padding:0;">

    {{-- FORMULARIO DE REGISTRO (Adaptado estrictamente a tu Base de Datos) --}}
    @if(request()->routeIs('students.create'))
    <div class="table-card" style="padding: 2rem; margin-bottom: 2rem; border: 1px solid rgba(167,139,250,.2); max-width: 100%;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="margin: 0; color: var(--accent);">✦ Registrar Nuevo Estudiante</h3>
            <a href="{{ route('students.index') }}" class="btn btn-line btn-sm" style="text-decoration: none;">Volver a la lista</a>
        </div>

        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            
            <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem;">
                <div class="field" style="flex: 1; min-width: 250px;">
                    <label class="field-label">Nombres</label>
                    <input type="text" name="first_name" class="field-input" placeholder="Ej. Juan Carlos" required>
                </div>
                <div class="field" style="flex: 1; min-width: 250px;">
                    <label class="field-label">Apellidos</label>
                    <input type="text" name="last_name" class="field-input" placeholder="Ej. Pérez Gómez" required>
                </div>
            </div>

            <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem;">
                <div class="field" style="flex: 1; min-width: 200px;">
                    <label class="field-label">Documento de Identidad (DNI)</label>
                    <input type="text" name="DNI" class="field-input" placeholder="Ej. 74859612" required>
                </div>
                <div class="field" style="flex: 1; min-width: 200px;">
                    <label class="field-label">Fecha de Nacimiento</label>
                    <input type="date" name="birth_date" class="field-input" required>
                </div>
                <div class="field" style="flex: 1; min-width: 200px;">
                    <label class="field-label">Teléfono Alumno</label>
                    <input type="text" name="phone" class="field-input" placeholder="Ej. 987654321">
                </div>
            </div>

            <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="field" style="flex: 1; min-width: 250px;">
                    <label class="field-label">Correo Electrónico</label>
                    <input type="email" name="email" class="field-input" placeholder="juan.perez@innovatec.edu.pe" required>
                </div>
                <div class="field" style="flex: 1; min-width: 250px;">
                    <label class="field-label">Dirección de Domicilio</label>
                    <input type="text" name="address" class="field-input" placeholder="Ej. Av. Las Flores 456">
                </div>
                <div class="field" style="flex: 1; min-width: 200px;">
                    <label class="field-label">Estado de Matrícula</label>
                    <select name="registration_status" class="field-input" style="background: var(--bg); color: var(--text);">
                        <option value="Matriculado">Matriculado</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Retirado">Retirado</option>
                    </select>
                </div>
            </div>

            <div style="text-align: right;">
                <button type="submit" class="btn btn-fill">Registrar Estudiante</button>
            </div>
        </form>
    </div>
    @endif

    <div class="prem-toolbar observe" style="width: 100%;">
        <div class="prem-toolbar-left">
            <div>
                <div style="font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:.2rem;">Total registrados</div>
                <div style="font-size:1.4rem;font-weight:700;letter-spacing:-.03em;color:var(--accent);">{{ count($students) }} <span style="font-size:.8rem;color:var(--muted);font-weight:400;">estudiantes</span></div>
            </div>
        </div>
        <div class="prem-toolbar-right">
            <div class="search-wrap">
                <input type="text" class="field-input search-input" placeholder="Buscar estudiante...">
            </div>
            <a href="{{ route('students.create') }}" class="btn btn-fill" style="text-decoration: none;"><span>+</span> Añadir estudiante</a>
        </div>
    </div>

    {{-- TABLA CON CONTENEDOR DE SCROLL HORIZONTAL AISLADO --}}
    <div class="table-card observe" style="overflow: hidden;">
        <div style="overflow-x: auto; width: 100%;">
            <table class="data-table" style="min-width: 1200px; width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Estudiante</th>
                        <th>F. Nacimiento</th>
                        <th>DNI</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>F. Inscripción</th>
                        <th style="text-align:right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    <tr>
                        <td style="color:var(--muted);font-weight:700;">#{{ $student->id }}</td>
                        <td style="white-space: nowrap;">
                            <div class="user-cell" style="display: flex; align-items: center; gap: 0.8rem;">
                                <!-- Avatar morado estilo premium -->
                                <div style="width: 32px; height: 32px; border-radius: 50%; background: rgba(167,139,250,0.15); color: var(--accent); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem;">
                                    {{ substr($student->first_name, 0, 1) }}
                                </div>
                                <div class="user-info">
                                    <div class="user-name" style="font-weight: 600;">{{ $student->first_name }} {{ $student->last_name }}</div>
                                    <div style="font-size:.72rem;color:var(--muted);">{{ $student->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="white-space: nowrap;">
                            <div style="font-weight: 500; color: var(--text);">{{ $student->birth_date ?? '--' }}</div>
                            <div style="color: var(--muted); font-size: 0.8rem;">
                                {{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->age . ' años' : '' }}
                            </div>
                        </td>
                        <td style="white-space: nowrap;"><span class="badge">{{ $student->DNI }}</span></td>
                        <td style="white-space: nowrap; max-width: 200px; overflow: hidden; text-overflow: ellipsis;" title="{{ $student->address }}">
                            {{ $student->address ?? '--' }}
                        </td>
                        <td style="white-space: nowrap;">📞 {{ $student->phone ?? '--' }}</td>
                        <td style="white-space: nowrap;">
                            <span class="badge" style="background: rgba(167,139,250,.09); color: var(--accent);">
                                {{ $student->registration_status ?? 'Matriculado' }}
                            </span>
                        </td>
                        <td style="color:var(--muted); font-size:.85rem; white-space: nowrap;">
                            {{ $student->created_at ? $student->created_at->format('d/m/Y') : '--' }}
                        </td>
                        <td style="text-align:right; white-space: nowrap;">
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-line btn-sm" style="color:#3b82f6;border-color:rgba(59,130,246,.3);text-decoration:none;margin-right:.4rem;">Editar</a>
                            <button type="button" onclick="openModal({{ $student->id }}, 'students')" class="btn btn-line btn-sm" style="color:#f87171;border-color:rgba(248,113,113,.3);">Eliminar</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:3rem;color:var(--muted);">
                            <div style="font-size:2rem;margin-bottom:.8rem;">👥</div>
                            No hay estudiantes registrados en el sistema.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Universal -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-icon">⚠️</div>
        <h3>¿Eliminar estudiante?</h3>
        <p>Esta acción no se puede deshacer. El registro del estudiante será eliminado permanentemente del sistema.</p>
        <form id="deleteForm" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <div class="modal-actions">
                <button type="button" onclick="closeModal()" class="btn btn-ghost">Cancelar</button>
                <button type="submit" class="btn btn-line" style="color:#f87171;border-color:#f87171;">Sí, eliminar</button>
            </div>
        </form>
    </div>
</div>
@endsection