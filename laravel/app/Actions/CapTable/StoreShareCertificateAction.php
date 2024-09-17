<?php

namespace App\Actions\CapTable;

use App\Models\ShareCertificate;
use Illuminate\Support\Facades\DB;

class StoreShareCertificateAction
{
    public function execute($validatedData)
    {
        DB::beginTransaction();
        try {
            $invite_emails_secretary=[];
            $invite_emails_id_director=[];

            if (key_exists('secretary' , $validatedData) && $validatedData['secretary'][0] != NULL){
                $implodedSecretaryId=implode(',',$validatedData['secretary']);
                $invite_emails_secretary=explode(',',$implodedSecretaryId);
            }

            if (key_exists('director' , $validatedData) && $validatedData['director'][0] != NULL){
                $implodedDirectorIds=implode(',',$validatedData['director']);
                $invite_emails_id_director=explode(',',$implodedDirectorIds);
            }


            $share_certificate= ShareCertificate::create($validatedData);


            if (count($invite_emails_secretary) > 0){
                for ($x = 0; $x <= count($invite_emails_secretary) - 1; $x++) {
                    $share_certificate->certificateSigners()->attach([1 =>['user_id'=> $invite_emails_secretary[$x], 'user_type'=>'secretary']]);
                }
            }
            if (count($invite_emails_id_director) > 0){
                for ($x = 0; $x <= count($invite_emails_id_director) - 1; $x++) {
                    $share_certificate->certificateSigners()->attach([1 =>['user_id'=> $invite_emails_id_director[$x], 'user_type'=>'director']]);
                }
            }
            DB::commit();
            return $share_certificate;
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }



//        $document->signers()->attach([$invite_emails_id_director, 'user_type'=>'director']);

    }

}
