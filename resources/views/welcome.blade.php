<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- BLOBS -->

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <!-- NAVBAR -->

    <nav class="topbar">

        <div class="brand">

            <div class="brand-logo">
                ✦
            </div>

            <div class="brand-name">
                {{ config('app.name') }}
            </div>

        </div>

        @if (Route::has('login'))

            <div style="display:flex;gap:1rem;align-items:center;">

                @auth

                    <a href="{{ url('/home') }}" class="btn-secondary">
                        Dashboard
                    </a>

                @else

                    <a href="{{ route('login') }}" class="btn-secondary">
                        Login
                    </a>

                    @if (Route::has('register'))

                        <a href="{{ route('register') }}" class="btn-primary">
                            Crear cuenta
                        </a>

                    @endif

                @endauth

            </div>

        @endif

    </nav>

    <!-- HERO -->

    <main class="hero-layout">

        <!-- LEFT -->

        <section class="hero-content">

            <div class="mini-badge">

                <div class="mini-dot"></div>

                Sistema inteligente activo

            </div>

            <h1 class="hero-title">

                Evoluciona tu
                experiencia
                <span>académica.</span>

            </h1>

            <p class="hero-description">

                Una nueva generación de plataformas universitarias.
                Visualiza cursos, administra matrículas y controla
                tu progreso desde una interfaz futurista impulsada
                por tecnología moderna.

            </p>

            <div class="hero-buttons">

                @auth

                    <a href="{{ url('/home') }}"
                       class="btn-primary">

                        Entrar al sistema →

                    </a>

                @else

                    <a href="{{ route('register') }}"
                       class="btn-primary">

                        Comenzar ahora →

                    </a>

                    <a href="{{ route('login') }}"
                       class="btn-secondary">

                        Ya tengo cuenta

                    </a>

                @endauth

            </div>

        </section>

        <!-- RIGHT -->

        <section class="hero-visual">

            <!-- ORB -->

            <div class="orb"></div>

            <!-- FLOATING CARDS -->

            <div class="float-card card-1">

                <div style="font-size:.8rem;color:#9ca3af;margin-bottom:.4rem;">
                    ESTADO
                </div>

                <div style="font-size:1.1rem;font-weight:600;">
                    Sistema operativo
                </div>

            </div>

            <div class="float-card card-2">

                <div style="font-size:.8rem;color:#9ca3af;margin-bottom:.4rem;">
                    MATRÍCULAS
                </div>

                <div style="font-size:1.1rem;font-weight:600;">
                    +1200 estudiantes
                </div>

            </div>

        </section>

    </main>

</body>

</html>

