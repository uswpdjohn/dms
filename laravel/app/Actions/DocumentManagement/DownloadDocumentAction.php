<?php

namespace App\Actions\DocumentManagement;

use App\Models\Mailbox;
use Illuminate\Support\Facades\Storage;
use SignNow\Api\Entity\Document\Download as DocumentDownload;
use SignNow\Api\Entity\Document\DownloadLink;
use App\Actions\SignNow\signNowOAuthAction;
use ZipArchive;

class DownloadDocumentAction
{
    public function execute($validatedData)
    {

        try {
            $zipName="Documents.zip";
            $zip = new ZipArchive();
            $zip->open($zipName, ZipArchive::CREATE);               //making zip
            if (key_exists(1,$validatedData['document_id']) || key_exists('document_id', $validatedData)) {
                $entityManager=(new signNowOAuthAction())->execute();
                $allFile=[];
                foreach ($validatedData['document_id'] as $item) {
                    if ($item != null) {
                        $document = $entityManager->get(new DocumentDownload(), ['id' => $item], ['type' => 'collapsed']); //retrieving the document from signNow
                        $allFile[] = 'document-' . $item . '.pdf';
//                    file_put_contents(storage_path('app/public/doc/document-'.$item.'.pdf'),$document->getContent()); //put the content in local storage
                        file_put_contents(public_path('images/doc/document-' . $item . '.pdf'), $document->getContent()); //put the content in local storage
                    }

                }
//                $zip = new ZipArchive;
//                $zip->open($zipName, ZipArchive::CREATE);               //making zip
                if (!empty($allFile)) {
                    for ($i = 0; $i <= count($allFile) - 1; $i++) {
//                    $files = scandir(storage_path("app/public/doc/")); //scanning directory
                        $files = scandir(public_path('images/doc/')); //scanning directory
                        if ($files) {
                            for ($x = 0; $x <= count($files) - 1; $x++) {
                                if (strlen($files[$x]) > 4) {
                                    $path = public_path("images/doc/{$allFile[$i]}");
                                    if (file_exists($path)) {
                                        $zip->addFromString(basename($path), file_get_contents($path));
                                    } else {
                                        throw new \Exception("File doesn't exist");

                                    }
                                }
                            }
                        } else {
                            throw new \Exception('No such files or directory');
                        }
                    }
                    for ($j = 0; $j <= count($allFile) - 1; $j++) {
                        unlink(public_path("images/doc/{$allFile[$j]}")); //deleting files after download
                    }
                }
            }
            // for mailbox files
            if (key_exists('files', $validatedData)) {
                $fileName = [];
                $withOutZipFiles = [];
                foreach ($validatedData['files'] as $item) {
                    if($item != null){
                        $fileArr = explode(".", $item);
                        if (strtolower($fileArr[count($fileArr) - 1]) == 'zip') {
                            $fileName[] = $fileArr[0];
                        } elseif ($fileArr[count($fileArr) - 1] != 'zip') {
                            $withOutZipFiles[] = storage_path("app/public/mailbox/" . $item);
                        }
                    }
                }
                if(count($fileName) > 0){
                    for ($i = 0; $i <= count($fileName) - 1; $i++) {
                        $files = scandir(storage_path("app/public/mailbox/" . $fileName[$i]));
                        if ($files) {
                            for ($x = 0; $x <= count($files) - 1; $x++) {
                                if (strlen($files[$x]) > 4) {
                                    $path = storage_path("app/public/mailbox/{$fileName[$i]}/{$files[$x]}");
                                    if (file_exists($path)) {
                                        $zip->addFromString(basename($path), file_get_contents($path));
                                    } else {
                                        return "File doesn't exist";
                                    }
                                }
                            }
                        } else {
                            throw new \Exception('No such files or directory');
                        }

                    }
                }

                if (!empty($withOutZipFiles)) {
                    for ($y = 0; $y <= count($withOutZipFiles) - 1; $y++) {
                        $zip->addFromString(basename($withOutZipFiles[$y]), file_get_contents($withOutZipFiles[$y]));
                    }
                }
            }

            $zip->close();
            return $zipName;
        }catch (\Throwable $exception){
            return $exception->getMessage();
        }
    }


}
