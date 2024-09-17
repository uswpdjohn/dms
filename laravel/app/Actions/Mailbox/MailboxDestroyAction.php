<?php

namespace App\Actions\Mailbox;

use App\Helpers\Helper;
use App\Interfaces\Mailbox\DeleteBulkMailboxInterface;
use App\Models\Mailbox;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MailboxDestroyAction implements DeleteBulkMailboxInterface
{
    public static function execute($validatedData)
    {
        DB::beginTransaction();
        try {
            $mails = Mailbox::whereIn('id', $validatedData['mail-id'])->get();
            foreach ($mails as $mail) {
                $file = $mail->file;
                if ($file != null){
                    $company_directory= 'company_'.$mail->company_id;
                    $directory = $mail->directory;
                    $category_directory  = Helper::convertToTitleCase($mail->category);
                    $full_path = $company_directory.'/'.$category_directory.'/'.$directory;


                    $explodedFile = explode(".", $file);
                    $fileName = $explodedFile[0];
                    if ($explodedFile[count($explodedFile) - 1] == 'zip'){
                        if(Storage::disk('public')->exists("mailbox/{$full_path}/{$fileName}")){
//                            $explodedFile[count($explodedFile) - 1] == 'zip' ?  Storage::deleteDirectory("public/mailbox/{$fileName}") : unlink(storage_path("app/public/mailbox/{{$file}}"));
                            Storage::disk('public')->deleteDirectory("mailbox/{$full_path}/{$fileName}");
                        }
                    }else{
                        if(Storage::disk('public')->exists("mailbox/{$full_path}/{$file}")){
                           unlink(storage_path("app/public/mailbox/{$full_path}/{$file}"));
                        }
                    }
                }
            }
            $mails->map->delete();
            DB::commit();
            return true;
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }
}
