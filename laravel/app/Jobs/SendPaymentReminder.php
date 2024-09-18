<?php

namespace App\Jobs;

use App\Models\Company;
use App\Notifications\PaymentReminderNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPaymentReminder implements ShouldQueue
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
//        $daysExtension = 14;
        $overDueDayAlert=30;
        $subscriptionEndedDayAlert=90;

        $data = Company::with(['invoices' => function ($query) {
            $query->whereNotIn('status', ['paid', 'void'])->get();
        }])->where('status', 'active')->orderBy('id', 'ASC')->get();

        foreach ($data as $item) {
            if (count($item->invoices) > 0) {
                foreach ($item->invoices as $invoice) {
                    $dayDiffBetweenNowAndDueDate = Carbon::parse(now())->diffInDays($invoice->due_date);
//                    if (now() < $invoice->due_date && $dayDiffBetweenNowAndDueDate > $daysExtension) {
//                        //active
//                        array_push($active, $invoice->id);
//                    } else
                    if (now() <= $invoice->due_date && $dayDiffBetweenNowAndDueDate <= $overDueDayAlert) {

                        //due payment
//                        array_push($duePayment, $invoice->id);
                        foreach ($item->users as $user){
                            $user->notify(new PaymentReminderNotification());
                        }
                    }
                    if (now() >= $invoice->due_date && $dayDiffBetweenNowAndDueDate <= $subscriptionEndedDayAlert) {
                        //overdue
//                        array_push($overDue, $invoice->id);
//                        foreach ($invoice->users() as $user){
                        foreach ($item->users as $user){
                            $user->notify(new PaymentReminderNotification());
                        }
//                        $invoice->users()->notify(new PaymentReminderNotification());
                    }
//                    else {
//                        //inactive
//                        array_push($inactive, $invoice->id);
//                    }

                }
            }
        }
    }
}
