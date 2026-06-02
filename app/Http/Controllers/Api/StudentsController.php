<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\StudentsResource;
use App\Models\Student;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students', compact('students'));
    }

    // ARREGLADO: Ahora busca los estudiantes y se los envía a la vista
    public function create()
    {
        $students = Student::all();
        return view('students', compact('students'));
    }

    public function store(Request $request)
{
    $request->validate([
        'first_name'     => 'required|string|max:100',
        'last_name'      => 'required|string|max:100',
        'DNI'            => 'required|string|max:20',
        'email'          => 'required|email|max:150',
        'phone'          => 'nullable|string|max:20',
        'address'        => 'nullable|string|max:255',
        'guardian_name'  => 'nullable|string|max:150',
        'guardian_phone' => 'nullable|string|max:20',
        'gender'         => 'nullable|string|max:20',
        'birth_date'     => 'nullable|date',
    ]);

    Student::create($request->all());
    return redirect()->route('students.index')->with('success', 'Estudiante agregado correctamente.');
}

    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        return new StudentsResource($student);
    }

    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Estudiante eliminado.');
    }
}