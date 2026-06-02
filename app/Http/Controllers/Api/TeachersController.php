<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TeachersResource;
use App\Models\Teacher;

class TeachersController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers', compact('teachers'));
    }

   public function create()
{
    // Traemos los profesores de la base de datos
    $teachers = Teacher::all(); // O como se llame tu modelo

    // Se los pasamos a la vista con compact
    return view('teachers', compact('teachers'));
}

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
        ]);

        Teacher::create($request->all());
        return redirect()->route('teachers.index')->with('success', 'Profesor agregado correctamente.');
    }

    public function show(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        return new TeachersResource($teacher);
    }

    public function update(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());
        return redirect()->route('teachers.index')->with('success', 'Profesor actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Profesor eliminado.');
    }
}