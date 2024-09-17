<?php

namespace App\Actions\Mailbox;

use App\Models\Mailbox;

class MailboxGetMailByCompanyAction
{
    public function execute($id,$orderBy,$count)
    {
        $mails= Mailbox::with('companies')->where('company_id',$id)
            ->orderBy('created_at', $orderBy)
            ->paginate($count);
        return $mails;
    }
}
