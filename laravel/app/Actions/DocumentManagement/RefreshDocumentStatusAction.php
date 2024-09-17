<?php

namespace App\Actions\DocumentManagement;

use App\Actions\SignNow\signNowOAuthAction;
use App\Models\DocumentManagement;
use SignNow\Api\Entity\Document\Document;

class RefreshDocumentStatusAction
{
    public function execute($document_id)
    {
        $document_management = DocumentManagement::where('document_id',$document_id)->first();

        if ($document_management->status == 'pending'){
            $entityManager=(new signNowOAuthAction())->execute();
            $document = $entityManager->get(new Document(), ['id' => $document_id]);
            $inviteFieldCount=count($document->getFieldInvites()) ;//good
            $signatureCount=count($document->getSignatures()) ;//good
            if ($inviteFieldCount!=0 && $inviteFieldCount == $signatureCount){
                $document_management->status = 'completed';
                $document_management->save();
            }
        }
        return $document_management;
    }
}
