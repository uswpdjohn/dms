<?php

namespace App\Actions\DocumentManagement;

use App\Models\DocumentManagement;
use Illuminate\Support\Facades\DB;

class EditDocumentAction
{
    public function execute($validatedData)
    {
        DB::beginTransaction();
        try {
            $invite_emails_shareholder=[];
            $invite_emails_id_director=[];
//            if ($validatedData['shareholder'][0] != NULL){
//                $implodedShareholderIds=implode(',',$validatedData['shareholder']);
//                $invite_emails_shareholder=explode(',',$implodedShareholderIds);
//            }
//            if ($validatedData['director'][0] != NULL){
//                $implodedDirectorIds=implode(',',$validatedData['director']);
//                $invite_emails_id_director=explode(',',$implodedDirectorIds);
//            }
//            if (key_exists('file', $validatedData)){
//                $validatedData['file']=$validatedData['file']->getClientOriginalName();
//            }
//            $document= DocumentManagement::where('id',$validatedData['current_document_id'])->first();
//            if ($document->invited_at != null){
//                (new CancelInviteAction())->execute($validatedData['document_hashed']);
//                $validatedData['invited_at']=null;
//            }
//            $document->update($validatedData);
//
//            $document->signers()->detach();
//            if (count($invite_emails_shareholder) > 0){
//                for ($x = 0; $x <= count($invite_emails_shareholder) - 1; $x++) {
//                    $document->signers()->attach([1 =>['user_id'=> $invite_emails_shareholder[$x], 'user_type'=>'shareholder']]);
//                }
//            }
//            if (count($invite_emails_id_director) > 0){
//                for ($x = 0; $x <= count($invite_emails_id_director) - 1; $x++) {
//                    $document->signers()->attach([1 =>['user_id'=> $invite_emails_id_director[$x], 'user_type'=>'director']]);
//                }
//            }



            $document= DocumentManagement::where('id',$validatedData['current_document_id'])->first(); //current_document_id = id (primary key)
            if (key_exists('file', $validatedData)){
                $validatedData['file']=$validatedData['file']->getClientOriginalName();
            }

            if($document->recipient_name == NULL && $document->reminder_date == NULL){
                $document->signers()->detach();
            }
            if ($validatedData['shareholder'][0] != NULL){
                $implodedShareholderIds=implode(',',$validatedData['shareholder']);
                $invite_emails_shareholder=explode(',',$implodedShareholderIds);
                for ($x = 0; $x <= count($invite_emails_shareholder) - 1; $x++) {
                    $document->signers()->attach([1 =>['user_id'=> $invite_emails_shareholder[$x], 'user_type'=>'shareholder']]);
                }
            }
            if ($validatedData['director'][0] != NULL){
                $implodedDirectorIds=implode(',',$validatedData['director']);
                $invite_emails_id_director=explode(',',$implodedDirectorIds);
                for ($x = 0; $x <= count($invite_emails_id_director) - 1; $x++) {
                    $document->signers()->attach([1 =>['user_id'=> $invite_emails_id_director[$x], 'user_type'=>'director']]);
                }
            }
//            if ($document->invited_at != null){
//                (new CancelInviteAction())->execute($validatedData['document_hashed']);
//                $validatedData['invited_at']=null;
//            }
            $document->update($validatedData);

            DB::commit();
            return $document;
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }

}
