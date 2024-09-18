<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\FailedToChangeInvoiceStatusInXeroNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendReminderStatusChangeFailingInXero implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $invoice_id;
    public function __construct($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $superUsers = User::role('Super Admin')->get();
        $adminUsers = User::role('Admin')->get();

        if(count($superUsers)>0) {
            foreach ($superUsers as $sUser) {
                $sUser->notify(new FailedToChangeInvoiceStatusInXeroNotification($this->invoice_id));
            }
        }

        if(count($adminUsers)>0) {
            foreach ($adminUsers as $user) {
                $user->notify(new FailedToChangeInvoiceStatusInXeroNotification($this->invoice_id));
            }
        }
    }
}
