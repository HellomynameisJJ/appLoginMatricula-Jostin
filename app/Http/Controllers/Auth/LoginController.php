<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite; // Aseguramos el namespace correcto de Socialite
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // =========================================================================
    // OAUTH: GOOGLE
    // =========================================================================

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }    
    
    public function handleGoogleCallBack()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'      => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'password'  => bcrypt(uniqid()),
                ]
            );

            Auth::login($user, true);
            return redirect($this->redirectTo);

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Error al iniciar sesión con Google');
        }
    }

    // =========================================================================
    // OAUTH: GITHUB (Añadido para solucionar tu error)
    // =========================================================================

    public function redirectToGithub()
    {
        return Socialite::driver('github')->with(['prompt' => 'select_account'])->redirect();
    }

    public function handleGithubCallBack()
    {
        try {
            // 1. Obtenemos el usuario de GitHub
            $githubUser = Socialite::driver('github')->user();
    
            // Extraer el ID de forma segura
            $githubId = is_object($githubUser) && method_exists($githubUser, 'getId') 
                        ? $githubUser->getId() 
                        : ($githubUser['id'] ?? null);
    
            if (!$githubId && isset($githubUser->user['id'])) {
                $githubId = $githubUser->user['id'];
            }
    
            if (!$githubId) {
                throw new \Exception("No se pudo obtener el ID de GitHub.");
            }
    
            // 2. Buscamos usando DB puro para evitar el error de "Database [github] not configured"
            $dbUser = \DB::table('users')->where('github_id', $githubId)->first();
    
            if (!$dbUser) {
                // Si no existe por ID, preparamos el correo
                $email = $githubUser->getEmail() ?? ($githubUser->getNickname() ?? uniqid()) . '@github.com';
                
                // Creamos o actualizamos el usuario usando el Modelo
                $user = User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name'      => $githubUser->getName() ?? $githubUser->getNickname() ?? 'Usuario GitHub',
                        'github_id' => $githubId, 
                        'password'  => bcrypt(uniqid()), 
                    ]
                );
            } else {
                // Si ya existía, lo recuperamos a través del modelo User para poder loguearlo
                $user = User::find($dbUser->id);
                $user->update([
                    'name'  => $githubUser->getName() ?? $githubUser->getNickname() ?? $user->name,
                    'email' => $githubUser->getEmail() ?? $user->email,
                ]);
            }
    
            // 3. Autenticar y entrar al Home
            Auth::login($user, true);
            return redirect($this->redirectTo);
    
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Error con GitHub: ' . $e->getMessage());
        }
    }

    // =========================================================================
    // ADICIONAL
    // =========================================================================

    public function authenticated(\Illuminate\Http\Request $request, $user)
    {
        $device = $request->header('User-Agent');
        $request->session()->put('device', $device);
        /*$user->sessions()->create(['device'=> $device]);*/
    }
}