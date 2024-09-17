<?php


namespace App\Actions\Payment;


use App\Jobs\SendPaymentReminder;

class SendPaymentReminderAction
{
    public static function execute()
    {
        $durationInSeconds = 300; // 5 minutes

        //check the time when it is called from session, if it is less than duration time then return error message
//        if (session()->has('send_payment_reminder_notification_time') || session()->get('send_payment_reminder_notification_time')->addSeconds($durationInSeconds) > now()){
        if (session()->has('send_payment_reminder_notification_time')){
            if (session()->get('send_payment_reminder_notification_time')->addSeconds($durationInSeconds) > now()){
                return redirect()->route('dashboard')->with('error', 'You have sent a reminder recently. Please wait for 5 minutes before sending again. Thank you.');

//                return array('type'=>'error', 'message'=>'Cannot send notification now. Please try '. session()->get('send_payment_reminder_notification_time')->diffForHumans(now()));
            }
        }

        // duration is grater than now() than send notification and set the time in session
        session()->put('send_payment_reminder_notification_time', now());

        // dispatch reminder job to send notification
        SendPaymentReminder::dispatch();

        // return success message
        return redirect()->route('dashboard')->with('success', 'Reminder has been sent.');
//        return array('type'=>'success', 'message'=>'');
    }
}
