<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva contraseña — {{ config('app.name') }}</title>
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
        <h1 class="auth-title">Nueva contraseña</h1>
        <p class="auth-desc">Elige una contraseña segura para proteger tu cuenta.</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field">
                <label class="field-label">Correo electrónico</label>
                <input type="email" name="email" value="{{ $email ?? old('email') }}"
                    class="field-input @error('email') is-invalid @enderror"
                    placeholder="correo@universidad.com"
                    required autocomplete="email" autofocus>
                @error('email')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <label class="field-label">Nueva contraseña</label>
                <input type="password" name="password"
                    class="field-input @error('password') is-invalid @enderror"
                    placeholder="Mínimo 8 caracteres"
                    required autocomplete="new-password">
                @error('password')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <label class="field-label">Confirmar contraseña</label>
                <input type="password" name="password_confirmation"
                    class="field-input" placeholder="Repite tu contraseña"
                    required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-fill btn-full" style="margin-top:.4rem;">
                Restablecer contraseña →
            </button>
        </form>
    </div>
</main>

</body>
</html>