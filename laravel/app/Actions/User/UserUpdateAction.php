<?php

namespace App\Actions\User;

use App\Actions\ActionClass;
use App\Actions\Permission\SyncPermission;
use App\Models\User;
use Complex\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class UserUpdateAction
{
    public function execute($validatedData, $slug){
        DB::beginTransaction();
        try {
            $item = User::whereSlug($slug)->first();
//            $validatedData['password']= bcrypt($validatedData['password']);
            $update_user = $item->update($validatedData);
            if ($update_user){
                if(key_exists('role',$validatedData)) {
                    $role = Role::whereName($validatedData['role'])->first();
                    if ($role) {
                        $item->syncRoles($role);
                        //set permission to role
//            $user_permissions=$validatedData['permissions'];
//            foreach ($user_permissions as $permission){
//                $role->givePermissionTo($permission);
//            }
                    }
                }
//                dd(key_exists('permission',$validatedData));
                if(!key_exists('permission',$validatedData)) {
                    $validatedData['permission'] = [];
                }
                if(key_exists('role', $validatedData) && count($validatedData['permission']) > 0 && $validatedData['role'] == 'Super Admin') {
                    Session::flash('error', 'Access right cannot be assigned to super admin');
                }
                if(key_exists('role', $validatedData) && $validatedData['role'] == 'Employee') {
                    $permissionId=[];
                    $permissionName=[];

                    foreach ($validatedData['permission'] as $p){
                        array_push($permissionId,explode('-',$p)[0]);
                        array_push($permissionName,explode('-',$p)[1]);
                    }
//                    if (in_array('view.billing', $permissionName) || in_array('edit.billing',$permissionName) ||in_array('create.billing',$permissionName) || in_array('delete.billing',$permissionName)){
//                        array_push($permissionId,'7', '10' ); //index.billing_admin
////                        array_push($permissionId,'10');
//                    }
//                    if (in_array('view.mailbox', $permissionName) || in_array('create.mailbox',$permissionName) || in_array('edit.mailbox',$permissionName)|| in_array('delete.mailbox',$permissionName)){
////                            dd('in1');
//                        array_push($permissionId,'2', '10'); //index.mailbox_admin
////                        array_push($permissionId,'10');
//                    }
//                    if (in_array('view.company_management', $permissionName)||in_array('create.company_management', $permissionName)||in_array('edit.company_management', $permissionName)||in_array('delete.company_management', $permissionName)){
////                            dd('in2');
//                        array_push($permissionId,'27','10' ); //index.company_management
////                            array_push($permissionId,'10' );
//                    }
//                    if (in_array('view.document_management', $permissionName)||in_array('create.document_management', $permissionName)||in_array('edit.document_management', $permissionName)||in_array('delete.document_management', $permissionName)){
////                            dd('in3');
//                        array_push($permissionId,'3','10'); //index.document_management_admin
////                        array_push($permissionId, '10');
//                    }
//                    if (in_array('view.support_ticket', $permissionName)||in_array('create.support_ticket', $permissionName)||in_array('edit.support_ticket', $permissionName)){
//                        array_push($permissionId,'5', '10' ); //index.support_ticket_admin
////                        array_push($permissionId,'10');
//                    }
//                    if (in_array('view.user_management', $permissionName)||in_array('create.user_management', $permissionName)||in_array('edit.user_management', $permissionName)||in_array('delete.user_management', $permissionName)){
//                        array_push($permissionId,'15','10'); //index.user_management
////                        array_push($permissionId,'10');
//                    }

//                    (new SyncPermission())->execute($item, array_unique($permissionId));
                    (new SyncPermission())->execute($item, array_unique($permissionName));
                }elseif (key_exists('role', $validatedData) && $validatedData['role'] == 'Company User'){
                    $permissionId=[];
                    $permissionName=[];
                    foreach ($validatedData['permission'] as $p){
                        array_push($permissionId,explode('-',$p)[0]);
                        array_push($permissionName,explode('-',$p)[1]);

                        if (in_array('view.billing', $permissionName) || in_array('edit.billing',$permissionName) ||in_array('create.billing',$permissionName) || in_array('delete.billing',$permissionName)){
                            array_push($permissionId,'8', '9'); //index.billing_admin
//                            array_push($permissionId, '9' );
                        } if (in_array('view.mailbox', $permissionName) || in_array('create.mailbox',$permissionName) || in_array('edit.mailbox',$permissionName)|| in_array('delete.mailbox',$permissionName)){
                            array_push($permissionId,'1' ); //index.mailbox_admin
                        } if (in_array('view.company_management', $permissionName)||in_array('create.company_management', $permissionName)||in_array('edit.company_management', $permissionName)||in_array('delete.company_management', $permissionName)){
                            array_push($permissionId,'9' ); //view customer dashboard
                        } if (in_array('view.document_management', $permissionName)||in_array('create.document_management', $permissionName)||in_array('edit.document_management', $permissionName)||in_array('delete.document_management', $permissionName)){
                            array_push($permissionId,'4', '9'); //index.document_management_admin
//                            array_push($permissionId,'9'); //index.document_management_admin
                        } if (in_array('view.support_ticket', $permissionName)||in_array('create.support_ticket', $permissionName)||in_array('edit.support_ticket', $permissionName)){
                            array_push($permissionId,'6', '9'); //index.support_ticket_admin
//                            array_push($permissionId,'9'); //index.support_ticket_admin
                        }
                    }
//                    (new SyncPermission())->execute($item,  array_unique($permissionId));
                    (new SyncPermission())->execute($item,  array_unique($permissionName));
                }
            }
            DB::commit();
            return $update_user;
        }catch (\Exception $exception){
            DB::rollBack();

            return $exception->getMessage();
        }

    }
}
