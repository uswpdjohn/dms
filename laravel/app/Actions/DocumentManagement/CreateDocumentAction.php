<?php

namespace App\Actions\DocumentManagement;

use App\Models\DocumentManagement;
use App\Models\User;
use App\Notifications\MailboxNotification;
use Illuminate\Support\Facades\DB;

/**
 * Using this file as saving uploaded document details in internal DB
 */
class CreateDocumentAction
{
    public function execute($validatedData)
    {
        DB::beginTransaction();
        try {
            $invite_emails_shareholder=[];
            $invite_emails_id_director=[];

            if (key_exists('shareholder' , $validatedData) && $validatedData['shareholder'][0] != NULL){
                $implodedShareholderIds=implode(',',$validatedData['shareholder']);
                $invite_emails_shareholder=explode(',',$implodedShareholderIds);
            }

            if (key_exists('director' , $validatedData) && $validatedData['director'][0] != NULL){
                $implodedDirectorIds=implode(',',$validatedData['director']);
                $invite_emails_id_director=explode(',',$implodedDirectorIds);
            }
            if ($validatedData['service_id'] == 5){
                $validatedData['status'] = 'completed';
            }


            $validatedData['file']=$validatedData['file']->getClientOriginalName();
            $document= DocumentManagement::create($validatedData);

            if (count($invite_emails_shareholder) > 0){
                for ($x = 0; $x <= count($invite_emails_shareholder) - 1; $x++) {
                    $document->signers()->attach([1 =>['user_id'=> $invite_emails_shareholder[$x], 'user_type'=>'shareholder']]);
                }
            }
            if (count($invite_emails_id_director) > 0){
                for ($x = 0; $x <= count($invite_emails_id_director) - 1; $x++) {
                    $document->signers()->attach([1 =>['user_id'=> $invite_emails_id_director[$x], 'user_type'=>'director']]);
                }
            }
            DB::commit();
            return $document;
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }



//        $document->signers()->attach([$invite_emails_id_director, 'user_type'=>'director']);

    }

}
