<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // LISTAR
    public function index()
    {
        return response()->json(
            Alumno::all()
        );
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'dni' => 'required|string|size:8|unique:alumno,dni',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|size:9',
            'email' => 'required|email|unique:alumno,email',
            'estado_matricula' => 'required|in:Matriculado,Inactivo',

            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $rutaImagen = null;

        if ($request->hasFile('imagen')) {

            $rutaImagen = $request
                ->file('imagen')
                ->store('alumnos', 'public');
        }

        // Crear alumno
        $alumno = Alumno::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'dni' => $request->dni,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'estado_matricula' => $request->estado_matricula,
            'imagen' => $rutaImagen
        ]);

        return response()->json($alumno, 201);
    }

    public function show($id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno) {
            return response()->json([
                'message' => 'Alumno no encontrado'
            ], 404);
        }

        return response()->json($alumno);
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno) {

            return response()->json([   
                'message' => 'Alumno no encontrado'
            ], 404);
        }

        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required|date',
            'dni' => 'required|size:8|unique:alumno,dni,' . $id . ',id_alumno',
            'direccion' => 'nullable',
            'telefono' => 'nullable|size:9',
            'email' => 'required|email|unique:alumno,email,' . $id . ',id_alumno',
            'estado_matricula' => 'required|in:Matriculado,Inactivo',

            // VALIDAR IMAGEN
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        // Mantener imagen anterior
        $rutaImagen = $alumno->imagen;

        // Nueva imagen
        if ($request->hasFile('imagen')) {

            $rutaImagen = $request
                ->file('imagen')
                ->store('alumnos', 'public');
        }

        // Actualizar
        $alumno->update([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'dni' => $request->dni,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'estado_matricula' => $request->estado_matricula,
            'imagen' => $rutaImagen
        ]);

        return response()->json($alumno);
    }

    // ELIMINAR
    public function destroy($id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno) {
            return response()->json([
                'message' => 'Alumno no encontrado'
            ], 404);
        }

        $alumno->delete();

        return response()->json([
            'message' => 'Alumno eliminado'
        ]);
    }
}