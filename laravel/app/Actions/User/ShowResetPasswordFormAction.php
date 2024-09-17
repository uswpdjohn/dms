<?php

namespace App\Actions\User;

use App\Http\Controllers\UserController;
use http\Client\Curl\User;

class ShowResetPasswordFormAction
{
    public function execute($token)
    {
        $user = \App\Models\User::where('remember-token',$token)->findOrFail();

    }

}
