<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>
        Dashboard — {{ config('app.name') }}
    </title>

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@200;300;400;500;600;700&display=swap"
          rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <!-- BLOBS -->

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <!-- GRID -->

    <div class="dashboard-grid"></div>

    <!-- NAVBAR -->

    <nav class="dashboard-nav">

        <div class="dashboard-brand">

            <div class="dashboard-logo">
                ✦
            </div>

            <div>

                <div class="dashboard-brand-title">
                    {{ config('app.name') }}
                </div>

                <div class="dashboard-brand-subtitle">
                    Intelligent Academic Platform
                </div>

            </div>

        </div>

        <div class="dashboard-user">

            <div class="dashboard-user-info">

                <span>
                    Sesión iniciada
                </span>

                <strong>
                    {{ Auth::user()->name }}
                </strong>

            </div>

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="logout-button">

                    Salir

                </button>

            </form>

        </div>

    </nav>

    <!-- MAIN -->

    <main class="dashboard-wrapper">

        <!-- LEFT -->

        <section class="dashboard-left">

            <div class="status-pill">

                <div class="status-dot"></div>

                Plataforma sincronizada correctamente

            </div>

            <p class="dashboard-date">

                {{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}

            </p>

            <h1 class="dashboard-title">

                Bienvenido,
                <span>

                    {{ explode(' ', Auth::user()->name)[0] }}

                </span>

            </h1>

            <p class="dashboard-description">

                Tu entorno académico inteligente
                ya está listo.

                Gestiona matrículas, visualiza
                cursos, revisa tu progreso
                y controla toda tu experiencia
                universitaria desde un sistema
                moderno impulsado por tecnología avanzada.

            </p>

            <div class="dashboard-actions">

                <a href="#"
                   class="dashboard-btn-primary">

                    Explorar plataforma →

                </a>

                <a href="#"
                   class="dashboard-btn-secondary">

                    Ver historial

                </a>

            </div>

            <!-- STATS -->

            <div class="stats-grid">

                <div class="stat-card">

                    <div class="stat-number">
                        12
                    </div>

                    <div class="stat-label">
                        Cursos activos
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-number">
                        98%
                    </div>

                    <div class="stat-label">
                        Rendimiento
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-number">
                        24/7
                    </div>

                    <div class="stat-label">
                        Plataforma online
                    </div>

                </div>

            </div>

        </section>

        <!-- RIGHT -->

        <section class="dashboard-right">

            <!-- 3D CORE -->

            <div class="core-wrapper">

                <div class="core-ring ring-1"></div>
                <div class="core-ring ring-2"></div>
                <div class="core-ring ring-3"></div>

                <div class="core-center">

                    <div class="core-logo">
                        ✦
                    </div>

                </div>

            </div>

            <!-- FLOATING CARDS -->

            <div class="dashboard-float float-a">

                <div class="float-label">
                    ESTADO
                </div>

                <div class="float-value">
                    Sistema estable
                </div>

            </div>

            <div class="dashboard-float float-b">

                <div class="float-label">
                    ACCESO
                </div>

                <div class="float-value">
                    Google OAuth activo
                </div>

            </div>

            <div class="dashboard-float float-c">

                <div class="float-label">
                    SEGURIDAD
                </div>

                <div class="float-value">
                    Protección avanzada
                </div>

            </div>

        </section>

    </main>

</body>

</html>

