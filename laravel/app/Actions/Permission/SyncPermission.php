<?php


namespace App\Actions\Permission;


use App\Models\User;
use Spatie\Permission\Models\Role;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class SyncPermission
{
    public function execute($permissionReceiver, array $permissionArray): Object
    {

        if (!($permissionReceiver instanceof User) && !($permissionReceiver instanceof Role) ) {
            throw new NotFoundResourceException('Cannot set permission to the object');
        }


        return $permissionReceiver->syncPermissions($permissionArray);
    }
}
