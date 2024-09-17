<?php

namespace App\Actions\Company;

use App\Interfaces\Company\RemoveCompanyUserInterface;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class RemoveUserFromCompanyAction implements RemoveCompanyUserInterface
{
    public static function execute($data)
    {
        DB::beginTransaction();
        try {
            $company= Company::where('id',$data['company_id'])->first();
            DB::table('company_users')->where('company_id',$data['company_id'])
                ->where('user_id',$data['slug'])
                ->where('user_type',$data['user_type'])
                ->delete();
            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }



    }
}
