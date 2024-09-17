<?php

namespace App\Actions\CompanyManagement;

use App\Models\Company;

class CompanyManagementShowAction
{
    public function execute($id)
    {
        try {
            $company=Company::with(['directors','shareholders','users'])
//            ->has('company_users')
//            ->orHas('users')
                ->where('id',$id)
                ->first();
//                ->firstOrFail();
            return $company;
        }catch (\Exception $exception){
            return $exception->getCode();
        }

    }
}
