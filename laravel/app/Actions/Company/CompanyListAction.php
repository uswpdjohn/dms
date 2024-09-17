<?php

namespace App\Actions\Company;


use App\Interfaces\Company\ListCompanyInterface;
use App\Models\Company;
use Carbon\Carbon;
use Cassandra\Date;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyListAction implements ListCompanyInterface
{
    public static function execute($request,$count, $orderBy){
        try {
//            $company=Company::with(['invoices' => function ($query){
//                $query->whereDate('subscription_end', '>=', now())->orderBy('subscription_end', 'ASC')->first();
//            }])
            if(\auth()->guard('web')->user()->hasRole('Company Owner')){
                $company=Company::where('created_by', \auth()->user()->id)->orderBy('created_at', $orderBy)->paginate($count);
                return $company;
            }
            if(\auth()->guard('web')->user()->hasRole('Employee')){
                $company=Company::where('created_by', \auth()->user()->created_by)->orderBy('created_at', $orderBy)->paginate($count);
                return $company;
            }
            $company=Company::orderBy('created_at', $orderBy)->paginate($count);
            return $company;


        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
}
