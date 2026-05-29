<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear cuenta — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<nav class="n">
    <a href="/" class="n-brand">
        <div class="n-logo">✦</div>
        <span class="n-name">{{ config('app.name') }}</span>
    </a>
</nav>

<main class="auth-page">
    <div class="auth-box">
        <div class="auth-logo">✦</div>
        <h1 class="auth-title">Crea tu cuenta</h1>
        <p class="auth-desc">Únete a la plataforma universitaria más moderna.</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field">
                <label class="field-label">Nombre completo</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="field-input @error('name') is-invalid @enderror"
                    placeholder="Juan Pérez" required>
                @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <label class="field-label">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="field-input @error('email') is-invalid @enderror"
                    placeholder="correo@universidad.com" required>
                @error('email')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <label class="field-label">Contraseña</label>
                <input type="password" name="password"
                    class="field-input @error('password') is-invalid @enderror"
                    placeholder="Mínimo 8 caracteres" required>
                @error('password')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <label class="field-label">Confirmar contraseña</label>
                <input type="password" name="password_confirmation"
                    class="field-input" placeholder="Repite tu contraseña" required>
            </div>

            <button type="submit" class="btn btn-fill btn-full" style="margin-top:.4rem;">
                Crear cuenta →
            </button>
        </form>

        <div class="auth-foot">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a>
        </div>
    </div>
</main>

</body>
</html>