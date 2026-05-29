<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cursos = Curso::latest()->get();
        return view('cursos.index', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_curso'  => 'required|string|max:150',
            'codigo_curso'  => 'required|string|max:20|unique:cursos,codigo_curso',
            'creditos'      => 'required|integer|min:1|max:20',
            'descripcion'   => 'nullable|string',
        ]);

        Curso::create($request->all());

        return redirect()->route('cursos.index')
            ->with('success', 'Curso creado correctamente.');
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre_curso'  => 'required|string|max:150',
            'codigo_curso'  => 'required|string|max:20|unique:cursos,codigo_curso,' . $curso->id_curso . ',id_curso',
            'creditos'      => 'required|integer|min:1|max:20',
            'descripcion'   => 'nullable|string',
        ]);

        $curso->update($request->all());

        return redirect()->route('cursos.index')
            ->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('success', 'Curso eliminado correctamente.');
    }
}