<?php

namespace App\Actions\Mailbox;

use App\Helpers\Helper;
use App\Models\Mailbox;
use ZipArchive;

class MailboxIndividualDownloadAction
{

    public function execute($id)
    {
        $mail=Mailbox::where('id',$id)->firstOrFail();
        $storedFile=$mail->file;
        $zip = new ZipArchive;                          //Initializing ZIP
        $zipName="Gateway of Asia-Mailbox.zip";
        $zip->open($zipName, ZipArchive::CREATE); //opening zip
        $explodeStoredFile = explode(".", $storedFile);
        $category =  Helper::convertToTitleCase($mail->category);
        if (strtolower($explodeStoredFile[count($explodeStoredFile) - 1]) == 'zip') {
            $fileName = 'company_'.$mail->company_id.'/'.$category.'/'.$mail->directory.'/'.$explodeStoredFile[0];
            try {
                $files = scandir(storage_path("app/public/mailbox/" .  $fileName));
                foreach($files as $item){
                    if (strlen($item)>4){
                        $path=storage_path("app/public/mailbox/{$fileName}/{$item}");
                        if (file_exists($path)){;
                            $zip->addFromString(basename($path),file_get_contents($path));
                        }else{
                            return "File doesn't exist";
                        }
                    }
                }
                return ['zipName'=>$zipName];
            }catch (\Exception $exception){
                throw new \Exception('Something went wrong!');
            }

        }else{
            try {
                $pathToFile = storage_path('app/public/mailbox/'.'company_'.$mail->company_id.'/'.$category.'/'.$mail->directory.'/'.$storedFile);
                return ['pathToFile'=>$pathToFile];
            }catch (\Exception $exception){
                throw new \Exception('Something went wrong!');
            }
        }
    }
}
