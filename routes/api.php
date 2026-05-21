<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\HorarioController;
USE App\Http\Controllers\CursoController;
use App\Http\Controllers\MatriculaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API DE ALUMNO
Route::apiResource('alumno', AlumnoController::class);

// API DE PROFESOR
Route::apiResource('profesor', ProfesorController::class);

// API DE HORARIO
Route::apiResource('horario', HorarioController::class);

// API DE CURSO
Route::apiResource('curso', CursoController::class);

// API DE MATRICULA
Route::apiResource('matricula', MatriculaController::class);

