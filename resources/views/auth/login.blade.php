<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="auth-wrapper">

    <div class="auth-panel">
        <div class="auth-box">

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

            <h1 style="font-size:2rem;margin-bottom:0.4rem;">Bienvenido</h1>
            <p style="color:var(--muted);font-size:0.9rem;margin-bottom:2rem;">Ingresa tus credenciales para continuar</p>

            @if(session('error'))
                <div class="alert alert-danger" data-dismiss="4000">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Correo electrónico</label>
                    <input id="email" type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="tucorreo@ejemplo.com">
                    @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Contraseña</label>
                    <input id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required autocomplete="current-password" placeholder="••••••••">
                    @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
                    <div class="form-check" style="margin-bottom:0;">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Recordarme</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="btn-link">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary" style="margin-bottom:1rem;">
                    Iniciar sesión
                </button>
            </form>

            <div class="divider">o</div>

            <a href="{{ route('google.login') }}" class="btn btn-google">
                <img src="https://www.google.com/favicon.ico" alt="Google">
                Continuar con Google
            </a>

            <div class="auth-footer">
                ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate gratis</a>
            </div>

        </div>
    </div>

    <div class="auth-visual">
        <p class="visual-quote">Tu camino académico,<br><span>organizado y simple</span></p>
        <div class="visual-dots"><span></span><span></span><span></span></div>
    </div>

</div>
</body>
</html>