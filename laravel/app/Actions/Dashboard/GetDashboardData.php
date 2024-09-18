<?php

namespace App\Actions\Dashboard;

use App\Models\Category;
use App\Models\Company;
use App\Models\DocumentManagement;
use App\Models\Mailbox;
use App\Models\User;
use Carbon\Carbon;

class GetDashboardData
{
    public function execute()
    {
        $totalNoOfDocument= 0;
        $uploadedToday= 0;
        $totalUser=0;
        $mailboxes=0;
        $document = DocumentManagement::query();
        if (auth()->user()->hasRole('Company Owner')){
            $companies = Company::where('created_by', auth()->user()->id)->pluck('id');
            $totalNoOfDocument = $document->whereIn('company_id', $companies)->count();
            $uploadedToday = $document->whereIn('company_id', $companies)->whereDate('created_at', Carbon::now())->count();
            $totalUser = User::where('created_by', auth()->user()->id)->count();
            $mailboxes = Mailbox::whereIn('company_id',$companies)->count();
        }
        if (auth()->user()->hasRole('Employee')){
            $companies = Company::where('created_by', auth()->user()->created_by)->pluck('id');
            $totalNoOfDocument = $document->whereIn('company_id',$companies)->count();
            $uploadedToday = $document->whereIn('company_id',$companies)->whereDate('created_at', Carbon::now())->count();
            $totalUser = User::where('created_by', auth()->user()->id)->count();
            $mailboxes = Mailbox::whereIn('company_id',$companies)->count();
        }
        return ['totalNoOfDocument' =>$totalNoOfDocument,
            'uploadedToday' => $uploadedToday,
            'totalUser' => $totalUser,
            'mailboxes' => $mailboxes
            ];



    }

}
