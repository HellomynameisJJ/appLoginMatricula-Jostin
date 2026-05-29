<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar contraseña — {{ config('app.name') }}</title>
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
        <div class="auth-logo">→</div>
        <h1 class="auth-title">Recupera tu acceso</h1>
        <p class="auth-desc">Ingresa tu correo y te enviamos un enlace para restablecer tu contraseña.</p>

        @if (session('status'))
            <div class="alert alert-ok" data-dismiss="6000">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="field">
                <label class="field-label">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="field-input @error('email') is-invalid @enderror"
                    placeholder="correo@universidad.com"
                    required autocomplete="email" autofocus>
                @error('email')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="btn btn-fill btn-full">Enviar enlace →</button>
        </form>

        <div class="auth-foot">
            <a href="{{ route('login') }}">← Volver al login</a>
        </div>
    </div>
</main>

</body>
</html>