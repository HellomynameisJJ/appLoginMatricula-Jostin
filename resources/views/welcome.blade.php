<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<nav class="n">
    <a href="/" class="n-brand">
        <div class="n-logo">✦</div>
        <span class="n-name">{{ config('app.name') }}</span>
    </a>
    @if (Route::has('login'))
        <div class="n-actions">
            @auth
                <a href="{{ url('/home') }}" class="btn btn-line">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost">Iniciar sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-fill">Crear cuenta</a>
                @endif
            @endauth
        </div>
    @endif
</nav>

<main class="hero">
    <section class="hero-l">
        <div class="tag">
            <span class="tag-dot"></span>
            Plataforma <em>activa</em>
        </div>

        <h1 class="title">
            Evoluciona tu<br>
            experiencia<br>
            <span>académica.</span>
        </h1>

        <p class="lead">
            Una nueva generación de plataformas universitarias.
            Gestiona matrículas, visualiza cursos y controla
            tu progreso desde una interfaz moderna y precisa.
        </p>

        <div class="actions">
            @auth
                <a href="{{ url('/home') }}" class="btn btn-fill btn-lg">Entrar al sistema →</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-fill btn-lg">Comenzar ahora →</a>
                <a href="{{ route('login') }}"    class="btn btn-line btn-lg">Ya tengo cuenta</a>
            @endauth
        </div>
    </section>

    <section class="hero-r">
        <div class="mark">
            <div class="mark-ring"></div>
            <div class="mark-ring"></div>
            <div class="mark-ring"></div>
            <div class="mark-center">✦</div>
            <div class="chip">
                <div class="chip-label">Estado</div>
                <div class="chip-value">Sistema activo</div>
            </div>
            <div class="chip">
                <div class="chip-label">Estudiantes</div>
                <div class="chip-value">+1,200</div>
            </div>
        </div>
    </section>
</main>

</body>
</html>