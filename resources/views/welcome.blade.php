<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="welcome-wrapper">

    <nav class="welcome-nav fade-in">
        <a href="/" class="logo">
            <div class="logo-mark">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                    <path d="M2 17l10 5 10-5"/>
                    <path d="M2 12l10 5 10-5"/>
                </svg>
            </div>
            <span class="logo-text">{{ config('app.name') }}</span>
        </a>
        @if (Route::has('login'))
            <div style="display:flex;gap:0.75rem;align-items:center;">
                @auth
                    <a href="{{ url('/home') }}" class="btn-nav btn-nav-accent">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-nav">Iniciar sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-nav btn-nav-accent">Registrarse</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <section class="welcome-hero">
        <div class="welcome-content">
            <div class="welcome-badge fade-in">Siempre Activo</div>
            <h1 class="fade-in-delay">
                Gestiona tu<br>matrícula de forma<br><em>inteligente</em>
            </h1>
            <p class="fade-in-delay">
                Accede a tu información académica, registrate en tus cursos
                y mantén el control de tu historial en un solo lugar.
            </p>
            <div class="welcome-actions fade-in-delay-2">
                @auth
                    <a href="{{ url('/home') }}" class="btn-filled">Ir al Dashboard →</a>
                @else
                    <a href="{{ route('register') }}" class="btn-filled">Comenzar ahora →</a>
                    <a href="{{ route('login') }}" class="btn-outline">Tengo una cuenta</a>
                @endauth
            </div>
        </div>
    </section>

</div>
</body>
</html>