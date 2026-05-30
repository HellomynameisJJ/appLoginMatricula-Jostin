<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

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
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect();
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
    // OAUTH: GITHUB
    // =========================================================================

    public function redirectToGithub()
    {
        return Socialite::driver('github')->with(['prompt' => 'select_account'])->redirect();
    }

    public function handleGithubCallBack()
    {
        try {
            $githubUser = Socialite::driver('github')->stateless()->user();

            $githubId = is_object($githubUser) && method_exists($githubUser, 'getId')
                        ? $githubUser->getId()
                        : ($githubUser['id'] ?? null);

            if (!$githubId && isset($githubUser->user['id'])) {
                $githubId = $githubUser->user['id'];
            }

            if (!$githubId) {
                throw new \Exception("No se pudo obtener el ID de GitHub.");
            }

            $dbUser = \DB::table('users')->where('github_id', $githubId)->first();

            if (!$dbUser) {
                $email = $githubUser->getEmail() ?? ($githubUser->getNickname() ?? uniqid()) . '@github.com';

                $user = User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name'      => $githubUser->getName() ?? $githubUser->getNickname() ?? 'Usuario GitHub',
                        'github_id' => $githubId,
                        'password'  => bcrypt(uniqid()),
                    ]
                );
            } else {
                $user = User::find($dbUser->id);
                $user->update([
                    'name'  => $githubUser->getName() ?? $githubUser->getNickname() ?? $user->name,
                    'email' => $githubUser->getEmail() ?? $user->email,
                ]);
            }

            Auth::login($user, true);
            return redirect($this->redirectTo);

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Error con GitHub: ' . $e->getMessage());
        }
    }

    // =========================================================================
    // OAUTH: FACEBOOK
    // =========================================================================

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->with(['prompt' => 'select_account'])->redirect();
    }

    public function handleFacebookCallBack(Request $request)
    {
        if ($request->has('error') || $request->has('error_code')) {
            return redirect('/login')->with('error', 'El inicio de sesión con Facebook fue cancelado.');
        }

        try {
            $facebookUser = Socialite::driver('facebook')->user();

            $email = $facebookUser->getEmail() ?? ($facebookUser->getId() . '@facebook.com');

            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name'        => $facebookUser->getName() ?? 'Usuario Facebook',
                    'facebook_id' => $facebookUser->getId(),
                    'password'    => bcrypt(uniqid()),
                ]
            );

            Auth::login($user, true);
            return redirect($this->redirectTo);

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Error con Facebook: ' . $e->getMessage());
        }
    }

    // =========================================================================
    // OAUTH: BITBUCKET
    // =========================================================================

    public function redirectToBitbucket()
    {
        return Socialite::driver('bitbucket')->redirect();
    }

    public function handleBitbucketCallBack(Request $request)
    {
        if ($request->has('error')) {
            return redirect('/login')->with('error', 'El inicio de sesión con Bitbucket fue cancelado.');
        }

        try {
            $bitbucketUser = Socialite::driver('bitbucket')->user();

            $email = $bitbucketUser->getEmail() ?? ($bitbucketUser->getNickname() ?? uniqid()) . '@bitbucket.com';

            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name'         => $bitbucketUser->getName() ?? $bitbucketUser->getNickname() ?? 'Usuario Bitbucket',
                    'bitbucket_id' => $bitbucketUser->getId(),
                    'password'     => bcrypt(uniqid()),
                ]
            );

            Auth::login($user, true);
            return redirect($this->redirectTo);

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Error con Bitbucket: ' . $e->getMessage());
        }
    }

    // =========================================================================
    // EXTRA ADICIONAL
    // =========================================================================

    public function authenticated(\Illuminate\Http\Request $request, $user)
    {
        $device = $request->header('User-Agent');
        $request->session()->put('device', $device);
    }
}