<?php

namespace App\Actions\Company;

use App\Models\Company;

class ChangeCompanyStatusAction
{
    public function execute($id)
    {
       $company = Company::where('id', $id)->first();
       if ($company->status == 'active'){
           $company->status = 'inactive';
       }else{
           $company->status = 'active';
       }
       $company->save();
       return $company->status;
    }

}
