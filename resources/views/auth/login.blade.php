<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión — {{ config('app.name') }}</title>
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
        <h1 class="auth-title">Bienvenido de vuelta</h1>
        <p class="auth-desc">Ingresa tus credenciales para acceder a la plataforma.</p>

        @if(session('error'))
            <div class="alert alert-err" data-dismiss="5000">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label class="field-label">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="field-input @error('email') is-invalid @enderror"
                    placeholder="correo@universidad.com" required autocomplete="email">
                @error('email')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <label class="field-label">Contraseña</label>
                <input type="password" name="password"
                    class="field-input @error('password') is-invalid @enderror"
                    placeholder="••••••••" required autocomplete="current-password">
                @error('password')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="field-row">
                <label class="check">
                    <input type="checkbox" name="remember">
                    Recordarme
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn btn-fill btn-full">Iniciar sesión →</button>
        </form>

        <div class="hr"><span>o continúa con</span></div>

        <div class="oauth-row">
            <a href="{{ route('google.login') }}" class="oauth-btn">
                <img src="https://www.google.com/favicon.ico" width="15">
                Google
            </a>
            <a href="{{ route('github.login') }}" class="oauth-btn">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z"/>
                </svg>
                GitHub
            </a>
            {{-- AGREGADO: botón Bitbucket --}}
            <a href="{{ route('bitbucket.login') }}" class="oauth-btn">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="#0052CC">
                    <path d="M.778 1.213a.768.768 0 00-.768.892l3.263 19.81c.084.5.515.868 1.022.873H19.95a.772.772 0 00.77-.646l3.27-20.03a.768.768 0 00-.768-.891L.778 1.213zM14.52 15.53H9.522L8.17 8.466h7.561l-1.211 7.064z"/>
                </svg>
                Bitbucket
            </a>
        </div>{{-- fin .oauth-row --}}

        <div class="auth-foot">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Crear cuenta</a>
        </div>

    </div>{{-- fin .auth-box --}}
</main>

</body>
</html>