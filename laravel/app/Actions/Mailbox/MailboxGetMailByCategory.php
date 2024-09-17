<?php

namespace App\Actions\Mailbox;

use App\Interfaces\Mailbox\GetMailByCategoryInterface;
use App\Models\Mailbox;
use Illuminate\Support\Facades\DB;

class MailboxGetMailByCategory implements GetMailByCategoryInterface
{
    public static function execute($request,$category,$orderBy,$count)
    {
        $data = Mailbox::query();
        if ($category=='all'){
            if ($request['priority'] != 'all'){
                $data = $data->where('priority', $request['priority']);
            }
            $data = $data->with('companies')
                ->whereHas('companies')
                ->where('company_id', \session()->get('auth_user_company')->id)
                ->whereIn('category', ["mailbox","corporate_secretary","tax","accounting","human_resource"])
                ->orderBy('created_at', $orderBy)
                ->paginate($count);
            $mails = $data;
            return $mails;
        }else{
            if ($request['priority'] != 'all'){
                $data = $data->where('priority', $request['priority']);
            }
            $data = $data->with('companies')
                ->whereHas('companies')
                ->where('company_id', \session()->get('auth_user_company')->id)
                ->where('category', $category)
                ->orderBy('created_at', $orderBy)
                ->paginate($count);
            $mails = $data;
            return $mails;
        }



















//        $companies=DB::table('company_users')->where('user_id', auth()->user()->id ?? '')->where('company_id', \session()->get('auth_user_company')->id ?? '')->where('user_type', 'user')->pluck('company_id');
//        if ($category=="all"){
//            $mails= Mailbox::whereIn('company_id',$companies)->whereIn('category', ["mailbox","corporate_secretary","gst_report","accounting","human_resource"])
//                ->orderBy('created_at', $orderBy)
//                ->paginate($count);
//            return $mails;
//        }
//        $mails= Mailbox::whereIn('company_id',$companies)->where('category', $category)
//            ->orderBy('created_at', $orderBy)
//            ->paginate($count);
//        return $mails;


    }

}
