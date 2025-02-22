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

            $document= DocumentManagement::where('id',$validatedData['current_document_id'])->first(); //current_document_id = id (primary key)
            if (key_exists('file', $validatedData)){
                $validatedData['file']=$validatedData['file']->getClientOriginalName();
            }
            if(key_exists('shareholder', $validatedData) || key_exists('director', $validatedData)){
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
            }


            $document->update($validatedData);

            DB::commit();
            return $document;
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }

}
