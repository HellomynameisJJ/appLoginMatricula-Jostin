@extends('layouts.app')

@section('title', 'Estudiantes')

@section('content')
<div class="admin-container">
    
    <div class="admin-toolbar">
        <div>
            <h1 class="dash-title" style="font-size: 2.2rem; margin-bottom: 0;">Tabla de <span>Estudiantes</span></h1>
        </div>
        
        <div class="admin-actions">
            <input type="text" class="field-input search-input" placeholder="Buscar estudiante...">
            <button class="btn btn-fill">
                <span>+</span> Agregar
            </button>
        </div>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estudiante</th>
                    <th>Fecha Nac.</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Email</th>
                    <th>Estado Matrícula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
    @foreach($students as $student)
    <tr>
        <td style="color:var(--muted);">{{ $student->id }}</td>
        <td>
            <span class="user-name" style="font-weight: 600;">{{ $student->first_name }} {{ $student->last_name }}</span>
        </td>
        <td>{{ $student->birth_date }}</td>
        <td>{{ $student->DNI }}</td>
        <td>{{ $student->phone }}</td>
        <td><span class="dash-row-badge">{{ $student->address }}</span></td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->registration_status }}</td>
        <td>

            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-line btn-sm" style="color: #f87171; border-color: rgba(248,113,113,.3);">Eliminar</button>
                <button class="btn btn-line btn-sm" style="color: #3b82f6; border-color: rgba(59,130,246,.3);">Editar</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
        </table>
    </div>

</div>
@endsection