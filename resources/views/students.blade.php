@extends('layouts.admin')

@section('title', 'Estudiantes')
@section('hero_img', 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1400&auto=format&fit=crop&q=80')
@section('hero_icon', '👥')
@section('hero_title') Gestión de <em>Estudiantes</em> @endsection
@section('hero_subtitle', 'Administra el registro, datos personales y estado de matrícula de cada alumno.')

@section('content')
{{-- ── ESTILOS PARA ESTIRAR TODA LA PANTALLA Y VER LOS DATOS ABAJO ── --}}
<style>
    /* Forzamos a que el contenedor principal de la página pueda estirarse infinitamente a la derecha */
    .admin-container {
        max-width: none !important;
        width: max-content !important;
        min-width: 100% !important;
        padding-right: 4rem !important; /* Espacio extra al final para que no pegue al borde */
    }

    /* La tarjeta de la tabla ya NO tiene scroll interno, ahora se adapta al ancho total de sus datos */
    .table-card {
        overflow: visible !important;
        width: 100% !important;
    }

    /* Aseguramos un ancho cómodo y fijo para la tabla para que obligue a la pantalla a moverse */
    .data-table {
        width: 1400px !important;
        table-layout: fixed !important;
    }

    /* Configuración de anchos por columna */
    .data-table th:nth-child(1) { width: 60px; }  /* ID */
    .data-table th:nth-child(2) { width: 240px; } /* Estudiante */
    .data-table th:nth-child(3) { width: 110px; } /* DNI */
    .data-table th:nth-child(4) { width: 140px; } /* Género */
    .data-table th:nth-child(5) { width: 130px; } /* Contacto */
    .data-table th:nth-child(6) { width: 220px; } /* Dirección */
    .data-table th:nth-child(7) { width: 180px; } /* Apoderado */
    .data-table th:nth-child(8) { width: 130px; } /* Tel. Apoderado */
    .data-table th:nth-child(9) { width: 150px; } /* Acciones */

    /* Forzar que la barra de desplazamiento de abajo de la pantalla completa se vea siempre */
    body {
        overflow-x: auto !important;
    }
</style>

<div class="admin-container">

    {{-- SI LA RUTA ES 'create', SE MUESTRA EL FORMULARIO DE REGISTRO --}}
    @if(request()->routeIs('students.create'))
    <div class="table-card" style="padding: 2rem; margin-bottom: 2rem; border: 1px solid rgba(167,139,250,.2); max-width: 1200px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="margin: 0; color: var(--accent);">✦ Registrar Nuevo Estudiante</h3>
            <a href="{{ route('students.index') }}" class="btn btn-line btn-sm" style="text-decoration: none;">Volver a la lista</a>
        </div>

        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            
            <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                <div class="field" style="flex: 1;">
                    <label class="field-label">Nombres</label>
                    <input type="text" name="first_name" class="field-input" placeholder="Ej. Juan Carlos" required>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Apellidos</label>
                    <input type="text" name="last_name" class="field-input" placeholder="Ej. Pérez Gómez" required>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                <div class="field" style="flex: 1;">
                    <label class="field-label">Documento de Identidad (DNI)</label>
                    <input type="text" name="DNI" class="field-input" placeholder="Ej. 74859612" required>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Género</label>
                    <select name="gender" class="field-input" style="background: var(--bg); color: var(--text);">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Fecha de Nacimiento</label>
                    <input type="date" name="birth_date" class="field-input">
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                <div class="field" style="flex: 1;">
                    <label class="field-label">Correo Electrónico</label>
                    <input type="email" name="email" class="field-input" placeholder="juan.perez@innovatec.edu.pe" required>
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Teléfono Alumno</label>
                    <input type="text" name="phone" class="field-input" placeholder="Ej. 987654321">
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Dirección de Domicilio</label>
                    <input type="text" name="address" class="field-input" placeholder="Ej. Av. Las Flores 456">
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="field" style="flex: 1;">
                    <label class="field-label">Nombre del Apoderado</label>
                    <input type="text" name="guardian_name" class="field-input" placeholder="Ej. María Gómez (Madre)">
                </div>
                <div class="field" style="flex: 1;">
                    <label class="field-label">Teléfono del Apoderado</label>
                    <input type="text" name="guardian_phone" class="field-input" placeholder="Ej. 912345678">
                </div>
            </div>

            <button type="submit" class="btn btn-fill">Registrar Alumno Completamente</button>
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

    {{-- TABLA REGULAR QUE AHORA ESTIRA TODA LA PANTALLA GENERAL --}}
    <div class="table-card observe">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estudiante</th>
                    <th>DNI</th>
                    <th>Género / Edad</th>
                    <th>Contacto</th>
                    <th>Dirección</th>
                    <th>Apoderado</th>
                    <th>Tel. Apoderado</th>
                    <th style="text-align:right;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td style="color:var(--muted);font-weight:700;">#{{ $student->id }}</td>
                    <td>
                        <div class="user-cell">
                            <div class="avatar">{{ substr($student->first_name, 0, 1) }}</div>
                            <div class="user-info">
                                <div class="user-name" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $student->first_name }} {{ $student->last_name }}</div>
                                <div class="user-role" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $student->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge">{{ $student->DNI }}</span></td>
                    <td>
                        <div style="font-weight: 600;">{{ $student->gender ?? 'No especificado' }}</div>
                        <div style="color: var(--muted); font-size: 0.8rem;">
                            {{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->age . ' años' : '--' }}
                        </div>
                    </td>
                    <td style="white-space: nowrap;">📞 {{ $student->phone ?? '--' }}</td>
                    <td style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $student->address }}">
                        {{ $student->address ?? '--' }}
                    </td>
                    <td style="font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $student->guardian_name ?? '--' }}</td>
                    <td style="color: var(--muted); white-space: nowrap;">{{ $student->guardian_phone ?? '--' }}</td>
                    <td style="text-align:right; white-space: nowrap;">
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-line btn-sm" style="color:#3b82f6;border-color:rgba(59,130,246,.3);text-decoration:none;margin-right:.4rem;">Editar</a>
                        <button type="button" onclick="openModal({{ $student->id }}, 'students')" class="btn btn-line btn-sm" style="color:#f87171;border-color:rgba(248,113,113,.3);">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center;padding:3rem;color:var(--muted);">
                        <div style="font-size:2rem;margin-bottom:.8rem;">👥</div>
                        No hay estudiantes registrados en el sistema.
                    </td>
                </tr>
                @forelse ($students as $student)
                @empty
                @endforelse
                @endforelse
            </tbody>
        </table>
    </div>

</div>

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