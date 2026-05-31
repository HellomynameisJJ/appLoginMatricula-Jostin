@extends('layouts.app')

@section('title', 'Cursos')

@section('content')
<div class="admin-container">
    
    <div class="admin-toolbar">
        <div>
            <h1 class="dash-title" style="font-size: 2.2rem; margin-bottom: 0;">Tabla de <span>Cursos</span></h1>
        </div>
        
        <div class="admin-actions">
            <input type="text" class="field-input search-input" placeholder="Buscar curso...">
            <button class="btn btn-fill"><span>+</span> Agregar Curso</button>
        </div>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Curso</th>
                    <th>Codigo</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $curso)
                <tr>
                    <td style="color:var(--muted);">{{ $curso->id }}</td>
                    <td>
                        <span class="user-name" style="font-weight: 600;">{{ $curso->name_course }}</span>
                    </td>
                    <td style="color:var(--muted);">{{ $curso->sku }}</td>   
                    <td style="color:var(--muted);">{{ $curso->description ?? 'Sin descripción' }}</td>
                    <td><span class="dash-row-badge">{{ $curso->credits }} Créditos</span></td>
                    <td>
                        <button class="btn btn-line btn-sm" style="color: #f87171; border-color: rgba(248,113,113,.3);">Eliminar</button>
                        <button class="btn btn-line btn-sm" style="color: #3b82f6; border-color: rgba(59,130,246,.3);">Editar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection