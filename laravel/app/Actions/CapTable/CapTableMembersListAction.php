<?php

namespace App\Actions\CapTable;

use App\Helpers\CapTableCompanyHelper;
use App\Models\CapTableActivity;
use App\Models\Company;
use App\Models\CompanyMember;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CapTableMembersListAction
{
    public function execute($search,$asOn,$count,$company_id)
    {

        if($asOn){
            $data=CompanyMember::with(['capTableActivity' => function  ($query) use ($asOn) {
                $query->whereDate('transaction_date', '<=', $asOn);
            }, 'capTableSum' => function  ($query) use ($asOn) {
                $query->whereDate('transaction_date', '<=', $asOn);
            },'capTableTotalShareSum' => function  ($query) use ($asOn) {
                $query->whereDate('transaction_date', '<=', $asOn);
            }])->where('company_id', $company_id);

        }else{
//            $data=CompanyMember::with(['capTableActivity', 'capTableSum','capTableTotalShareSum' ])->where('company_id', $company_id);
            $data=CompanyMember::with(['capTableActivity', 'capTableSum','capTableTotalShareSum' ])->whereHas('capTableActivity')->whereHas( 'capTableSum')->whereHas('capTableTotalShareSum')->where('company_id', $company_id);
        }

//        if ($asOn){
//            $data=$data->whereHas('capTableActivity',function ($query) use ($asOn) {
//                $query->whereDate('transaction_date', '<=', $asOn);
//            })->whereHas('capTableSum',function ($query) use ($asOn) {
//                $query->whereDate('transaction_date', '<=', $asOn);
//            })->whereHas('capTableTotalShareSum',function ($query) use ($asOn) {
//                $query->whereDate('transaction_date', '<=', $asOn);
//            });
//        }
        if ($search != ''){
            $data = $data->where('name', 'like', '%' . $search . '%');
        }
        $data= $data->paginate(10)->appends(array('search' => $search));

        $grandSum= CompanyMember::withSum('capTableTotalShareSum', 'share_number')->where('company_id', $company_id)->get();

        if($asOn){
            $grandSum= CompanyMember::withSum(['capTableTotalShareSum' => function ($query) use ($asOn){
                $query->whereDate('transaction_date', '<=', $asOn);
            }], 'share_number')->where('company_id', $company_id)->get();

        }



        $total = 0; // sum of each total # of share
        foreach ($grandSum as $res){

            $total+=$res->cap_table_total_share_sum_sum_share_number;

        }

        return ['data'=>$data,'total'=>$total];

    }
}
