<?php

namespace App\Actions\Mailbox;

use App\Models\Mailbox;

class MailboxMarkAsDownloadedAction
{
    public function execute($id)
    {
        try {
            $explodedId=explode(',',$id);
            foreach ($explodedId as $id){
                $mails=Mailbox::where('id',$id)->first();
                $mails->update(['downloaded_at'=>now()]);
            }
//            return $mails;

        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }

}
