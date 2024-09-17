<?php

namespace App\Actions\CompanyManagement;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CompanyManagementListAction
{
    public function execute()
    {
//        $company=Company::all();
//        $companyId=[];
//        foreach ($company as $item){
//            array_push($companyId,$item->id);
//        }
//        $company_services= DB::table('company_services')->whereIn('company_id', [1])->get();
//        $sub_start=$company_services[0]->subscription_start;
//        $add_year=$company_services->max('subscription_period');
//
//        $x=Carbon::parse($sub_start)->addYears($add_year)->format('d M Y');
//        return $x;
//            ->max('subscription_period');

    }

}
