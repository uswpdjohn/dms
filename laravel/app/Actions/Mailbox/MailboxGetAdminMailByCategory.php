<?php

namespace App\Actions\Mailbox;

use App\Interfaces\Mailbox\GetAdminMailByCategoryInterface;
use App\Models\Mailbox;
use Illuminate\Support\Facades\DB;

class MailboxGetAdminMailByCategory implements GetAdminMailByCategoryInterface
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
                ->where('category', $category)
                ->orderBy('created_at', $orderBy)
                ->paginate($count);
            $mails = $data;
            return $mails;
        }









//        if ($category=="all"){
//            $mails= Mailbox::with('companies')->whereIn('category', ["mailbox","corporate_secretary","gst_report","accounting","human_resource"])
//                ->orderBy('created_at', $orderBy)
//                ->paginate($count);
//            return $mails;
//
//        }
//        $mails= Mailbox::with('companies')
//            ->where('category', $category)
//            ->orderBy('created_at', $orderBy)
//            ->paginate($count);
//        return $mails;
    }

}
