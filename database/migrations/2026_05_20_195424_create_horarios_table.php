<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id('id_horario');
        
            $table->foreignId('id_curso')
                  ->constrained('cursos', 'id_curso')
                  ->onDelete('cascade');
        
            $table->foreignId('id_profesor')
                  ->constrained('profesores', 'id_profesor')
                  ->onDelete('cascade');
        
            $table->enum('dia_semana', [
                'Lunes',
                'Martes',
                'Miercoles',
                'Jueves',
                'Viernes',
                'Sabado'
            ]);
        
            $table->time('hora_inicio');
            $table->time('hora_fin');
        
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
