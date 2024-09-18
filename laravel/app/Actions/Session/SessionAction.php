<?php

namespace App\Actions\Session;

use App\Models\CompanyUserSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SessionAction
{
    public function execute()
    {

        $companies=auth()->user()->companies;
        if(!$companies->isEmpty()){
            $data =CompanyUserSession::where('key', 'company_id')->first();
            $data->update(['value'=> $companies[0]->id]);
        }
    }

}
