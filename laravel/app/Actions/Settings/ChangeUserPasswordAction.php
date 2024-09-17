<?php

namespace App\Actions\Settings;

use App\Models\User;

class ChangeUserPasswordAction
{
    public function execute($validatedData,$slug)
    {
        $user = User::whereSlug($slug)->first();

    }


}
