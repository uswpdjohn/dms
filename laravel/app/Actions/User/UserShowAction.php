<?php

namespace App\Actions\User;

use App\Interfaces\User\GetUserInterface;
use App\Models\User;

class UserShowAction implements GetUserInterface
{
    public static function execute($data){
        // dd($validatedData);
        $item = User::with(['roles','permissions'])->where('slug', $data['slug'])->first();
        return $item;
    }
}
