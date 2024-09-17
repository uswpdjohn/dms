<?php

namespace App\Actions\Notification;

use Illuminate\Support\Facades\DB;

class NotificationDeleteMarkedAction
{
    public function execute($id)
    {
        $explodedId=explode(',', $id);
        return DB::table('notifications')->whereIn('id', $explodedId)->delete();
    }
}
