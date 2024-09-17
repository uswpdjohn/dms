<?php

namespace App\Actions\Role;



use App\Models\Role;

class RoleDestroyAction
{
    public function execute($slug){
        $item = Role::where('slug',$slug)->first();
        return $item->delete();
    }
}
