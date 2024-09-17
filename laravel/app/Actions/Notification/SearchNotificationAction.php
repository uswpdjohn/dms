<?php

namespace App\Actions\Notification;

class SearchNotificationAction
{
    public function execute($search,$count)
    {

        $notifications=[];

        if (auth()->user()){
//            $notifications[] = auth()->user()->notifications()->paginate($count);
            if ($search!=0){
                return auth()->user()->notifications()->where('data->notification', 'LIKE', "%$search%")->paginate($count);
            }else{
                return auth()->user()->notifications()->paginate($count);
            }

//            $notifications = DB::table('notifications')->where('')->paginate($count);
        }
        return $notifications;
    }

}
