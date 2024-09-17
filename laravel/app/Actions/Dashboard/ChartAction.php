<?php

namespace App\Actions\Dashboard;

use App\Interfaces\Dashboard\ChartInterface;
use App\Models\Company;
use Carbon\Carbon;

class ChartAction implements ChartInterface
{
    public static function execute()
    {
        $totalCompany = Company::all()->count();


//        $data = Company::with(['invoices' => function ($query) {
//            $query->whereNotIn('status', ['paid', 'void'])->get();
//        }])->where('status', 'active')->orderBy('id', 'ASC')->get();
        $data = Company::where('status', 'active')->orderBy('id', 'ASC')->get();
//       var_dump($data);die();

        $active = [];
        $duePayment = [];
        $overDue = [];
        $inactive = Company::where('status', 'inactive')->get()->pluck('id')->toArray();
        $active = Company::where('status', 'active')->get()->pluck('id')->toArray();
//        $daysExtension = 14;
//        $overDueDayAlert=30;
//        $subscriptionEndedDayAlert=90;
//        foreach ($data as $item) {
//            if (count($item->invoices) > 0) {
//                foreach ($item->invoices as $invoice) {
//                    $dayDiffBetweenNowAndDueDate = Carbon::parse(now())->diffInDays($invoice->due_date);
//                    if (now() < $invoice->due_date && $dayDiffBetweenNowAndDueDate > $overDueDayAlert) {
//                        //active
//                        array_push($active, $invoice->id);
//                    } elseif (now() <= $invoice->due_date && $dayDiffBetweenNowAndDueDate <= $overDueDayAlert) {
//                        //due payment
//                        array_push($duePayment, $invoice->id);
//                    } elseif (now() >= $invoice->due_date && $dayDiffBetweenNowAndDueDate <= $subscriptionEndedDayAlert) {
//                        //overdue
////                        var_dump($invoice->due_date);die();
//                        array_push($overDue, $invoice->id);
//                    } else {
//                        //inactive
//                        array_push($inactive, $invoice->id);
//                    }
//                }
//            }
//        }


        return response()->json(
            [
                'active' => count(array_unique($active)),
//                'due_payment' => count($duePayment),
//                'overdue' => count($overDue),
                'inactive' => count(array_unique($inactive)),
                'totalCompany' => $totalCompany
            ]
        );
    }

}
