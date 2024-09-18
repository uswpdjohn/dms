<?php

namespace App\Jobs;

use App\Helpers\MailHelper;
use App\Models\ESOP;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class SendESOPEntriesReminderMail implements ShouldQueue
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

        logger('SendESOPEntriesReminderMail handle()');
        $data = ESOP::with('member')->where('reminder_date', today()->toDateString())->issued()
            ->get();

        if ($data->count()) {
            foreach ($data as $item) {
                $emails = array();

                if ($item->first_reminder_email != NULL) {
                    array_push($emails, $item->first_reminder_email);
                }
                if ($item->second_reminder_email != NULL) {
                    array_push($emails, $item->second_reminder_email);
                }
                if ($item->third_reminder_email != NULL) {
                    array_push($emails, $item->third_reminder_email);
                }
                if ($item->forth_reminder_email != NULL) {
                    array_push($emails, $item->forth_reminder_email);
                }
                if ($item->fifth_reminder_email != NULL) {
                    array_push($emails, $item->fifth_reminder_email);
                }

                $details = [
                    'subject' => 'Gateway of Asia | New ESOP Entries Reminder Mail Received',
                    'from' => config('mail.from.address'),
                    'title' => "Reminder for ESOP Entries",
                    'recipient' => $item->member->name ?? '',
                    'date_of_granted' => $item->granted_date,
                    'to' => $emails,
                    'purpose' => 'send reminder mail on Esop Entries',
                ];
                (new MailHelper($details))->sendMail();
            }
        }
    }

}
