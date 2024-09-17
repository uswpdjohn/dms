<?php

namespace App\Actions\Role;


use App\Models\Role;


class RoleListAction
{
    public function execute(){
        $item = Role::all();
        return $item;
    }
}
