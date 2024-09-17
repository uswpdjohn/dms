<?php

namespace App\Actions\DocumentManagement;

use App\Models\CompanyManagement;
use App\Models\DocumentManagement;
use Illuminate\Support\Facades\DB;

class GetDirectorShareholderAction
{
    public function execute($company_id)
    {
//        $document = DocumentManagement::where('document_id',$document_id)->first();


        $company_users = DB::table('company_users')
            ->where('company_id',$company_id)
            ->whereIn('user_type', ['shareholder', 'director'])
            ->get();
        $shareholder = [];
        $director = [];
        foreach ($company_users as $item){
            if($item->user_type == 'director'){
                array_push($director,$item->user_id);
            }elseif($item->user_type == 'shareholder'){
                array_push($shareholder,$item->user_id);
            }
        }


        $shareholders = CompanyManagement::whereIn('id', $shareholder)->get();
        $directors = CompanyManagement::whereIn('id', $director)->get();

        return ['shareholders'=>$shareholders,'directors'=>$directors];

    }

}
