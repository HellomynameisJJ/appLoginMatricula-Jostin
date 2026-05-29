<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $profesores = Profesor::latest()->get();
        return view('profesores.index', compact('profesores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:100',
            'apellidos'    => 'required|string|max:100',
            'especialidad' => 'required|string|max:150',
        ]);

        Profesor::create($request->all());

        return redirect()->route('profesores.index')
            ->with('success', 'Profesor registrado correctamente.');
    }

    public function update(Request $request, Profesor $profesor)
    {
        $request->validate([
            'nombre'       => 'required|string|max:100',
            'apellidos'    => 'required|string|max:100',
            'especialidad' => 'required|string|max:150',
        ]);

        $profesor->update($request->all());

        return redirect()->route('profesores.index')
            ->with('success', 'Profesor actualizado correctamente.');
    }

    public function destroy(Profesor $profesor)
    {
        $profesor->delete();

        return redirect()->route('profesores.index')
            ->with('success', 'Profesor eliminado correctamente.');
    }
}