<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<nav class="n">
    <div class="n-brand">
        <div class="n-logo">✦</div>
        <div>
            <div class="n-name">{{ config('app.name') }}</div>
            <div class="n-sub">Plataforma académica</div>
        </div>
    </div>
    <div class="n-user">
        <div class="n-user-info">
            <span>Sesión iniciada</span>
            <strong>{{ Auth::user()->name }}</strong>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-ghost">Salir</button>
        </form>
    </div>
</nav>

<main class="dash">
    <section class="dash-l">
        <div class="status">
            <span class="status-dot"></span>
            Plataforma sincronizada
        </div>

        <p class="dash-date">
            {{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
        </p>

        <h1 class="dash-title">
            Hola,
            <span>{{ explode(' ', Auth::user()->name)[0] }}.</span>
        </h1>

        <p class="dash-desc">
            Tu entorno académico está listo. Gestiona matrículas,
            revisa tu progreso y controla toda tu experiencia universitaria.
        </p>

        <div class="dash-actions">
            <a href="#" class="btn btn-fill btn-lg">Explorar plataforma →</a>
            <a href="#" class="btn btn-line btn-lg">Ver historial</a>
        </div>

        <div class="stats">
            <div class="stat observe">
                <div class="stat-n">12</div>
                <div class="stat-l">Cursos activos</div>
            </div>
            <div class="stat observe" style="transition-delay:.1s">
                <div class="stat-n">98%</div>
                <div class="stat-l">Rendimiento</div>
            </div>
            <div class="stat observe" style="transition-delay:.2s">
                <div class="stat-n">24/7</div>
                <div class="stat-l">Online</div>
            </div>
        </div>
    </section>

    <section class="dash-r">
        <div class="dash-panel">
            <div class="dash-panel-head">
                <div class="dash-panel-icon">✦</div>
                <div>
                    <div class="dash-panel-title">Estado del sistema</div>
                    <div class="dash-panel-sub">Actualizado ahora</div>
                </div>
            </div>
            <div>
                <div class="dash-row">
                    <span class="dash-row-label">Plataforma</span>
                    <span class="dash-row-badge">Operativa</span>
                </div>
                <div class="dash-row">
                    <span class="dash-row-label">Google OAuth</span>
                    <span class="dash-row-badge">Activo</span>
                </div>
                <div class="dash-row">
                    <span class="dash-row-label">Seguridad</span>
                    <span class="dash-row-badge">Protegido</span>
                </div>
                <div class="dash-row">
                    <span class="dash-row-label">Versión</span>
                    <span class="dash-row-value">v2.0</span>
                </div>
                <div class="dash-row">
                    <span class="dash-row-label">Estudiantes activos</span>
                    <span class="dash-row-value">1,247</span>
                </div>
            </div>
        </div>
    </section>
</main>

</body>
</html>