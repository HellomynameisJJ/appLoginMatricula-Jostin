<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verificar Correo — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:2rem;">
    <div class="auth-box" style="text-align:center;">

        <a href="/" class="logo" style="justify-content:center;margin-bottom:2.5rem;">
            <div class="logo-mark">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                    <path d="M2 17l10 5 10-5"/>
                    <path d="M2 12l10 5 10-5"/>
                </svg>
            </div>
            <span class="logo-text">{{ config('app.name') }}</span>
        </a>

        <div class="verify-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
            </svg>
        </div>

        <h2 class="verify-title">Verifica tu correo</h2>

        @if (session('resent'))
            <div class="alert alert-success" data-dismiss="5000">
                Se envió un nuevo enlace de verificación a tu correo.
            </div>
        @endif

        <p class="verify-text">
            Antes de continuar, revisa tu correo electrónico.<br>
            Si no recibiste el mensaje, podemos enviarte otro.
        </p>

        <form method="POST" action="{{ route('verification.resend') }}" style="margin-bottom:1.5rem;">
            @csrf
            <button type="submit" class="btn btn-primary">Reenviar correo de verificación</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-link">Cerrar sesión</button>
        </form>

    </div>
</div>
</body>
</html>