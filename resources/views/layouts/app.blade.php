<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} @hasSection('title') — @yield('title') @endif</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>

@auth
<nav class="n">
    <a href="{{ url('/home') }}" class="n-brand">
        <div class="n-logo">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                <path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4L12 2z"/>
            </svg>
        </div>
        <div style="display: flex; flex-direction: column; justify-content: center;">
            <span class="n-name">{{ config('app.name', 'Laravel') }}</span>
            <span class="n-sub" style="font-size:0.72rem; color:var(--muted);">Plataforma académica</span>
        </div>
    </a>

    <div class="nav-links" style="display:flex; gap:1.5rem; font-size:0.85rem; font-weight:500;">
        <a href="{{ route('courses.index') }}" 
           style="color: {{ request()->routeIs('courses.*') ? 'var(--accent)' : 'var(--muted)' }}; text-decoration:none; transition:var(--t);">
           Cursos
        </a>
        <a href="{{ route('students.index') }}" 
           style="color: {{ request()->routeIs('students.*') ? 'var(--accent)' : 'var(--muted)' }}; text-decoration:none; transition:var(--t);">
           Estudiantes
        </a>
        <a href="{{ route('teachers.index') }}" 
           style="color: {{ request()->routeIs('teachers.*') ? 'var(--accent)' : 'var(--muted)' }}; text-decoration:none; transition:var(--t);">
           Profesores
        </a>
        <a href="{{ route('registers.index') }}" 
           style="color: {{ request()->routeIs('registers.*') ? 'var(--accent)' : 'var(--muted)' }}; text-decoration:none; transition:var(--t);">
           Matrículas
        </a>

        <a href="{{ route('schedules.index') }}" 
           style="color: {{ request()->routeIs('schedules.*') ? 'var(--accent)' : 'var(--muted)' }}; text-decoration:none; transition:var(--t);">
           Horarios
        </a>

    </div>

    <div class="n-user">
        <div class="n-user-info" style="text-align: right;">
            <span style="display:block; font-size:0.72rem; color:var(--muted);">Sesión iniciada</span>
            <strong style="font-size:0.88rem;">{{ Auth::user()->name }}</strong>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="margin:0; margin-left: 1rem;">
            @csrf
            <button type="submit" class="btn btn-ghost" style="padding: 0.5rem 1.2rem;">Salir</button>
        </form>
    </div>
</nav>
@endauth

@guest
<nav class="app-nav">
    <a href="/" class="logo" style="margin-bottom:0;">
        <div class="logo-mark">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                <path d="M2 17l10 5 10-5"/>
                <path d="M2 12l10 5 10-5"/>
            </svg>
        </div>
        <span class="logo-text">{{ config('app.name') }}</span>
    </a>
    <div class="nav-actions">
        <a href="{{ route('login') }}" class="btn-nav">Iniciar sesión</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn-nav btn-nav-accent">Registrarse</a>
        @endif
    </div>
</nav>
@endguest

@if (session('status'))
    <div style="max-width:900px;margin:1rem auto;padding:0 2rem;">
        <div class="alert alert-success" data-dismiss="4000">{{ session('status') }}</div>
    </div>
@endif

@if (session('error'))
    <div style="max-width:900px;margin:1rem auto;padding:0 2rem;">
        <div class="alert alert-danger" data-dismiss="4000">{{ session('error') }}</div>
    </div>
@endif

<main style="padding-top:64px;">
    @yield('content')
</main>

@stack('scripts')
</body>
</html>