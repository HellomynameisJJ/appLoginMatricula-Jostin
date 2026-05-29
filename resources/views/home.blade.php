<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

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

<div class="home-wrapper">

    <div class="home-hero fade-in">
        <p style="color:var(--muted);font-size:0.85rem;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:0.5rem;">
            {{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
        </p>
        <h1>Hola, <span>{{ explode(' ', Auth::user()->name)[0] }}</span> 👋</h1>
        <p>Aquí tienes un resumen de tu actividad académica.</p>
    </div>

    @if (session('status'))
        <div style="max-width:900px;margin:0 auto;padding:0 2rem;">
            <div class="alert alert-success" data-dismiss="4000">{{ session('status') }}</div>
        </div>
    @endif

    <div class="home-cards fade-in-delay">

        <div class="home-card">
            <div class="card-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
            </div>
            <h3>Mis cursos</h3>
            <p>Consulta y gestiona los cursos en los que estás matriculado.</p>
        </div>

        <div class="home-card">
            <div class="card-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
            <h3>Horario</h3>
            <p>Revisa tu horario de clases y actividades académicas.</p>
        </div>

        <div class="home-card">
            <div class="card-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
            </div>
            <h3>Notas</h3>
            <p>Visualiza tu rendimiento académico y calificaciones.</p>
        </div>

        <div class="home-card">
            <div class="card-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <h3>Mi perfil</h3>
            <p>Actualiza tu información personal y preferencias.</p>
        </div>

    </div>
</div>

</body>
</html>