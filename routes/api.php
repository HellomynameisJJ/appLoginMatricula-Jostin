<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Usuario autenticado vía Sanctum
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ─── API RESTful (sin autenticación para pruebas con Postman) ───────────────
// En producción puedes protegerlas con ->middleware('auth:sanctum')

Route::apiResource('alumnos',    App\Http\Controllers\Api\AlumnoApiController::class);
Route::apiResource('cursos',     App\Http\Controllers\Api\CursoApiController::class);
Route::apiResource('profesores', App\Http\Controllers\Api\ProfesorApiController::class);