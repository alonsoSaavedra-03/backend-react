<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API DE ALUMNO
Route::apiResource('alumno', AlumnoController::class);
