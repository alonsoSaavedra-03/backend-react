<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;

class MatriculaController extends Controller
{
    public function index()
    {
        return response()->json(
            Matricula::all()
        );
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_alumno' => 'required|integer|exists:alumno,id_alumno',
            'id_curso' => 'required|integer|exists:cursos,id_curso',
            'fecha_matricula' => 'required|date',
            'estado' => 'required|in:Activo,Retirado,Finalizado',
            'semestre' => 'required|string|max:20',
            'nora_final' => 'nullable|numeric|min:0|max:20'
        ]);

        $matricula = Matricula::create($request->all());

        return response()->json($matricula, 201);
    }

    public function show($id)
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            return response()->json(['message' => 'Matrícula no encontrada'], 404);
        }

        return response()->json($matricula);
    }

    public function update(Request $request, $id)
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            return response()->json(['message' => 'Matrícula no encontrada'], 404);
        }

        $request->validate([
            'id_alumno' => 'required|integer|exists:alumno,id_alumno',
            'id_curso' => 'required|integer|exists:cursos,id_curso',
            'fecha_matricula' => 'required|date',
            'estado' => 'required|in:Activo,Retirado,Finalizado',
            'semestre' => 'required|string|max:20',
            'nora_final' => 'nullable|numeric|min:0|max:20'
        ]);
        $matricula->update($request->all());

        return response()->json($matricula);
    }

    public function destroy($id)
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            return response()->json(['message' => 'Matrícula no encontrada'], 404);
        }

        $matricula->delete();

        return response()->json(['message' => 'Matrícula eliminada']);
    }
}
