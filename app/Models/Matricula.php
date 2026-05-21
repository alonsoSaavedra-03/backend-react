<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = 'matriculas';

    protected $primaryKey = 'id_matricula';

    protected $fillable = [
        'id_alumno',
        'id_curso',
        'fecha_matricula',
        'estado',
        'semestre',
        'nora_final'
    ];
}
