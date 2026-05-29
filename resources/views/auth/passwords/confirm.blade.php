<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmar contraseña — {{ config('app.name') }}</title>
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
        <div class="auth-logo">🔒</div>
        <h1 class="auth-title">Confirma tu contraseña</h1>
        <p class="auth-desc">Por seguridad, verifica tu contraseña antes de continuar.</p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="field">
                <label class="field-label">Contraseña</label>
                <input type="password" name="password"
                    class="field-input @error('password') is-invalid @enderror"
                    placeholder="••••••••" required autocomplete="current-password">
                @error('password')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="btn btn-fill btn-full">Confirmar →</button>
        </form>

        @if (Route::has('password.request'))
            <div class="auth-foot">
                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            </div>
        @endif
    </div>
</main>

</body>
</html>