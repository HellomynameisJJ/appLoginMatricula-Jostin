<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>
        Verificar Correo — {{ config('app.name') }}
    </title>

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@200;300;400;500;600;700&display=swap"
          rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <!-- BLOBS -->

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <!-- VERIFY -->

    <div class="verify-wrapper">

        <div class="verify-card">

            <!-- 3D LOGO -->

            <div class="verify-3d-logo">

                <div class="verify-ring ring-a"></div>

                <div class="verify-ring ring-b"></div>

                <div class="verify-core">
                    ✦
                </div>

            </div>

            <!-- BADGE -->

            <div class="verify-badge">

                <div class="verify-badge-dot"></div>

                Protección activa

            </div>

            <!-- TITLE -->

            <h1 class="verify-main-title">

                Verifica tu
                <span>correo electrónico</span>

            </h1>

            <!-- TEXT -->

            <p class="verify-modern-text">

                Hemos enviado un enlace de validación
                a tu correo electrónico para activar
                todas las funciones inteligentes
                de la plataforma académica.

            </p>

            <!-- ALERT -->

            @if (session('resent'))

                <div class="verify-alert">

                    Se envió un nuevo enlace de verificación.

                </div>

            @endif

            <!-- BUTTON -->

            <form method="POST"
                  action="{{ route('verification.resend') }}">

                @csrf

                <button type="submit"
                        class="dashboard-btn-primary verify-btn">

                    Reenviar correo

                </button>

            </form>

            <!-- LOGOUT -->

            <form method="POST"
                  action="{{ route('logout') }}"
                  style="margin-top:1.5rem;">

                @csrf

                <button type="submit"
                        class="dashboard-btn-secondary verify-btn-secondary">

                    Cerrar sesión

                </button>

            </form>

        </div>

    </div>

</body>

</html>
