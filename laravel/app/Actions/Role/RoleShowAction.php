<?php

namespace App\Actions\Role;



use App\Models\Role;

class RoleShowAction
{
    public function execute($slug){
        return Role::where('slug',$slug)->first();
    }
}
