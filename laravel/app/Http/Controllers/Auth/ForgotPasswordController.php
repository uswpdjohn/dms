<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Setup;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

//    public function showLinkRequestForm()
//    {
//        return view('auth.passwords.forgetPassword');
//    }
    public function showLinkRequestForm()
    {
        $login_bg_image = Setup::where('key', 'login_bg_image')->first();
        return view('auth.passwords.forgetPassword', ['login_bg_image'=>$login_bg_image['value']]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );
        if ($response){
            $login_bg_image = Setup::where('key', 'login_bg_image')->first();
            return view('auth.passwords.emailSent', ['login_bg_image'=>$login_bg_image['value']]);
        }

        $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);


    }
}
