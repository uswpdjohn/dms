<?php

namespace App\Actions\DocumentManagement;

use App\Actions\Session\SessionAction;
use App\Actions\SignNow\signNowOAuthAction;
use App\Helpers\Helper;
use App\Models\CompanyUserSession;
use App\Models\DocumentManagement;
use App\Models\Mailbox;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use SignNow\Api\Action\OAuth as SignNowOAuth;
use SignNow\Api\Entity\Document\Document;
use SignNow\Api\Entity\Document\DownloadLink;
use SignNow\Api\Entity\Document\Thumbnail;
use SignNow\Api\Entity\Auth\TokenRequestRefresh;
use SignNow\Api\Entity\Auth\TokenRequestPassword;
use SignNow\Api\Service\Factory\EntityManagerFactory;
use SignNow\Api\Service\Factories\TokenFactory;
use  SignNow\Api\Entity\Auth\Token;


class RetrieveDocumentAction
{
    public function execute($service_id,$search = null,$orderBy)
    {

//        if(session()->get('auth_user_company') == null){
//            (new SessionAction())->execute();
//        }

        $services = array(
          1  => "corporate_secretary",
          2  => "tax",
          3  => "accounting",
          4  => "human_resource",
          5  => "esop",
          6  => "cap_table",
        );
        $document_management = DocumentManagement::query();
        $mailbox = Mailbox::query();
        $document_management = $document_management->where('company_id', Helper::auth_user_company())
            ->where('service_id', $service_id);
        $mailbox = $mailbox->where('company_id', Helper::auth_user_company())
            ->where('category',$services[$service_id]);

        if(! is_null($search)){
            $document_management = $document_management->where('name', 'LIKE', "%$search%")
                ->orderBy('updated_at',$orderBy);
            $mailbox = $mailbox->where('title', 'LIKE', "%$search%")
                ->orderBy('updated_at',$orderBy);
        }

        $document_management = $document_management->orderBy('created_at',$orderBy)->get();

        $mailbox = $mailbox->orderBy('created_at',$orderBy)
//            ->select('id','slug', 'title as name','file','directory','company_id','downloaded_at','created_at','updated_at')
            ->get();

        $mailbox= $mailbox->groupBy(function($val) {
            return $val->directory;
        });



        /**
         * Visualize file sorted by Year month
         * */
//        $mergedCollection =collect($document_management)->merge($mailbox);
//        $mergedCollection =$mergedCollection
//            ->groupBy(function($val) {
//                return Carbon::parse($val->updated_at)->format('Y');
//            })
//            ->map(function ($values) {
//                //using sort because of the month key order was Sep,Oct,Nov,Apr
//                return $values->sort(function($a, $b) {
//                    return strcmp(Carbon::parse($a->updated_at)->format('m'),Carbon::parse($b->updated_at)->format('m'));
//                })->groupBy(function ($val) {
//                    return Carbon::parse($val->updated_at)->format('M');
//                });
//            })
//            ->toArray();

//        return $mergedCollection;
        return ['document' =>$document_management, 'mailbox'=> $mailbox];



    }

}
