<?php

namespace App\Actions\DocumentManagement;

use App\Actions\SignNow\signNowOAuthAction;
use App\Models\DocumentManagement;
use Illuminate\Support\Facades\DB;
use SignNow\Api\Entity\Document\Document;

class DeleteDocumentFromInternalDbAction
{
    public function execute($document_id)
    {
        DB::beginTransaction();
        try {
            $document = DocumentManagement::where('id', $document_id)->first();

            if ($document->service_id != 5) {
                if($document->status != 'completed'){
                    $entityManager=(new signNowOAuthAction())->execute();
                    $sign_now_document_status = $entityManager->get(new Document(), ['id' => $document->document_id]);
                    $inviteFieldCount=count($sign_now_document_status->getFieldInvites()) ;//good
                    $signatureCount=count($sign_now_document_status->getSignatures()) ;//good
                    if ($inviteFieldCount == 0 || $signatureCount == 0 ){
                        (new DeleteDocumentAction())->execute($document->document_id);
                        $document->delete();
                        DB::commit();
                        return array('success' => true);
                    }elseif ($inviteFieldCount != $signatureCount){
                        (new DeleteDocumentAction())->execute($document->document_id);
                        $document->delete();
                        DB::commit();
                        return array('success' => true);
                    }
                    return array('action' => 'failed');
                }
            }else{
                (new DeleteDocumentAction())->execute($document->document_id);
                $document->delete();
                DB::commit();
                return array('success' => true);
            }

        }catch (\Exception $exception){
            DB::rollBack();
            return array('error' => true);
//            return $exception->getMessage();
        }

    }

}
