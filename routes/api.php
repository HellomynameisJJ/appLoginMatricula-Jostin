<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CoursesController;

// Usuario autenticado vía Sanctum
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ─── API RESTful (sin autenticación para pruebas con Postman) ───────────────
// En producción puedes protegerlas con ->middleware('auth:sanctum')
Route::apiResource('courses', App\Http\Controllers\Api\CoursesController::class);
Route::apiResource('schedules', App\Http\Controllers\Api\SchedulesController::class);
Route::apiResource('students', App\Http\Controllers\Api\StudentsController::class);
Route::apiResource("teachers", App\Http\Controllers\Api\TeachersController::class);
Route::apiResource("registers", App\Http\Controllers\Api\RegistersController::class);