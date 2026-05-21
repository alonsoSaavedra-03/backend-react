<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        return response()->json(
            Horario::all()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_profesor' => 'required|exists:profesores,id_profesor',
            'id_curso' => 'required|exists:cursos,id_curso',
            'dia_semana' => 'required|in:Lunes,Martes,Miercoles,Jueves,Viernes,Sabado',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s|after:hora_inicio'
        ]);

        $horario = Horario::create($request->all());

        return response()->json($horario, 201);
    }

    public function show($id)
    {
        $horario = Horario::find($id);

        if (!$horario) {
            return response()->json(['message' => 'Horario no encontrado'], 404);
        }

        return response()->json($horario);
    }

    public function update(Request $request, $id)
    {
        $horario = Horario::find($id);

        if (!$horario) {
            return response()->json(['message' => 'Horario no encontrado'], 404);
        }

        $request->validate([
            'id_profesor' => 'required|exists:profesores,id_profesor',
            'id_curso' => 'required|exists:cursos,id_curso',
            'dia_semana' => 'required|in:Lunes,Martes,Miercoles,Jueves,Viernes,Sabado',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s|after:hora_inicio'
        ]);

        $horario->update($request->all());

        return response()->json($horario);
    }

    public function destroy($id)
    {
        $horario = Horario::find($id);

        if (!$horario) {
            return response()->json(['message' => 'Horario no encontrado'], 404);
        }

        $horario->delete();

        return response()->json(['message' => 'Horario eliminado']);
    }
}
