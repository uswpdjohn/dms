<?php

namespace App\Actions\ESOP\Customer\Document;

use App\Actions\Session\SessionAction;
use App\Models\DocumentManagement;
use App\Models\Mailbox;
use Carbon\Carbon;

class RetrieveEsopDocumentAction
{
    public function execute($service_id,$search = null,$orderBy)
    {

        if(session()->get('auth_user_company') == null){
            (new SessionAction())->execute();
        }
        $services = array(
            1  => "corporate_secretary",
            2  => "tax",
            3  => "accounting",
            4  => "human_resource",
            5  => "esop",
            6  => "cap_table",
        );
        $document_management = DocumentManagement::query();
//        $mailbox = Mailbox::query();
        $document_management = $document_management->where('company_id', session()->get('auth_user_company')->id)
            ->where('service_id', $service_id);
//        $mailbox = $mailbox->where('company_id', session()->get('auth_user_company')->id)
//            ->where('category',$services[$service_id]);

        if(! is_null($search)){
//            $document_management = $document_management->where('service_id', $service_id)->where('name', 'LIKE', "%$search%")->orderBy('updated_at',$orderBy);
            $document_management = $document_management->where('name', 'LIKE', "%$search%")
                ->orderBy('updated_at',$orderBy);
//            $mailbox = $mailbox->where('title', 'LIKE', "%$search%")
//                ->orderBy('updated_at',$orderBy);
        }

        $document_management = $document_management->orderBy('created_at',$orderBy)->get();

//        $mailbox = $mailbox->orderBy('created_at',$orderBy)
//            ->select('id','slug', 'title as name','file','company_id','downloaded_at','created_at','updated_at')
//            ->get();

//        $mergedCollection =collect($document_management)->merge($mailbox);


//        $mergedCollection =$mergedCollection
//            ->groupBy(function($val) {
//                return Carbon::parse($val->updated_at)->format('Y');
//            })
//            ->map(function ($values) {
//                return $values->groupBy(function ($val) {
//                    return Carbon::parse($val->updated_at)->format('M');
//                });
//            })
//
//            ->toArray();
        $document_management =$document_management
            ->groupBy(function($val) {
                return Carbon::parse($val->updated_at)->format('Y');
            })
            ->map(function ($values) {
                //using sort because of the month key order was Sep,Oct,Nov,Apr
                return $values->sort(function($a, $b) {
                    return strcmp(Carbon::parse($a->updated_at)->format('m'),Carbon::parse($b->updated_at)->format('m'));
                })->groupBy(function ($val) {
                    return Carbon::parse($val->updated_at)->format('M');
                });
            })
            ->toArray();





        return $document_management;
//        return ['document' =>$document_management, 'mailbox'=> $mailbox];



        //OLD START
//        $document_management = $document_management->where('service_id', $service_id)
//            ->where('company_id', session()->get('auth_user_company')->id)
//            ->orderBy('created_at',$orderBy)
//            ->get()
//            ->groupBy(function($val) {
//                return Carbon::parse($val->updated_at)->format('Y');
//            });
//
//
//        $document_management = $document_management
//            ->map(function ($values) {
//                return $values->groupBy(function ($val) {
//                    return Carbon::parse($val->updated_at)->format('M');
//                });
//            })
//            ->toArray();

        //OLD END
//        return $document_management;
//        return ['document' =>$document_management, 'mailbox'=> $mailbox];


    }

}
