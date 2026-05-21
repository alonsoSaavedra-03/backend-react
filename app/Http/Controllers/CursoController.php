<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;

class CursoController extends Controller
{
    public function index()
    {
        return response()->json(
            Curso::all()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'creditos' => 'required|integer|min:1'
        ]);

        $curso = Curso::create($request->all());

        return response()->json($curso, 201);
    }

    public function show($id)
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        return response()->json($curso);
    }

    public function update(Request $request, $id)
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'creditos' => 'required|integer|min:1'
        ]);

        $curso->update($request->all());

        return response()->json($curso);
    }

    public function destroy($id)
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        $curso->delete();

        return response()->json(['message' => 'Curso eliminado']);
    }
}
