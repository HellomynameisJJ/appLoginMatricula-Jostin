<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use App\Http\Resources\CoursesResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses', compact('courses'));
    }

    // ARREGLADO: Ahora busca los cursos y se los envía a la vista
    public function create()
    {
        $courses = Course::all();
        return view('courses', compact('courses'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name_course' => 'required|string|max:150',
            'sku'         => 'required|string|max:50',
            'credits'     => 'required|integer|min:1',
        ]);

        Course::create($request->all());
        return redirect()->route('courses.index')->with('success', 'Curso creado correctamente.');
    }

    public function show(string $id)
    {
        $course = Course::findOrFail($id);
        return new CoursesResource($course);
    }

    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return redirect()->route('courses.index')->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Curso eliminado.');
    }
}