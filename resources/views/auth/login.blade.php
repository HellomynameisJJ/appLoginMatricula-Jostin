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

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

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

    <main class="hero-layout">

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

            <div class="login-card">

                @if(session('error'))

                    <div class="alert alert-danger">

                        {{ session('error') }}

                    </div>

                @endif

                <form method="POST"
                      action="{{ route('login') }}">

                    @csrf

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

                    <button type="submit"
                            class="btn-primary"
                            style="width:100%;">

                        Iniciar sesión →

                    </button>

                </form>

                <div class="modern-divider">

                    <span>
                        continuar con
                    </span>

                </div>

                <div style="display: flex; gap: 12px; margin-top: 16px; width: 100%;">
                    
                    <a href="{{ route('google.login') }}" class="google-button" style="flex: 1; margin: 0; justify-content: center; gap: 8px;">
                        <img src="https://www.google.com/favicon.ico" width="18">
                        Google
                    </a>

                    <a href="{{ route('github.login') }}" class="google-button" style="flex: 1; margin: 0; justify-content: center; gap: 8px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z"/>
                        </svg>
                        GitHub
                    </a>

                </div>

                <div class="auth-switch">

                    ¿No tienes cuenta?

                    <a href="{{ route('register') }}">

                        Crear cuenta

                    </a>

                </div>

            </div>

        </section>

        <section class="hero-visual">

            <div class="orb"></div>

            <div class="float-card card-1">

                <div class="card-label">

                    SESIÓN

                </div>

                <div class="card-value">

                    Security activa

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