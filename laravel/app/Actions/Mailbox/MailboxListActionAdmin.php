<?php

namespace App\Actions\Mailbox;

use App\Interfaces\Mailbox\ListAdminMailboxInterface;
use App\Models\Company;
use App\Models\Mailbox;
use Illuminate\Support\Facades\DB;

class MailboxListActionAdmin implements ListAdminMailboxInterface
{
    public static function execute($request,$count,$orderBy)
    {
//        dd($request);

//        if ($request->has('search')){
//          $companies=Company::where('name', 'LIKE', "%$request->search%")->get();
//          $companyId=[];
//          if ($companies != null){
//              foreach ($companies as $company){
//                  array_push($companyId, $company->id);
//              }
//              if(!empty($companyId)){
//                  $mails= Mailbox::with('companies')->WhereIn('company_id',($companyId))
//                      ->orderBy('created_at', $orderBy)
//                      ->paginate($count);
//                  return $mails;
//              }
//          }
//
//        $mails= Mailbox::with('companies')->where('title','LIKE', "%$request->search%")
//            ->orWhere('from','LIKE', "%$request->search%")
//            ->orderBy('created_at', $orderBy)
//            ->paginate($count);
//            return $mails;
//        }

        $data=Mailbox::query();
        if(auth()->guard('web')->user()->hasRole('Company Owner')){
            $company_ids= Company::where('created_by', auth()->user()->id)->pluck('id');
            $data->whereIn('company_id', $company_ids);
        }
        if(auth()->guard('web')->user()->hasRole('Employee')){
            $company_ids= Company::where('created_by', auth()->user()->created_by)->pluck('id');
            $data->whereIn('company_id', $company_ids);
        }

        if($request['search'] == '0'){
            if ($request['category'] != 'all'){
                if ($request['priority'] != 'all'){
                    $data= $data->with('companies')->whereHas('companies')->where('category', $request['category'])
                        ->where('priority', $request['priority']);
                }else{
                    $data= $data->with('companies')->whereHas('companies')->where('category', $request['category']);
                }
            }else{
                if ($request['priority'] != 'all') {
                    $data = $data->with('companies')->whereHas('companies')->where('priority', $request['priority']);
                }else{
                    $data = $data->with('companies')->whereHas('companies');
                }
            }

        }else{
            $data = $data->with('companies')->whereHas('companies');
        }
        $data= $data->with('companies')->whereHas('companies')
            ->orderBy('created_at', $orderBy)
            ->paginate($count);
        $response=$data;
//        $mails=Mailbox::with('companies')->whereHas('companies')->orderBy('created_at',$orderBy)->paginate($count);
        return $response;
    }

}
