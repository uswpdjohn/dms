<?php

namespace App\Actions\Mailbox;

use App\Interfaces\Mailbox\GetMailByPriorityInterface;
use App\Models\Mailbox;
use Illuminate\Support\Facades\DB;

class MailboxGetMailByPriorityAction implements GetMailByPriorityInterface
{
    public static function execute($request,$priority,$orderBy,$count)
    {

//        $companies=DB::table('company_users')->where('user_id', auth()->user()->id ?? '')->where('company_id', \session()->get('auth_user_company')->id ?? '')->where('user_type', 'user')->pluck('company_id');
        $data = Mailbox::query();
        if ($priority=='all'){
            if ($request['category'] != 'all'){
                $data = $data->where('category', $request['category']);
            }
            $data = $data->with('companies')
                ->whereHas('companies')
                ->where('company_id', \session()->get('auth_user_company')->id)
                ->whereIn('priority',['new', 'urgent'])
                ->orderBy('created_at', $orderBy)
                ->paginate($count);
            $mails = $data;
            return $mails;
//            $mails= Mailbox::whereIn('priority',['new', 'urgent'])
//                ->whereIn('company_id',$companies)
//                ->orderBy('created_at', $orderBy)
//                ->paginate($count);
        }else{
            if ($request['category'] != 'all'){
                $data = $data->where('category', $request['category']);
            }
            $data = $data->with('companies')
                ->whereHas('companies')
                ->where('company_id', \session()->get('auth_user_company')->id)
                ->where('priority',$priority)
                ->orderBy('created_at', $orderBy)
                ->paginate($count);
            $mails = $data;
            return $mails;
        }

    }

}
