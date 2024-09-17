<?php

namespace App\Actions\Mailbox;

use App\Models\Mailbox;

class MailboxUpdateAction
{
    public function execute($id)
    {
        gettype($id) == 'string' ? $builder="where" : $builder="whereIn";
        $mails=Mailbox::$builder('id',$id)->update(['downloaded_at' => now()]);
        return $mails;

    }

}
