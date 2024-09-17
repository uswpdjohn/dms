<?php

namespace App\Actions\Mailbox;

use App\Helpers\Helper;
use App\Models\Mailbox;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class MailboxDownloadAction
{
    public function execute($validatedData)
    {


//        $explodedId=explode(',',$id);
        $mails=Mailbox::whereIn('id', $validatedData['mail-id'])->get();
        $allFile=[];
        $allDirectory=[];
        $files=[];
        $withOutZipFiles=[];
        $zipName="Gateway of Asia-Mailbox.zip";
        $fileName=[];
        foreach ($mails as $mail){
            if ( $mail->file != null){
                $allFile[] = $mail->file;
                $category_directory =  Helper::convertToTitleCase($mail->category);
                $allDirectory[] ='company_'.$mail->company_id.'/'.$category_directory.'/'. $mail->directory;
            }
        }
        if (!empty($allFile)){
            $zip = new ZipArchive;
            $zip->open($zipName, ZipArchive::CREATE);
            for ($x=0;$x<=count($allFile)-1; $x++) {
                $fileArr = explode(".", $allFile[$x]);
                if (strtolower($fileArr[count($fileArr) - 1]) == 'zip') {
                    $fileName[] =$allDirectory[$x].'/'. $fileArr[0];
                } elseif ($fileArr[count($fileArr) - 1] != 'zip') {
                    $withOutZipFiles[] = storage_path("app/public/mailbox/". $allDirectory[$x].'/'. $allFile[$x]);
                }
            }


            for ($i=0;$i<=count($fileName)-1;$i++){
                try {
                    $files = scandir(storage_path("app/public/mailbox/" .  $fileName[$i]));
                    if ($files){
                        for ($x=0;$x<=count($files)-1;$x++){
                            if (strlen($files[$x])>4){
                                $path=storage_path("app/public/mailbox/{$fileName[$i]}/{$files[$x]}");
                                if (file_exists($path)){
                                    $zip->addFromString(basename($path), file_get_contents($path));
                                }
                            }
                        }
                    }
                }catch (\Exception $exception){
                    throw new \Exception( 'No such files or directory');
                }
            }
            if (!empty($withOutZipFiles)){
                for ($y=0;$y<=count($withOutZipFiles)-1;$y++){
                    $zip->addFromString(basename($withOutZipFiles[$y]), file_get_contents($withOutZipFiles[$y]));
                }
            }
            $zip->close();
            return ["zipName"=>$zipName];
        }
        return ['empty' => true];

    }
}
