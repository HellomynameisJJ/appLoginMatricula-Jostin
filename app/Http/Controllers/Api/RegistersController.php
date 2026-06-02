<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RegistersResource;
use App\Models\Register;
use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Schedule;

class RegistersController extends Controller
{
    // Ambos métodos deben compartir la misma data para evitar errores en la vista
    public function index()
    {
        $registers = Register::with(['student', 'course', 'teacher', 'schedule'])->get();
        $students  = Student::all();
        $courses   = Course::all();
        $teachers  = Teacher::all();
        $schedules = Schedule::all();

        return view('registers', compact('registers', 'students', 'courses', 'teachers', 'schedules'));
    }

    public function create()
    {
        $registers = Register::with(['student', 'course', 'teacher', 'schedule'])->get();
        $students  = Student::all();
        $courses   = Course::all();
        $teachers  = Teacher::all();
        $schedules = Schedule::all();

        return view('registers', compact('registers', 'students', 'courses', 'teachers', 'schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'        => 'required|exists:students,id',
            'course_id'         => 'required|exists:courses,id',
            'teacher_id'        => 'required|exists:teachers,id',
            'schedule_id'       => 'required|exists:schedules,id',
            'semester'          => 'required|string|max:50', // Agregado según tu $fillable
            'registration_date' => 'required|date',
            'status'            => 'required|string|max:50',
        ]);

        Register::create($request->all());
        return redirect()->route('registers.index')->with('success', 'Matrícula registrada correctamente.');
    }

    public function show(string $id)
    {
        $register = Register::findOrFail($id);
        return new RegistersResource($register);
    }

    public function update(Request $request, string $id)
    {
        $register = Register::findOrFail($id);
        $register->update($request->all());
        return redirect()->route('registers.index')->with('success', 'Matrícula actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $register = Register::findOrFail($id);
        $register->delete();
        return redirect()->route('registers.index')->with('success', 'Matrícula eliminada.');
    }
}