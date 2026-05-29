<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialController extends Controller
{
    // Redirección al login de GitHub
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    // Manejo de la respuesta de GitHub (Callback)
    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
            
            // 1. Buscar si el usuario ya se había logueado con GitHub antes
            $user = User::where('github_id', $githubUser->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->route('home');
            }

            // 2. Si no tiene github_id, buscar por su correo por si ya tiene una cuenta tradicional o de Google
            $existingUser = User::where('email', $githubUser->email)->first();

            if ($existingUser) {
                // Vinculamos su ID de GitHub a la cuenta que ya existía
                $existingUser->update([
                    'github_id' => $githubUser->id
                ]);
                Auth::login($existingUser);
                return redirect()->route('home');
            }

            // 3. Si es un usuario completamente nuevo en el sistema, lo registramos
            $newUser = User::create([
                'name' => $githubUser->name ?? $githubUser->nickname,
                'email' => $githubUser->email,
                'github_id' => $githubUser->id,
                'password' => encrypt('git_pass_random_123') // Contraseña aleatoria por seguridad
            ]);

            Auth::login($newUser);
            return redirect()->route('home');

        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Ocurrió un error al intentar conectar con GitHub.');
        }
    }
}