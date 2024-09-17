<?php

namespace App\Actions\Notification;

use Illuminate\Support\Facades\DB;

class NotificationListAction
{
    public function execute($count)
    {
        $notifications=[];
        if (auth()->user()){
            return auth()->user()->notifications()->paginate($count);
        }
       return $notifications;
    }

}
