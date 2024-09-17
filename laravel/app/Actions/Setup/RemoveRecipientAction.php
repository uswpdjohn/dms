<?php

namespace App\Actions\Setup;

use App\Models\Recipient;

class RemoveRecipientAction
{
    public function execute($recipient_id)
    {
        $recipient = Recipient::where('id', $recipient_id)->first();
        return $recipient->delete();

    }

}
