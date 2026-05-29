<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alumnos = Alumno::latest()->get();
        return view('alumnos.index', compact('alumnos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellidos'        => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'dni'              => 'required|string|max:20|unique:alumnos,dni',
            'direccion'        => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'email'            => 'required|email|unique:alumnos,email',
            'estado_matricula' => 'required|in:matriculado,inactivo',
        ]);

        Alumno::create($request->all());

        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno registrado correctamente.');
    }

    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellidos'        => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'dni'              => 'required|string|max:20|unique:alumnos,dni,' . $alumno->id_alumno . ',id_alumno',
            'direccion'        => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'email'            => 'required|email|unique:alumnos,email,' . $alumno->id_alumno . ',id_alumno',
            'estado_matricula' => 'required|in:matriculado,inactivo',
        ]);

        $alumno->update($request->all());

        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno actualizado correctamente.');
    }

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();

        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno eliminado correctamente.');
    }
}