<?php
// =============================================
// app/Http/Controllers/Api/ProfesorApiController.php
// =============================================

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profesor;
use Illuminate\Http\Request;

class ProfesorApiController extends Controller
{
    public function index()
    {
        return response()->json(Profesor::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'       => 'required|string|max:100',
            'apellidos'    => 'required|string|max:100',
            'especialidad' => 'required|string|max:150',
        ]);

        return response()->json(Profesor::create($data), 201);
    }

    public function show($id)
    {
        $profesor = Profesor::find($id);
        if (!$profesor) return response()->json(['message' => 'Profesor no encontrado'], 404);
        return response()->json($profesor, 200);
    }

    public function update(Request $request, $id)
    {
        $profesor = Profesor::find($id);
        if (!$profesor) return response()->json(['message' => 'Profesor no encontrado'], 404);

        $data = $request->validate([
            'nombre'       => 'sometimes|required|string|max:100',
            'apellidos'    => 'sometimes|required|string|max:100',
            'especialidad' => 'sometimes|required|string|max:150',
        ]);

        $profesor->update($data);
        return response()->json($profesor, 200);
    }

    public function destroy($id)
    {
        $profesor = Profesor::find($id);
        if (!$profesor) return response()->json(['message' => 'Profesor no encontrado'], 404);
        $profesor->delete();
        return response()->json(['message' => 'Profesor eliminado correctamente'], 200);
    }
}