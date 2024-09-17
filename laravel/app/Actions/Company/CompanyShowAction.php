<?php

namespace App\Actions\Company;


use App\Interfaces\Company\ShowCompanyInterface;
use App\Models\Company;

class CompanyShowAction implements ShowCompanyInterface
{
    public static function execute($data){
//        $company = Company::with(['users','invoices' => function ($query){
//            $query->whereDate('subscription_end', '>=', now())->orderBy('subscription_end', 'ASC')->first();
//        }])->whereSlug($data['slug'])->first();
        $company = Company::with(['users'])->whereSlug($data['slug'])->first();
        return $company;
//        foreach ($company->users as $user){
//            return $user;
//        }
    }
}
