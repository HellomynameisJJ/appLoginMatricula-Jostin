<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>
        Login — {{ config('app.name') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <!-- BACKGROUND BLOBS -->

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

                Plataforma protegida

            </div>

            <h1 class="hero-title"
                style="max-width:650px;">

                Accede al
                núcleo de tu
                <span>universidad.</span>

            </h1>

            <p class="hero-description">

                Continúa tu experiencia académica desde
                una interfaz inteligente diseñada para
                estudiantes modernos y sistemas avanzados.

            </p>

            <!-- LOGIN CARD -->

            <div class="login-card">

                @if(session('error'))

                    <div class="alert alert-danger">

                        {{ session('error') }}

                    </div>

                @endif

                <form method="POST"
                      action="{{ route('login') }}">

                    @csrf

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
                            placeholder="••••••••"
                            required
                        >

                        @error('password')

                            <span class="invalid-feedback">

                                {{ $message }}

                            </span>

                        @enderror

                    </div>

                    <!-- OPTIONS -->

                    <div class="login-options">

                        <label class="remember-box">

                            <input type="checkbox"
                                   name="remember">

                            <span>
                                Recordarme
                            </span>

                        </label>

                        @if (Route::has('password.request'))

                            <a href="{{ route('password.request') }}"
                               class="forgot-link">

                                ¿Olvidaste tu contraseña?

                            </a>

                        @endif

                    </div>

                    <!-- BUTTON -->

                    <button type="submit"
                            class="btn-primary"
                            style="width:100%;">

                        Iniciar sesión →

                    </button>

                </form>

                <!-- DIVIDER -->

                <div class="modern-divider">

                    <span>
                        continuar con
                    </span>

                </div>

                <!-- GOOGLE -->

                <a href="{{ route('google.login') }}"
                   class="google-button">

                    <img src="https://www.google.com/favicon.ico"
                         width="18">

                    Google

                </a>

                <!-- FOOTER -->

                <div class="auth-switch">

                    ¿No tienes cuenta?

                    <a href="{{ route('register') }}">

                        Crear cuenta

                    </a>

                </div>

            </div>

        </section>

        <!-- RIGHT -->

        <section class="hero-visual">

            <!-- 3D ORB -->

            <div class="orb"></div>

            <!-- FLOATING PANELS -->

            <div class="float-card card-1">

                <div class="card-label">

                    SESIÓN

                </div>

                <div class="card-value">

                    Seguridad activa

                </div>

            </div>

            <div class="float-card card-2">

                <div class="card-label">

                    ESTUDIANTES

                </div>

                <div class="card-value">

                    +15,000 conectados

                </div>

            </div>

        </section>

    </main>

</body>

</html>
