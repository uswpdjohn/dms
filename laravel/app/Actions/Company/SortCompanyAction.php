<?php

namespace App\Actions\Company;

use App\Models\Company;

class SortCompanyAction
{
    public function execute($sortBy,$currentDirection,$count)
    {
        try {
            $direction='';
            if ($currentDirection == 'DESC'){
               $direction= 'ASC';
            }else{
                $direction='DESC';
            }
            if ($sortBy == 'next_renewal'){
                $company=Company::with(['invoices' => function ($query) use ($direction) {
                    $query->whereDate('subscription_end', '>=', now())->orderBy('subscription_end', $direction)->first();
                }])->orderBy('created_at', 'DESC')->paginate($count);
            }else{
                if(auth()->user()->hasRole('Company Owner')){
                    $company=Company::where('created_by', auth()->user()->id)->orderBy($sortBy, $direction)->paginate($count);
                }
                elseif(auth()->user()->hasRole('Employee')){
                    $company=Company::where('created_by', auth()->user()->created_by)->orderBy($sortBy, $direction)->paginate($count);
                }else{
                    $company=Company::with(['invoices' => function ($query){
                        $query->whereDate('subscription_end', '>=', now())->orderBy('subscription_end', 'ASC')->first();
                    }])->orderBy($sortBy, $direction)->paginate($count);
                }

            }
            return $company;


        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
//            return $exception->getMessage();
        }

    }

}
