<?php

namespace App\Actions\Company;


use App\Models\CompanyServices;

class CompanyServicesCreateAction
{
    //not needed will be deleted
    public function execute($validatedData){
        $company_services = CompanyServices::create($validatedData);
        return $company_services;
    }
}
