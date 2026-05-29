<?php
// =============================================
// app/Http/Controllers/Api/CursoApiController.php
// =============================================

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoApiController extends Controller
{
    public function index()
    {
        return response()->json(Curso::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_curso' => 'required|string|max:150',
            'codigo_curso' => 'required|string|max:20|unique:cursos,codigo_curso',
            'creditos'     => 'required|integer|min:1|max:20',
            'descripcion'  => 'nullable|string',
        ]);

        return response()->json(Curso::create($data), 201);
    }

    public function show($id)
    {
        $curso = Curso::find($id);
        if (!$curso) return response()->json(['message' => 'Curso no encontrado'], 404);
        return response()->json($curso, 200);
    }

    public function update(Request $request, $id)
    {
        $curso = Curso::find($id);
        if (!$curso) return response()->json(['message' => 'Curso no encontrado'], 404);

        $data = $request->validate([
            'nombre_curso' => 'sometimes|required|string|max:150',
            'codigo_curso' => 'sometimes|required|string|max:20|unique:cursos,codigo_curso,' . $curso->id_curso . ',id_curso',
            'creditos'     => 'sometimes|required|integer|min:1|max:20',
            'descripcion'  => 'nullable|string',
        ]);

        $curso->update($data);
        return response()->json($curso, 200);
    }

    public function destroy($id)
    {
        $curso = Curso::find($id);
        if (!$curso) return response()->json(['message' => 'Curso no encontrado'], 404);
        $curso->delete();
        return response()->json(['message' => 'Curso eliminado correctamente'], 200);
    }
}