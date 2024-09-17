<?php

namespace App\Actions\Role;



//use App\Models\Role;

use App\Interfaces\Role\StoreRoleInterface;
use Spatie\Permission\Models\Role;

class RoleCreateAction implements StoreRoleInterface
{
    public static function execute($data)
    {
        return Role::create($data);
    }

}
