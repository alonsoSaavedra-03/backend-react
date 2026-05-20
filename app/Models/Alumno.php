<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumno';

    protected $primaryKey = 'id_alumno';

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'dni',
        'direccion',
        'telefono',
        'email',
        'estado_matricula',
        'imagen'
    ];
}