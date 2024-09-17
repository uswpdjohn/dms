<?php

namespace App\Actions\Mailbox;

use App\Interfaces\Mailbox\ListMailboxInterface;
use App\Models\Mailbox;

use Illuminate\Support\Facades\DB;

class MailboxListAction implements ListMailboxInterface
{
    public static function execute($request,$count,$orderBy,$companyId)
    {

//        $companies=DB::table('company_users')->where('user_id', auth()->user()->id ?? '')->pluck('company_id');
//        if ($request->has('search')){
//            $mails= Mailbox::whereIn('company_id',$companyId)->where('from','LIKE', "%$request->search%")->orWhere('title','LIKE', "%$request->search%")
//                ->orderBy('created_at', $orderBy)
//                ->paginate($count);
//            return $mails;
//        }
        $data=Mailbox::query();

        if($request['search'] == '0'){
            if ($request['category'] != 'all'){
                if ($request['priority'] != 'all'){
                    $data= $data->where('company_id', $companyId)->where('category', $request['category'])->where('priority', $request['priority']);
                }else{
                    $data= $data->where('company_id', $companyId)->where('category', $request['category']);
                }
            }else{
                if ($request['priority'] != 'all') {
                    $data = $data->where('company_id', $companyId)->where('priority', $request['priority']);
                }else{
                    $data = $data->where('company_id', $companyId);
                }
            }
        }else{
            $data = $data->where('company_id', $companyId);
        }


        $data=$data->where('company_id', $companyId)->orderBy('id',$orderBy)->paginate($count);
        return $data;

    }

}
