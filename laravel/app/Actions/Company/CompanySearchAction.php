<?php

namespace App\Actions\Company;

use App\Models\Company;

class CompanySearchAction
{
    public function execute($search,$orderBy,$count)
    {
        $company = Company::query();

        if ($search != 0){
//            $company=$company->with(['invoices' => function ($query){
//                $query->whereDate('subscription_end', '>=', now())->orderBy('subscription_end', 'ASC')->first();
//            }])->where('name', 'LIKE', "%$search%")->orderBy('created_at', $orderBy)->paginate($count);

            $company=$company->where('name', 'LIKE', "%$search%")->orderBy('created_at', $orderBy)->paginate($count);
        }else{
            $company=$company->orderBy('created_at', $orderBy)->paginate($count);
        }

        return $company;

    }

}
