<?php

namespace App\Actions\User;

use App\Actions\Company\CompanyUserCreateAction;
use App\Actions\Permission\SyncPermission;
use App\Helpers\MailHelper;
use App\Interfaces\User\StoreUserInterface;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use Spatie\Permission\Models\Role;
use function Composer\Autoload\includeFile;

class UserCreateAction implements StoreUserInterface
{
    public static function execute($validatedData){
        if(array_key_exists('registered_as', $validatedData)){
            if($validatedData['registered_as'] == 'individual'){
                $validatedData['role'] = 'General User';
            }else{
                $validatedData['role'] = 'Company Owner';
            }
        }
        $user = User::where('email',$validatedData['email'])->first();
        if($user){
            $responseArray = array();
            if(key_exists('company_id',$validatedData)){
                $registeredUser=[];
                $company = Company::with('users')->where('id', $validatedData['company_id'])->get();
                foreach ($company as $item){
                    foreach ($item->users as $u){
                        array_push($registeredUser,$u->id);
                    }
                }

                if (in_array($user->id,$registeredUser)){
                    return array(
                        'success' => true,
                        'message'=> 'User already exists'
                    );
//                    $message = 'User already exists';
//                    return [$user,$message];
                }
                $message = 'User already exists';
                $validatedData['user_id']=$user->id;
                (new CompanyUserCreateAction())->execute($validatedData);
                $responseArray =  array(
                    'success' => true,
                    'message'=> $message
                );
                return $responseArray;
            }else{
                return array(
                    'user_exists' => true,
                    'message'=> 'User already exists'
                );
//                $message = 'User already exists';
//                return [$user,$message];
            }
        }else{
            DB::beginTransaction();
            try {
                $user_create = new User();
                if($validatedData['role'] == 'Employee'){
                    if(auth()->guard('web')->user()->hasRole('Company Owner')){
                        $user_create->created_by = auth()->user()->id;
                    }else{
                        $user_create->created_by = auth()->user()->created_by;
                    }

                }

                $user_create->first_name=$validatedData['first_name'];
                if(key_exists('last_name', $validatedData)){

                    $user_create->last_name=$validatedData['last_name'];
                }
                $user_create->email=$validatedData['email'];
                $user_create->remember_token = Str::random(80);
                if (key_exists('designation',$validatedData)){
                    if ($validatedData['designation'] != null){
                        $user_create->designation=$validatedData['designation'];
                    }else{
                        $user_create->designation=$validatedData['role'];
                    }
                }else{
                    $user_create->designation= $validatedData['role'];
                }
                $user_create->save();
                $role=Role::whereName($validatedData['role'])->first();
                if ($role){
                    $user_create->assignRole($role);
                }
                if(key_exists('company_id',$validatedData)){
                    $validatedData['user_id']=$user_create->id;
                    (new CompanyUserCreateAction())->execute($validatedData);
                }
                if($validatedData['role'] == 'General User'){
                    Company::create([
                        'name' => $validatedData['first_name'],
                        'uen' => Str::random(10),
                        'created_by' => $user_create->id,
                    ]);
                }

                //assign permission
                if(key_exists('permission',$validatedData)) {

                    $permissionId=[];
                    $permissionName=[];

                    foreach ($validatedData['permission'] as $p){
                        array_push($permissionId,explode('-',$p)[0]);
//                        array_push($permissionName,explode('-',$p)[1]);
                        $permissionName[]=explode('-',$p)[1];

//                        if (in_array('view.billing', $permissionName) || in_array('edit.billing',$permissionName) ||in_array('create.billing',$permissionName) || in_array('delete.billing',$permissionName)){
//                            array_push($permissionId,'7', '10'); //index.billing_admin
////                            array_push($permissionId,'10' );
//                        }
//                        if (in_array('view.mailbox', $permissionName) || in_array('create.mailbox',$permissionName) || in_array('edit.mailbox',$permissionName)|| in_array('delete.mailbox',$permissionName)){
//                            array_push($permissionId,'2','10'); //index.mailbox_admin
////                            array_push($permissionId,'10');
//                        }
//                        if (in_array('view.company_management', $permissionName)||in_array('create.company_management', $permissionName)||in_array('edit.company_management', $permissionName)||in_array('delete.company_management', $permissionName)){
//                            array_push($permissionId,'27','10'); //index.company_management
////                            array_push($permissionId,'10');
//                        }
//                        if (in_array('view.document_management', $permissionName)||in_array('create.document_management', $permissionName)||in_array('edit.document_management', $permissionName)||in_array('delete.document_management', $permissionName)){
//                            array_push($permissionId,'3','10'); //index.document_management_admin
////                            array_push($permissionId,'10'); //index.document_management_admin
//                        }
//                        if (in_array('view.support_ticket', $permissionName)||in_array('create.support_ticket', $permissionName)||in_array('edit.support_ticket', $permissionName)){
//                            array_push($permissionId,'5','10' ); //index.support_ticket_admin
////                            array_push($permissionId,'10'); //index.support_ticket_admin
//                        }
//                        if (in_array('view.user_management', $permissionName)||in_array('create.user_management', $permissionName)||in_array('edit.user_management', $permissionName)||in_array('delete.user_management', $permissionName)){
//                            array_push($permissionId,'15', '10'); //index.user_management
////                            array_push($permissionId,'10'); //index.user_management
//                        }
                    }
//                    (new SyncPermission())->execute($user_create, array_unique($permissionId));
                    (new SyncPermission())->execute($user_create, array_unique($permissionName));
                }
                //send magic link
                $details = [
                    'name' => $user_create->first_name . ' ' . $user_create->last_name,
                    'subject' => 'USW-MSC | Set Account Password',
                    'body' => "You are receiving this email because an account has been created & you are required to set password to login. Please click on the button below to update your account password.",
                    'to' => $validatedData['email'],
                    'remember_token'=>$user_create->remember_token
                ];
                try {
                    $mail = new MailHelper($details);
                    $mail->sendMail();
                }catch (\Exception $exception){
                    throw new \Exception($exception->getMessage());
//                    return ['send_mail' => false];
                }

//                event(new Registered($user_create)); //for email verification
                DB::commit();

                return array(
                    'success' => true,
                    'message'=> 'User Created Successfully'
                );

            }catch (\Exception $exception){
                DB::rollBack();
                return $exception->getMessage();
            }
        }
    }
}
