<?php

namespace App\Actions\Invoice;

use App\Models\Company;

class GetCompanyDetailsAction
{
    public function execute($company_id)
    {
        $company = Company::where('id',$company_id)->first();
        return $company;
    }

}
