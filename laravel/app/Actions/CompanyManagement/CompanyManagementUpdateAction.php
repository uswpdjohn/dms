<?php

namespace App\Actions\CompanyManagement;

use App\Actions\User\UserUpdateAction;
use App\Models\CompanyManagement;
use Illuminate\Support\Facades\DB;

class CompanyManagementUpdateAction implements \App\Interfaces\CompanyManagement\UpdateCompanyManagementInterface
{
    public static function execute($validatedData,$slug)
    {
        DB::beginTransaction();
        try {
            $responseArray=array();
            if (key_exists("user_type",$validatedData)){
                if($validatedData["user_type"] =='user') {
                    // save data for user
                    $users = (new UserUpdateAction())->execute($validatedData,$slug);
                    return $users;
                }
            }
            $managements = CompanyManagement::whereSlug($slug)->first();
            $managements->update($validatedData);
            DB::commit();
            if($validatedData['user_type'] == 'director'){
                $responseArray = array(
                    'success' => true,
                    'user_type' => 'director'
                );
            }elseif ($validatedData['user_type'] == 'shareholder'){
                $responseArray = array(
                    'success' => true,
                    'user_type' => 'shareholder'
                );
            }
            return $responseArray;
        }catch (\Exception $exception){
            DB::rollBack();
            return array('error', true);
        }

    }

}
