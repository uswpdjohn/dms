<?php

namespace App\Actions\CapTable;

use App\Actions\DocumentManagement\CancelInviteAction;
use App\Models\ShareCertificate;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class UpdateShareCertificateAction
{
    public function execute($validatedData)
    {
        DB::beginTransaction();
        try {


            $share_certificate = ShareCertificate::where('id', $validatedData['share_certificate'])->first(); //share_certificate = id (primary key)
            try {
                $share_certificate->certificateSigners()->detach();
//                var_dump($share_certificate->certificateSigners());die();
            }catch (\Exception $exception){
                throw new \Exception($exception->getMessage());
            }


            if (key_exists('secretary', $validatedData) && $validatedData['secretary'][0] != NULL) {
                $implodedSecretaryIds = implode(',', $validatedData['secretary']);
                $invite_emails_secretary = explode(',', $implodedSecretaryIds);
                for ($x = 0; $x <= count($invite_emails_secretary) - 1; $x++) {
                    $share_certificate->certificateSigners()->attach([1 => ['user_id' => $invite_emails_secretary[$x], 'user_type' => 'secretary']]);
                }
            }
            if (key_exists('director', $validatedData) &&$validatedData['director'][0] != NULL) {
                $implodedDirectorIds = implode(',', $validatedData['director']);
                $invite_emails_id_director = explode(',', $implodedDirectorIds);
                for ($x = 0; $x <= count($invite_emails_id_director) - 1; $x++) {
                    $share_certificate->certificateSigners()->attach([1 => ['user_id' => $invite_emails_id_director[$x], 'user_type' => 'director']]);
                }
            }
            if ($share_certificate->invited_at != null) {
                (new CancelInviteAction())->execute($validatedData['share_certificate_document_hash_id']);
                $validatedData['invited_at'] = null;
            }

            $share_certificate->update($validatedData);
            DB::commit();

            return $share_certificate;
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }

    }
}


