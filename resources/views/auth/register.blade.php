<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrarse — {{ config('app.name') }}</title>
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

            <h1 style="font-size:2rem;margin-bottom:0.4rem;">Crear cuenta</h1>
            <p style="color:var(--muted);font-size:0.9rem;margin-bottom:2rem;">Únete y empieza a gestionar tu matrícula</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="name">Nombre completo</label>
                    <input id="name" type="text" name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required autocomplete="name" autofocus
                        placeholder="Juan Pérez">
                    @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Correo electrónico</label>
                    <input id="email" type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autocomplete="email"
                        placeholder="tucorreo@ejemplo.com">
                    @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Contraseña</label>
                    <input id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
                    @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group" style="margin-bottom:1.5rem;">
                    <label class="form-label" for="password-confirm">Confirmar contraseña</label>
                    <input id="password-confirm" type="password" name="password_confirmation"
                        class="form-control" required autocomplete="new-password"
                        placeholder="Repite tu contraseña">
                </div>

                <button type="submit" class="btn btn-primary">Crear mi cuenta</button>
            </form>

            <div class="auth-footer">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a>
            </div>

        </div>
    </div>

    <div class="auth-visual">
        <p class="visual-quote">Un paso hacia<br><span>tu futuro académico</span></p>
        <div class="visual-dots"><span></span><span></span><span></span></div>
    </div>

</div>
</body>
</html>