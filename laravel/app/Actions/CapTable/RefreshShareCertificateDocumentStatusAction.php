<?php

namespace App\Actions\CapTable;

use App\Actions\SignNow\signNowOAuthAction;
use App\Models\ShareCertificate;
use SignNow\Api\Entity\Document\Document;

class RefreshShareCertificateDocumentStatusAction
{
    public function execute($document_id)
    {
        $share_certificate = ShareCertificate::where('document_id',$document_id)->first();

        if ($share_certificate->sign_status == 'pending'){
            $entityManager=(new signNowOAuthAction())->execute();
            $document = $entityManager->get(new Document(), ['id' => $document_id]);
            $inviteFieldCount=count($document->getFieldInvites()) ;//good
            $signatureCount=count($document->getSignatures()) ;//good
            if ($inviteFieldCount!=0 && $inviteFieldCount == $signatureCount){
                $share_certificate->sign_status = 'completed';
                $share_certificate->save();
            }
        }
        return $share_certificate;

    }
}
