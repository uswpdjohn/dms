<?php

namespace App\Actions\DocumentManagement;

use App\Actions\SignNow\signNowOAuthAction;
use SignNow\Api\Entity\Document\Download as DocumentDownload;
use ZipArchive;

class DocumentIndividualDownloadAction
{
    public function execute($document_id)
    {

        try {


            $entityManager=(new signNowOAuthAction())->execute();
            $allFile=[];
            $zipName="Documents.zip";


            $document=$entityManager->get(new DocumentDownload(), ['id' => $document_id], ['type' => 'collapsed']); //retrieving the document from signNow
            $allFile[] = 'document-' . $document_id . '.pdf';
//                    file_put_contents(storage_path('app/public/doc/document-'.$item.'.pdf'),$document->getContent()); //put the content in local storage
            file_put_contents(public_path('images/doc/document-'.$document_id.'.pdf'),$document->getContent()); //put the content in local storage
            if (!empty($allFile)){
                $zip = new ZipArchive;
                $zip->open($zipName, ZipArchive::CREATE);               //making zip
                for ($i=0;$i<=count($allFile)-1;$i++){
//                    $files = scandir(storage_path("app/public/doc/")); //scanning directory
                    $files = scandir(public_path('images/doc/')); //scanning directory

                    if ($files){
                        for ($x=0;$x<=count($files)-1;$x++){
                            if (strlen($files[$x])>4){
                                $path=public_path("images/doc/{$allFile[$i]}");
                                if (file_exists($path)){
                                    $zip->addFromString(basename($path), file_get_contents($path));
                                }else{
                                    return "File doesn't exist";
                                }
                            }
                        }
                    }else{
                        throw new \Exception('No such files or directory');
                    }
                }
                for ($j=0;$j<=count($allFile)-1;$j++){
                    unlink(public_path("images/doc/{$allFile[$j]}")); //deleting files after download
                }
            }
            return $zipName;
        }catch (\Throwable $exception){
            return $exception->getMessage();
        }
    }
}
