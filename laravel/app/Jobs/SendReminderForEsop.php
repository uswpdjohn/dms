<?php

namespace App\Jobs;

use App\Models\DocumentManagement;
use App\Models\User;
use App\Notifications\MailboxNotification;
use App\Notifications\SendReminderForEsopNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendReminderForEsop implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $documents = DocumentManagement::with('companies')->where('service_id',5)->get();
        foreach ($documents as $document){
            $send_reminder_on = Carbon::parse($document->reminder_date)->subDays(30)->toDateString();
            if(now()->toDateString() == $send_reminder_on){
                foreach ($document->companies->users as $user){
                    $user->notify(new SendReminderForEsopNotification($document));
                }
                $superUsers = User::role('Super Admin')->get();
                $adminUsers = User::role('Admin')->get();
                if (count($adminUsers)>0){
                    foreach ($adminUsers as $user){
                        $user->notify(new SendReminderForEsopNotification($document));
                    }
                }
                if (count($superUsers)>0){
                    foreach ($superUsers as $sUser){
                        $sUser->notify(new SendReminderForEsopNotification($document));
                    }
                }
            }
        }
    }
}
