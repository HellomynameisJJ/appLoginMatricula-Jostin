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
<nav class="app-nav">
    <a href="{{ url('/home') }}" class="logo" style="margin-bottom:0;">
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
        <span style="color:var(--muted);font-size:0.85rem;">{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="btn-nav">Cerrar sesión</button>
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