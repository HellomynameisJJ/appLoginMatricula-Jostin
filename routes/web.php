<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Google OAuth
Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallBack']);

// GitHub OAuth
Route::get('login/github', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub'])->name('github.login');
Route::get('login/github/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallBack']);

// Facebook OAuth
Route::get('/login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('/login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallBack']);

// Dashboard protegido
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
});

// CRUD — Alumnos, Cursos, Profesores (protegidos con auth)
Route::middleware(['auth'])->group(function () {
    Route::resource('alumnos',   App\Http\Controllers\AlumnoController::class)->except(['show', 'create', 'edit']);
    Route::resource('cursos',    App\Http\Controllers\CursoController::class)->except(['show', 'create', 'edit']);
    Route::resource('profesores', App\Http\Controllers\ProfesorController::class)->except(['show', 'create', 'edit']);
});