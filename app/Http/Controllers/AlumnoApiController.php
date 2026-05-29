<?php
// =============================================
// app/Http/Controllers/Api/AlumnoApiController.php
// =============================================

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoApiController extends Controller
{
    // GET /api/alumnos
    public function index()
    {
        return response()->json(Alumno::all(), 200);
    }

    // POST /api/alumnos
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellidos'        => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'dni'              => 'required|string|max:20|unique:alumnos,dni',
            'direccion'        => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'email'            => 'required|email|unique:alumnos,email',
            'estado_matricula' => 'required|in:matriculado,inactivo',
        ]);

        $alumno = Alumno::create($data);

        return response()->json($alumno, 201);
    }

    // GET /api/alumnos/{id}
    public function show($id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno) {
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }

        return response()->json($alumno, 200);
    }

    // PUT /api/alumnos/{id}
    public function update(Request $request, $id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno) {
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }

        $data = $request->validate([
            'nombre'           => 'sometimes|required|string|max:100',
            'apellidos'        => 'sometimes|required|string|max:100',
            'fecha_nacimiento' => 'sometimes|required|date',
            'dni'              => 'sometimes|required|string|max:20|unique:alumnos,dni,' . $alumno->id_alumno . ',id_alumno',
            'direccion'        => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'email'            => 'sometimes|required|email|unique:alumnos,email,' . $alumno->id_alumno . ',id_alumno',
            'estado_matricula' => 'sometimes|required|in:matriculado,inactivo',
        ]);

        $alumno->update($data);

        return response()->json($alumno, 200);
    }

    // DELETE /api/alumnos/{id}
    public function destroy($id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno) {
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }

        $alumno->delete();

        return response()->json(['message' => 'Alumno eliminado correctamente'], 200);
    }
}