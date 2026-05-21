<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesores';

    protected $primaryKey = 'id_profesor';

    protected $fillable = [
        'nombre',
        'apellidos',
        'dni',
        'email',
        'telefono',
        'especialidad'
    ];
}
