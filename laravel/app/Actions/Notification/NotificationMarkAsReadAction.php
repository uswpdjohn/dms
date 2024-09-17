<?php

namespace App\Actions\Notification;

use Illuminate\Support\Facades\DB;

class NotificationMarkAsReadAction
{
    public function execute($id)
    {

        $ids=explode(',',$id );
//        dd($id);
        return DB::table('notifications')->whereIn('id', $ids)->update(['read_at' => now()]);
    }

}
