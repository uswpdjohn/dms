<?php

namespace App\Actions\Role;



use App\Models\Role;

class RoleUpdateAction
{
    public function execute($validatedData,$slug){
        $item = Role::where('slug',$slug)->first();
        $item->update($validatedData);
        return $item;
    }
}
