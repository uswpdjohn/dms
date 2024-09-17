<?php

namespace App\Actions\CapTable;

use App\Actions\SignNow\signNowOAuthAction;
use App\Models\CompanyManagement;
use App\Models\ShareCertificate;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use SignNow\Api\Entity\Document\Document;

class CapTableShareCertificateInviteToSignAction
{
    public function execute($validatedData,$document_id)
    {

        $invite_emails=[];
        $document_roles=[];
        $ccs=[];

        $merge_id['secretary']=explode(',',$validatedData['secretary']);
        $merge_id['director']=explode(',',$validatedData['director']);
        $emails= Arr::flatten($merge_id);

        $shareholders_and_directors = CompanyManagement::whereIn('id', $emails)->get();
        for($i=0;$i<=count($shareholders_and_directors)-1; $i++){
            $invite_emails[] = $shareholders_and_directors[$i]->email;
            $ccs[] = $shareholders_and_directors[$i]->ccs;
        }


//        $redirectTo= route('home.index');
        $entityManager=(new signNowOAuthAction())->execute();
        $documentUniqueId = $document_id;
        $document_response = $entityManager->get(new Document(), ['id' => $documentUniqueId]);
        $roles = new Document();
        //accessing private property of Document
        $role = $roles->setRoles($document_response->getRoles());
        $allRoles=$role->getRoles();
        foreach ($allRoles as $allRole){
            array_push($document_roles, $allRole->getName());
        }


        if (count($role->getRoles()) != 0){
            try {
//              $from = 'My Application <no-reply@domain.com>';
                $implodedCc=[];
                $to=[];


                $from = $document_response->getOwner();
                for ($i=0;$i<=count($invite_emails)-1; $i++){
//                        $message='Please, sign document' . ' '. $document_response->getDocumentName() . 'Your document unlock password is 123456';
                    $message='Hi, Gateway of Asia is inviting you to sign '.$document_response->getDocumentName();
                    $value =$invite_emails[$i];
                    $key = array_search($value, $document_roles,true);
                    //previously using this method when calling new Invite($from, $to, $filteredCC)
//                    $to[] = (new Recipient(
//                        $invite_emails[$i],
//                        $allRoles[$key]->getName(),
//                        $allRoles[$key]->getUniqueId(),
//                        1,
//                        30,
//                        1))
//                        ->setSubject('You’ve got a new signature request! Please check inside.')
//                        ->setMessage($message)
//                        ->setExpirationDays(30);
                    $implodedCc[] = implode(',', $ccs[$i]);
                    $recipients = array(
                        "email"=> $invite_emails[$i],
                        "role_id" => $allRoles[$key]->getUniqueId(),
                        "role" => $allRoles[$key]->getName(),
                        "order" => 1,
                        "expiration_days" => 30,
                        "subject" => 'You’ve got a new signature request! Please check inside.',
                        "message" => $message
                    );
                    $to[] =$recipients;
                }

                $cc=explode(',',implode(',',$implodedCc));
                $filteredCC=array_filter($cc);
                $viewers  = array();
                foreach ($filteredCC as $key => $viewer){
                    $all_viewers = array(
                        "email"=> $viewer,
                        "role" => "Viewer ".$key,
                        "order" => 1
                    );
                    $viewers[] = $all_viewers;
                }

//                previously using start
//                  $fieldInvite = new FieldInvite($entityManager);
//                  $invite = new Invite($from, $to, $filteredCC);
//                previously using end

                // URL to which the POST request will be sent
                $url = config('signNow.api.host').'/document/'.$documentUniqueId.'/invite';
                // Data to be sent in the POST request
                $data = array(
                    'from' => $from,
                    'to' => $to,
                    'cc' => $filteredCC,
                    'viewers' => $viewers
                );
                $postData = json_encode($data);

                $auth_Data = array(
                    "username" => config('signNow.api.username'),
                    "password" => config('signNow.api.password'),
                    "grant_type" => "password",
                    "scope" => "*",
                );
                $auth_post_data = http_build_query($auth_Data);


                DB::beginTransaction();
                try {
//                    $response = $fieldInvite->create($documentUniqueId, $from, $to, $filteredCC);
//                    $invite = $entityManager->create($invite, ["documentId" => $documentUniqueId]);

                    //SignNow OAuth
                    $auth_url = config('signNow.api.host')."/oauth2/token" ;

                    $auth_ch = curl_init($auth_url);
                    curl_setopt($auth_ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($auth_ch, CURLOPT_POSTFIELDS, $auth_post_data);
                    curl_setopt($auth_ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
                    curl_setopt($auth_ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
                    curl_setopt($auth_ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '. config('signNow.api.basic_token')));


                    $auth_result = curl_exec($auth_ch);
                    $decoded_auth_result = json_decode($auth_result);
                    curl_close($auth_ch);

                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$decoded_auth_result->access_token));

                    $result = curl_exec($ch);
                    $decodedResult = json_decode($result);
                    curl_close($ch);

                    $share_certificate = ShareCertificate::where('document_id', $validatedData['document_id'])->first();
                    $share_certificate->invited_at = Carbon::now();
                    $share_certificate->save();
                    DB::commit();
                }catch(\Exception $exception){
                    DB::rollBack();
                    return array('failed' => true);
                }
                return array('success' => true);
//                    return response()->json($invite)->getStatusCode();

            }catch (\Throwable $exception){
                return array('error' => true);
//                    return $exception->getMessage();
            }
        }

        return array('failed'=> true );
    }

}
