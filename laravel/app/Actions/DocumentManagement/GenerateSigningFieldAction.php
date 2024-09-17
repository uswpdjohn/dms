<?php

namespace App\Actions\DocumentManagement;

use App\Actions\SignNow\signNowOAuthAction;
use App\Models\CompanyManagement;
use Illuminate\Support\Arr;
use SignNow\Api\Entity\Document\Document;
use SignNow\Api\Entity\Document\Field\SignatureField;
use SignNow\Rest\Http\Request;

class GenerateSigningFieldAction
{
    public function execute($validatedData)
    {

        $merge_id['shareholder']=explode(',',implode(',',$validatedData['shareholder'])); //for document management
        $merge_id['director']=explode(',',implode(',',$validatedData['director']));

        $emails= Arr::flatten($merge_id);
        $shareholders_and_directors = CompanyManagement::whereIn('id', $emails)->get();
        $signatureField=[];
        for($i=0;$i<=count($shareholders_and_directors)-1; $i++){
            $signatureField[] = (new SignatureField())
                ->setName($shareholders_and_directors[$i]->getFullNameAttribute())
                ->setPageNumber(0)
                ->setRole($shareholders_and_directors[$i]->email)
                ->setRequired(true)
                ->setHeight(50)
                ->setWidth(177)
                ->setX(195)
                ->setY(130);

        }

        $documentId='';
        if (!key_exists('document_hashed', $validatedData)){
            $documentId=$validatedData['document_id'];
        }else{
            if (!key_exists('file', $validatedData)){
                $documentId = $validatedData['document_hashed'];
            }else{
                $documentId=$validatedData['document_id'];
            }
        }

        $document = (new Document())
            ->setId($documentId)
//            ->setFields([$signatureField ][0]);
            ->setFields($signatureField);
        $entityManager=(new signNowOAuthAction())->execute();
        $entityManager->setUpdateHttpMethod(Request::METHOD_PUT)->update($document);
    }



}
