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
            if(auth()->user()->hasRole('Company Owner')){
                $company=$company->where('created_by', auth()->user()->id)->where('name', 'LIKE', "%$search%")->orderBy('created_at', $orderBy)->paginate($count);
            } elseif(auth()->user()->hasRole('Employee')){
                $company=$company->where('created_by', auth()->user()->created_by)->where('name', 'LIKE', "%$search%")->orderBy('created_at', $orderBy)->paginate($count);
            }else{
                $company=$company->where('name', 'LIKE', "%$search%")->orderBy('created_at', $orderBy)->paginate($count);
            }

        }else{
            if(auth()->user()->hasRole('Company Owner')){
                $company=$company->where('created_by', auth()->user()->id)->paginate($count);
            } elseif(auth()->user()->hasRole('Employee')){
                $company=$company->where('created_by', auth()->user()->created_by)->paginate($count);
            }else{
                $company=$company->orderBy('created_at', $orderBy)->paginate($count);
            }

        }

        return $company;

    }

}
