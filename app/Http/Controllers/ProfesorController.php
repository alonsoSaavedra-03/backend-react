<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function index()
    {
        return response()->json(
            Profesor::all()
        );
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:profesores,dni',
            'email' => 'required|email|unique:profesores,email',
            'telefono' => 'required|string|max:20',
            'especialidad' => 'required|string|max:255'
        ]);

        $profesor = Profesor::create($request->all());

        return response()->json($profesor, 201);
    }

    public function show($id)
    {
        $profesor = Profesor::find($id);

        if (!$profesor) {
            return response()->json(['message' => 'Profesor no encontrado'], 404);
        }

        return response()->json($profesor);
    }

    public function update(Request $request, $id)
    {
        $profesor = Profesor::find($id);

        if (!$profesor) {
            return response()->json(['message' => 'Profesor no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => "required|string|max:20|unique:profesores,dni,$id,id_profesor",
            'email' => "required|email|unique:profesores,email,$id,id_profesor",
            'telefono' => 'required|string|max:20',
            'especialidad' => 'required|string|max:255'
        ]);

        $profesor->update($request->all());

        return response()->json($profesor);
    }

    public function destroy($id)
    {
        $profesor = Profesor::find($id);

        if (!$profesor) {
            return response()->json(['message' => 'Profesor no encontrado'], 404);
        }

        $profesor->delete();

        return response()->json(['message' => 'Profesor eliminado']);
    }
}
