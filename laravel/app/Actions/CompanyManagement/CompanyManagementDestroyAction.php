<?php

namespace App\Actions\CompanyManagement;

use App\Interfaces\CompanyManagement\DeleteCompanyManagementInterface;
use App\Models\CompanyManagement;

class CompanyManagementDestroyAction implements DeleteCompanyManagementInterface
{

    public static function execute($data)
    {
        $company_management=CompanyManagement::whereSlug($data['slug'])->first();
        $company_management->delete();
        if (response($company_management)->getStatusCode() == 200){
                return $response  = array('success' => '1', 'message'=>'Company User Deleted Successfully');
        }
    }
}
