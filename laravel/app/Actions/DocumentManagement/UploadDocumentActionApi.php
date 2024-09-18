<?php

namespace App\Actions\DocumentManagement;

use App\Actions\SignNow\signNowOAuthAction;
use App\Models\DocumentManagement;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SignNow\Api\Entity\Auth\Token;
use SignNow\Api\Entity\Document\Upload as DocumentUpload;
use SignNow\Api\Entity\Document\Document;
use SignNow\Api\Entity\Document\Field\SignatureField;
use SignNow\Api\Entity\Document\Field\TextField;
use SignNow\Rest\Http\Request;
use Throwable;

class UploadDocumentActionApi
{
    public function execute($validatedData)
    {
        try {
            if(!key_exists('file', $validatedData)){
                $validatedData['document_id']=$validatedData['document_hashed'];
                (new EditDocumentAction())->execute($validatedData);
//                (new GenerateSigningFieldAction())->execute($validatedData);
            }else{
                $file = $validatedData['file']->getClientOriginalName();
                $content = $validatedData['file']->get();
                $encrypted = Crypt::encrypt($content);
                Storage::disk('public')->put('/' . $file, $encrypted);
                $validatedData['document_id'] = Str::random(16);
                if(key_exists('current_document_id', $validatedData)){
                    return (new EditDocumentAction())->execute($validatedData);

                }else{
                    return (new CreateDocumentAction())->execute($validatedData);
                }
            }

        }catch (Throwable $exception){
            throw new \Exception('ERROR [SignNow API]: ' . $exception->getMessage());
//            return ;
        }
    }


}
