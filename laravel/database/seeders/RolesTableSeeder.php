<?php

namespace Database\Seeders;

use App\Actions\Permission\SyncPermission;
use App\Actions\Role\RoleCreateAction;
use App\Interfaces\Role\StoreRoleInterface;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(StoreRoleInterface $interface)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $roles = [
//            [
//                'name'=> 'Super Admin',
////                'parent_name'=> 'Super Admin',
////                'status'=>'active'
//            ],
            [
                'name'=> 'Admin',

            ],
            [
                'name'=> 'Company Owner',

            ],
            [
                'name'=> 'Employee',
            ],
            [
                'name'=> 'General User',

            ],
            [
                'name'=> 'Company User',

            ],
        ];
        foreach ($roles as $r){
             $interface->execute($r);
//            $role= (new RoleCreateAction())->execute($r);
//            if ($r['name'] == 'Company User'){
//                $permission =['index.mailbox_customer','index.support_ticket_customer','view.support_ticket','index.billing_customer','view.customer_dashboard', 'index.document_management_customer','create.support_ticket'];
//                (new SyncPermission())->execute($role, $permission);
//            }

        }
    }
}
