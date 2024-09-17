<?php

namespace App\Actions\Company;

use App\Models\Company;

class OnKeyUpCompanySearchAction
{
    public function execute($search)
    {
        $companies=Company::with('companyServices')->where('name', 'LIKE', "%$search%")->get();
        $response=[];
        foreach ($companies as $company) {
            $response[] = array("value" => $company->id, "label" => $company->name, 'status' => $company->status);
        }
        return $response;
    }

}
