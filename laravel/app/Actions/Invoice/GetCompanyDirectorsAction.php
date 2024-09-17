<?php

namespace App\Actions\Invoice;

use App\Models\Company;

class GetCompanyDirectorsAction
{
    public function execute($company_id)
    {
        $company = Company::with('company_users')->where('id', $company_id)->first();
        $directors = $company->directors;
        return [$directors,$company];
    }

}
