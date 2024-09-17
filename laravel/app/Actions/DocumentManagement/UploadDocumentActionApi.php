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

/**
 * Using this file as uploading document in signNow server:
 */
class UploadDocumentActionApi
{
    public function execute($validatedData)
    {
        try {
//            $goa_document = DocumentManagement::where('document_id', $validatedData['document_hashed'])->first();
            if(!key_exists('file', $validatedData)){
                $validatedData['document_id']=$validatedData['document_hashed'];
                (new EditDocumentAction())->execute($validatedData);
//                (new GenerateSigningFieldAction())->execute($validatedData);
            }else{
//                $entityManager=(new signNowOAuthAction())->execute();
                $file = $validatedData['file']->getClientOriginalName();
                $content = $validatedData['file']->get();
                $encrypted = Crypt::encrypt($content);
                Storage::disk('public')->put('/' . $file, $encrypted);
//                $validatedData['file']->storeAs('/public', $file);
//                $validatedData['file']->storeAs('/public', $encrypted);


//                $content = storage_path('app/public/'.$file);
//                $uploadFile = (new DocumentUpload(new \SplFileInfo($content)));
//                $uploaded_doc = $entityManager->create($uploadFile);
//                $document = $entityManager->get(new Document(), ['id' => $uploaded_doc->getId()]);

                /*start storing document thumbnail to local storage*/
//                $thumbnail_link=$document->getThumbnail()->getMedium();
//                $entity=$entityManager->get(Token::class); //good
//                $access_token=$entity->getAccessToken(); //good
//                $link= $thumbnail_link.'&access_token='.$access_token;
//                $contents=$this->curl_get_file_contents($link);
//                file_put_contents(public_path('images/thumbnail/'.$document->getId().'.png'),$contents); //put the content in local storage
//
//                unlink(storage_path("app/public/".$file));
                /*end storing document thumbnail to local storage*/

//                $validatedData['document_id'] = $document->getId();
                $validatedData['document_id'] = Str::random(16);
                if(key_exists('current_document_id', $validatedData)){
                    return (new EditDocumentAction())->execute($validatedData);
//                    (new GenerateSigningFieldAction())->execute($validatedData);
                    //delete document from signNow
//                    (new DeleteDocumentAction())->execute($validatedData['document_hashed']);

                }else{
                    return (new CreateDocumentAction())->execute($validatedData);
//                    if(key_exists('shareholder',$validatedData) || key_exists('director',$validatedData)){
//                        (new GenerateSigningFieldAction())->execute($validatedData);
//                    }
                }
//                return $document;
            }

//        echo 'Uploaded the document: ', $document->getId(), PHP_EOL, PHP_EOL; //good
        }catch (Throwable $exception){
            throw new \Exception('ERROR [SignNow API]: ' . $exception->getMessage());
//            return ;
        }
    }

    function curl_get_file_contents($URL)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
        else return FALSE;
    }
}
