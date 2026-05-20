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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id('id_matricula');
        
            $table->foreignId('id_alumno')
                  ->constrained('alumno', 'id_alumno')
                  ->onDelete('cascade');
        
            $table->foreignId('id_curso')
                  ->constrained('cursos', 'id_curso')
                  ->onDelete('cascade');
        
            $table->date('fecha_matricula');
            $table->string('semestre',20);
            $table->decimal('nora_final', 5,2)->nullable();
            $table->enum('estado', [
                'Activo',
                'Retirado',
                'Finalizado'
            ])->default('Activo');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
