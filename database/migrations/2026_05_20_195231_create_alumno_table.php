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
        Schema::create('alumno', function (Blueprint $table) {
            $table->id('id_alumno');
            $table->string('nombre');
            $table->string('apellidos');
            $table->date('fecha_nacimiento');
            $table->string('dni', 8)->unique();
            $table->string('direccion')->nullable();
            $table->string('telefono', 9)->nullable();
            $table->string('email')->unique();
            $table->string('imagen')->nullable();
            $table->enum('estado_matricula', ['Matriculado', 'Inactivo'])
                  ->default('Inactivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno');
    }
};
