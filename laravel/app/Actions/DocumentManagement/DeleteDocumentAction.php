<?php

namespace App\Actions\DocumentManagement;

use App\Actions\SignNow\signNowOAuthAction;
use App\Models\ShareCertificate;
use SignNow\Api\Entity\Document\Document;
use Throwable;

class DeleteDocumentAction
{
    public function execute($id)
    {
        try {
            $share_certificate = ShareCertificate::where('document_id', $id)->first();
            unlink(public_path('images/shareCertificate/'.$share_certificate->file));

            /*Abandoned- */
//            $entityManager=(new signNowOAuthAction())->execute();
//            $documentUniqueId = $id;
//            return $entityManager->delete(new Document(), ['id' => $documentUniqueId]);
            /*Abandoned*/

        }catch (Throwable $exception){
            return $exception->getMessage();
        }
    }

}
