<?php

namespace App\Actions\CapTable;

use App\Actions\SignNow\signNowOAuthAction;
use App\Models\ShareCertificate;
use SignNow\Api\Entity\Document\Download as DocumentDownload;
use ZipArchive;

class CapTableShareCertificateDownloadPdfAction
{
    public function execute($document_id)
    {
        try {
            $share_certificate = ShareCertificate::where('document_id',$document_id)->first();
            $entityManager=(new signNowOAuthAction())->execute();
            $allFile=[];
            $zipName="ShareCertificate.zip";
//            foreach ($validatedData['document_id'] as $item){
//                if ($item != null){
//
//                }
//
//            }

            $document=$entityManager->get(new DocumentDownload(), ['id' => $document_id], ['type' => 'collapsed']); //retrieving the document from signNow
            $allFile[] = 'shareCertificate-' . $share_certificate->share_certificate_id . '.pdf';
//                    file_put_contents(storage_path('app/public/doc/document-'.$item.'.pdf'),$document->getContent()); //put the content in local storage
            file_put_contents(public_path('images/shareCertificate/shareCertificate-' . $share_certificate->share_certificate_id . '.pdf'),$document->getContent()); //put the content in local storage
            if (!empty($allFile)){
                $zip = new ZipArchive;
                $zip->open($zipName, ZipArchive::CREATE);               //making zip
                for ($i=0;$i<=count($allFile)-1;$i++){
//                    $files = scandir(storage_path("app/public/doc/")); //scanning directory
                    $files = scandir(public_path('images/shareCertificate/')); //scanning directory

                    if ($files){
                        for ($x=0;$x<=count($files)-1;$x++){
                            if (strlen($files[$x])>4){
                                $path=public_path("images/shareCertificate/{$allFile[$i]}");
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
                    unlink(public_path("images/shareCertificate/{$allFile[$j]}")); //deleting files after download
                }
            }
            return $zipName;
        }catch (\Throwable $exception){
            return $exception->getMessage();
        }
    }

}
