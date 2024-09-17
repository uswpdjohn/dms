<?php

namespace Database\Seeders;

use App\Models\SSIC;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissionArray = ['view', 'create', 'edit', 'delete'];

//        $moduleArray = [
//            ['name' => 'customer_dashboard', 'permission' => array_diff($permissionArray, ['create', 'edit', 'delete'])],
//            ['name' => 'admin_dashboard', 'permission' => array_diff($permissionArray, ['create', 'edit', 'delete'])],
//            ['name' => 'user', 'permission' => Arr::collapse([$permissionArray ,['index']])],
//            ['name' => 'mailbox', 'permission' => $permissionArray],
//            ['name' => 'ticket', 'permission' => Arr::collapse([$permissionArray ,['admin.support-ticket']] ) ],
//            ['name' => 'company_management', 'permission' => Arr::collapse([$permissionArray ])],
//            ['name' => 'company', 'permission' => Arr::collapse([$permissionArray ])]
//        ];
        //collapse is adding value to array

        $moduleArray = [
            ['name' => 'customer_dashboard', 'permission' => array_diff($permissionArray, ['create', 'edit', 'delete'])],
            ['name' => 'admin_dashboard', 'permission' => array_diff($permissionArray, ['create', 'edit', 'delete'])],
            ['name' => 'user_management', 'permission' => Arr::collapse([$permissionArray, ['index'] ])],
            ['name' => 'mailbox', 'permission' => $permissionArray],
//            ['name' => 'support_ticket', 'permission' => Arr::collapse([$permissionArray, ['index'] ]) ],
            ['name' => 'support_ticket', 'permission' => array_diff($permissionArray, ['delete'])],
            ['name' => 'company_management', 'permission' => Arr::collapse([$permissionArray, ['index'] ])],
//            ['name' => 'company', 'permission' => Arr::collapse([$permissionArray, ['index'] ])],
            ['name' => 'document_management', 'permission' => $permissionArray],
//            ['name' => 'billing', 'permission' => $permissionArray]
        ];

//        $permissions = collect($moduleArray)->map(function ($module) {
//            $name = $module['name'];
//            collect($module['permission'])->map(function ($p) use($name){
//                return ['name' => $p.'.'.$name, 'guard_name' => 'web'];
//            });
//        });

        $permissions = [
            ['name' => 'index.mailbox_customer', 'guard_name' => 'web'],
            ['name' => 'index.mailbox_admin', 'guard_name' => 'web'],
            ['name' => 'index.document_management_admin', 'guard_name' => 'web'],
            ['name' => 'index.document_management_customer', 'guard_name' => 'web'],
            ['name' => 'index.support_ticket_admin', 'guard_name' => 'web'],
            ['name' => 'index.support_ticket_customer', 'guard_name' => 'web'],
//            ['name' => 'index.billing_admin', 'guard_name' => 'web'],
//            ['name' => 'index.billing_customer', 'guard_name' => 'web'],
        ];
        foreach ($moduleArray as $module) {
            $name = $module['name'];
            foreach ($module['permission'] as $permission) {
                array_push($permissions, ['name' => $permission . '.' . $name, 'guard_name' => 'web']);
            }
        }


//        print_r($permissions);
        Permission::insert($permissions);

//        $arrayOfPermissionNames = [
//            'dashboard_customer_access',
//            'dashboard_admin_access',
//            'user_access',
//            'user_create',
//            'user_edit',
//            'user_show',
//            'user_delete',
//            'mailbox_customer_access',
//            'mailbox_admin_access',
//            'mailbox_create',
//            'mailbox_delete',
//            'ticket_access',
//            'ticket_create',
//            'ticket_edit',
//            'ticket_show',
//            'ticket_delete',
//            'company_management_access',
//            'company_management_create',
//            'company_management_edit',
//            'company_management_show',
//            'company_management_delete',
//            'company_access',
//            'company_create',
//            'company_edit',
//            'company_show',
//            'company_delete',
//        ];
//
//        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
//            return ['name' => $permission, 'guard_name' => 'web'];
//        });

//        print_r( $permissions->toArray() );
//        Permission::insert($permissions->toArray());
    }
}
