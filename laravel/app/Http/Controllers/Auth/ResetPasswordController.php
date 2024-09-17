<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Setup;
use App\Providers\RouteServiceProvider;
use Helper\Str;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
//        return $token;
        $login_bg_image = Setup::where('key', 'login_bg_image')->first();
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email,'login_bg_image'=>$login_bg_image['value']]
        );
    }
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => $password,
            'remember_token' => \Illuminate\Support\Str::random(15)
        ])->save();

        $this->guard()->login($user);
    }
}
