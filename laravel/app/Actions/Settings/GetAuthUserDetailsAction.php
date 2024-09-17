<?php

namespace App\Actions\Settings;

use Illuminate\Support\Facades\Auth;

class GetAuthUserDetailsAction
{
    public function execute()
    {
        $user = Auth::guard('web')->user();
        return $user;

    }

}
