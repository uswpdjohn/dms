<?php

namespace App\Actions\Company;

use App\Models\Company;

class CompanyFilterByNameAction
{
    public function execute($orderBy,$count)
    {
        $company=Company::with(['invoices' => function ($query){
            $query->whereDate('subscription_end', '>=', now())->orderBy('subscription_end', 'ASC')->first();
        }])
            ->orderBy('name', $orderBy)->paginate($count);
        return $company;

    }

}
