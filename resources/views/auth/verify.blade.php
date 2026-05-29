<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verificar correo — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<nav class="n">
    <a href="/" class="n-brand">
        <div class="n-logo">✦</div>
        <span class="n-name">{{ config('app.name') }}</span>
    </a>
</nav>

<main class="verify-page">
    <div class="verify-box">
        <div class="verify-icon">✉</div>

        <h1 class="verify-title">Verifica tu <span>correo.</span></h1>
        <p class="verify-text">
            Enviamos un enlace de validación a tu dirección de correo.
            Revisa tu bandeja de entrada y haz clic en el enlace para activar tu cuenta.
        </p>

        @if (session('resent'))
            <div class="verify-alert">Nuevo enlace de verificación enviado.</div>
        @endif

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-fill btn-full" style="margin-bottom:.7rem;">
                Reenviar correo
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-ghost btn-full">Cerrar sesión</button>
        </form>
    </div>
</main>

</body>
</html>