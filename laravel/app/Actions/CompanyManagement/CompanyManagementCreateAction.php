<?php

namespace App\Actions\CompanyManagement;

use App\Actions\Company\CompanyUserCreateAction;
use App\Interfaces\CompanyManagement\StoreCompanyManagementInterface;
use App\Models\CompanyManagement;

class CompanyManagementCreateAction implements StoreCompanyManagementInterface
{
    public static function execute($validatedData){
        try {
//            if($validatedData['role'] != null) {
//                // save data for user
//                $users = (new UserCreateAction())->execute($validatedData);
//                if (response($users)->getStatusCode() == 200) {
//                    return $response = array(
//                        'success' => '1',
//                        'response' => $users,
//                        'message' => 'User Created Successfully'
//                    );
//                }
//            }
            // save data for director or shareholder
//            $company_managements = CompanyManagement::create($validatedData);

            $company_management_users = CompanyManagement::where('email',$validatedData['email'])->first();
//            var_dump($company_management_users);die();
//            if ($company_management_users){

//                $company_users = DB::table('company_users')
//                    ->where('company_id', $validatedData['company_id'])
//                    ->where('user_type', $validatedData['user_type'])
//                    ->where('user_id',$company_management_users->id)
//                    ->get();
//                if (count($company_users) > 0){
//                    if ($validatedData['user_type'] == 'director') {
//                        return $response = array(
//                            'success' => '1',
//                            'response' => $company_management_users,
//                            'message' => 'Director is already exists in this company! '
//                        );
//                    } else {
//                        return $response = array(
//                            'success' => '1',
//                            'response' => $company_management_users,
//                            'message' => 'Shareholder is already exists in this company!'
//                        );
//                    }
//                }
//                $validatedData['user_id']=$company_management_users->id;
//                $response = (new CompanyUserCreateAction())->execute($validatedData);
//
//                if (response($response)->getStatusCode() == 200) {
//                    if ($validatedData['user_type'] == 'director') {
//                        return $response = array(
//                            'success' => '1',
//                            'response' => $company_management_users,
//                            'message' => 'Director Created Successfully'
//                        );
//                    } else {
//                        return $response = array(
//                            'success' => '1',
//                            'response' => $company_management_users,
//                            'message' => 'Shareholder Created Successfully'
//                        );
//                    }
//                }

//            }
//            else{
                $company_managements = new CompanyManagement();
                $company_managements->first_name = $validatedData['first_name'];
                if(key_exists('last_name',$validatedData)){

                    $company_managements->last_name = $validatedData['last_name'];
                }
                $company_managements->email = $validatedData['email'];
                $company_managements->ccs = $validatedData['ccs'];
                $company_managements->save();
                $validatedData['user_id']=$company_managements->id;
                (new CompanyUserCreateAction())->execute($validatedData);
                if (response($company_managements)->getStatusCode() == 200) {
                    if ($validatedData['user_type'] == 'director'){
                        return $response = array(
                            'success' => '1',
                            'response' => $company_managements,
                            'message' => 'Director Created Successfully'
                        );
                    }else{
                        return $response = array(
                            'success' => '1',
                            'response' => $company_managements,
                            'message' => 'Shareholder Created Successfully'
                        );
                    }

                }
                return $company_managements;
//            }


        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }

}
