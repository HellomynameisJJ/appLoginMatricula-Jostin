<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\RegistersController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Google OAuth
Route::get('/login/google',          [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallBack']);

// GitHub OAuth
Route::get('/login/github',          [App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub'])->name('github.login');
Route::get('/login/github/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallBack']);

// Facebook OAuth
Route::get('/login/facebook',          [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('/login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallBack']);

// Bitbucket OAuth
Route::get('/login/bitbucket',          [App\Http\Controllers\Auth\LoginController::class, 'redirectToBitbucket'])->name('bitbucket.login');
Route::get('/login/bitbucket/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleBitbucketCallBack']);

// Dashboard protegido
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
});

// CRUD — Alumnos, Cursos, Profesores (protegidos con auth)
Route::middleware(['auth'])->group(function () {
    // Fíjate cómo ahora incluimos \Api\ en la ruta
    Route::resource("students", App\Http\Controllers\Api\StudentsController::class);
    Route::resource("courses", App\Http\Controllers\Api\CoursesController::class);
    Route::resource("teachers", App\Http\Controllers\Api\TeachersController::class);
    Route::resource("registers", App\Http\Controllers\Api\RegistersController::class);
    Route::resource("schedules", App\Http\Controllers\Api\SchedulesController::class);
});