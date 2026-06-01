@extends('layouts.app')

@section('title', 'Crear cuenta')

@section('content')
<div class="auth-page">
    <div class="auth-box">

        <div class="auth-logo">✦</div>
        <div class="auth-title">Crear cuenta</div>
        <div class="auth-desc">Únete a {{ config('app.name') }} y gestiona tu experiencia académica.</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field">
                <label class="field-label" for="name">Nombre completo</label>
                <input id="name" type="text" class="field-input @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                    placeholder="Tu nombre">
                @error('name')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label class="field-label" for="email">Correo electrónico</label>
                <input id="email" type="email" class="field-input @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email"
                    placeholder="tu@correo.com">
                @error('email')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label class="field-label" for="password">Contraseña</label>
                <input id="password" type="password" class="field-input @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password"
                    placeholder="Mínimo 8 caracteres">
                @error('password')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label class="field-label" for="password-confirm">Confirmar contraseña</label>
                <input id="password-confirm" type="password" class="field-input"
                    name="password_confirmation" required autocomplete="new-password"
                    placeholder="Repite tu contraseña">
            </div>

            <button type="submit" class="btn btn-fill btn-full" style="margin-top:.5rem;">
                Crear cuenta
            </button>
        </form>

        <div class="auth-foot">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a>
        </div>

    </div>
</div>
@endsection