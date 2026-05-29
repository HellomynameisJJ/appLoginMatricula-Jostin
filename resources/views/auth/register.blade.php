<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>
        Registro — {{ config('app.name') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <!-- BACKGROUND -->

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <!-- TOPBAR -->

    <nav class="topbar">

        <a href="/"
           style="text-decoration:none;color:white;">

            <div class="brand">

                <div class="brand-logo">
                    ✦
                </div>

                <div class="brand-name">
                    {{ config('app.name') }}
                </div>

            </div>

        </a>

    </nav>

    <!-- MAIN -->

    <main class="hero-layout">

        <!-- LEFT -->

        <section class="hero-content">

            <div class="mini-badge">

                <div class="mini-dot"></div>

                Registro inteligente

            </div>

            <h1 class="hero-title"
                style="max-width:700px;">

                Construye tu
                nueva etapa
                <span>académica.</span>

            </h1>

            <p class="hero-description">

                Únete a una plataforma universitaria
                diseñada para simplificar matrículas,
                organización y seguimiento académico
                desde una experiencia futurista.

            </p>

            <!-- REGISTER CARD -->

            <div class="login-card">

                <form method="POST"
                      action="{{ route('register') }}">

                    @csrf

                    <!-- NAME -->

                    <div class="form-group">

                        <label class="form-label">

                            Nombre completo

                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Juan Pérez"
                            required
                        >

                        @error('name')

                            <span class="invalid-feedback">

                                {{ $message }}

                            </span>

                        @enderror

                    </div>

                    <!-- EMAIL -->

                    <div class="form-group">

                        <label class="form-label">

                            Correo electrónico

                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="correo@universidad.com"
                            required
                        >

                        @error('email')

                            <span class="invalid-feedback">

                                {{ $message }}

                            </span>

                        @enderror

                    </div>

                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label class="form-label">

                            Contraseña

                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Mínimo 8 caracteres"
                            required
                        >

                        @error('password')

                            <span class="invalid-feedback">

                                {{ $message }}

                            </span>

                        @enderror

                    </div>

                    <!-- CONFIRM PASSWORD -->

                    <div class="form-group">

                        <label class="form-label">

                            Confirmar contraseña

                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Repite tu contraseña"
                            required
                        >

                    </div>

                    <!-- BUTTON -->

                    <button type="submit"
                            class="btn-primary"
                            style="width:100%;margin-top:1rem;">

                        Crear cuenta →

                    </button>

                </form>

                <!-- FOOTER -->

                <div class="auth-switch">

                    ¿Ya tienes cuenta?

                    <a href="{{ route('login') }}">

                        Iniciar sesión

                    </a>

                </div>

            </div>

        </section>

        <!-- RIGHT -->

        <section class="hero-visual">

            <!-- 3D ORB -->

            <div class="orb"></div>

            <!-- FLOATING INFO -->

            <div class="float-card card-1">

                <div class="card-label">

                    NUEVOS USUARIOS

                </div>

                <div class="card-value">

                    +350 esta semana

                </div>

            </div>

            <div class="float-card card-2">

                <div class="card-label">

                    SISTEMA

                </div>

                <div class="card-value">

                    Registro sincronizado

                </div>

            </div>

        </section>

    </main>

</body>

</html>
