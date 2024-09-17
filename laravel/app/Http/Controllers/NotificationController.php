<?php

namespace App\Http\Controllers;

use App\Actions\Notification\NotificationAdminListAction;
use App\Actions\Notification\NotificationDeleteMarkedAction;
use App\Actions\Notification\NotificationListAction;
use App\Actions\Notification\NotificationMarkAsReadAction;
use App\Actions\Notification\NotificationMarkAsUnreadAction;
use App\Actions\Notification\SearchNotificationAction;
use Illuminate\Http\Request;


class NotificationController extends Controller
{
    public function index(Request $request)
    {


        $notifications=(new NotificationListAction())->execute($request->has('page_count') ? $request->page_count : config('paginate.page_count'));
        if ($request->ajax()){
            return $notifications;
        }
        return view('notification.index', ['notifications'=>$notifications]);
    }

//    public function adminNotification(Request $request)
//    {
//        $notifications =(new NotificationAdminListAction())->execute($request->has('page_count') ? $request->page_count : config('paginate.page_count'), 'desc');
//        return view('notification.index', ['notifications'=>$notifications]);
//
//    }

    public function markAsRead($id)
    {
        return (new NotificationMarkAsReadAction())->execute($id);
//        auth()->user()->unreadNotifications->markAsRead(); //bulk mark as read
    }
    public function markAsUnread($id)
    {
        $response=(new NotificationMarkAsUnreadAction())->execute($id);
        return $response;

    }

    public function deleteMarked($id)
    {
        $response=(new NotificationDeleteMarkedAction())->execute($id);
        return $response;
    }
    public function searchNotification($search)
    {
        $response=(new SearchNotificationAction())->execute($search,config('paginate.page_count'));
        return $response;
    }
}
