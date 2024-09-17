<?php

namespace App\Actions\Mailbox;

use App\Interfaces\Mailbox\GetAdminMailByPriorityInterface;
use App\Models\Mailbox;
use Illuminate\Support\Facades\DB;

class MailboxGeAdminMailByPriorityAction implements GetAdminMailByPriorityInterface
{
    public static function execute($request,$priority,$orderBy,$count)
    {
        $data = Mailbox::query();
        if ($priority=='all'){
            if ($request['category'] != 'all'){
                $data = $data->where('category', $request['category']);
            }
            $data = $data->with('companies')
                ->whereHas('companies')
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
                ->where('priority',$priority)
                ->orderBy('created_at', $orderBy)
                ->paginate($count);
            $mails = $data;
            return $mails;
        }











        if ($priority=='all'){
            $mails= Mailbox::with('companies')->whereIn('priority',['new', 'urgent'])
                ->orderBy('created_at', $orderBy)
                ->paginate($count);
            return $mails;
        }
        $mails= Mailbox::with('companies')->where('priority',$priority)
            ->orderBy('created_at', $orderBy)
            ->paginate($count);
        return $mails;
    }

}
