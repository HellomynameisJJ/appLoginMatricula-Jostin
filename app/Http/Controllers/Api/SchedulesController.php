<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SchedulesResource;
use App\Models\Schedule;
use App\Models\Course;

class SchedulesController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('schedules', compact('schedules'));
    }

    // ARREGLADO: Ahora incluye los horarios ($schedules) además de los cursos
    public function create()
    {
        $schedules = Schedule::all();
        $courses = Course::all();
        return view('schedules', compact('schedules', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'      => 'required|exists:courses,id',
            'day_of_week'    => 'required|string|max:20',
            'start_time'     => 'required',
            'end_time'       => 'required',
            'classroom_nro'  => 'required|string|max:20',
        ]);

        Schedule::create($request->all());
        return redirect()->route('schedules.index')->with('success', 'Horario creado correctamente.');
    }

    public function show(string $id)
    {
        $schedule = Schedule::findOrFail($id);
        return new SchedulesResource($schedule);
    }

    public function update(Request $request, string $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());
        return redirect()->route('schedules.index')->with('success', 'Horario actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Horario eliminado.');
    }
}