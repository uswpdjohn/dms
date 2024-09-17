<?php

namespace App\Actions\Notification;

use Illuminate\Support\Facades\DB;

class NotificationMarkAsUnreadAction
{
    public function execute($id)
    {
        $explodedId=explode(',',$id);
        return DB::table('notifications')->whereIn('id', $explodedId)->update(['read_at' => null]);
    }

}
