<?php

namespace App\Actions\Notification;

class NotificationAdminListAction
{
    public function execute($count,$orderBy)
    {
        $notifications=[];
        if (auth()->user()){
            $notifications[] = auth()->user()->notifications()->paginate($count)->ordeBy('created_at',$orderBy);
//            $notifications = DB::table('notifications')->where('')->paginate($count);
        }
        return $notifications;
    }

}
