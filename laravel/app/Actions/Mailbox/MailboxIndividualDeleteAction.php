<?php

namespace App\Actions\Mailbox;

use App\Helpers\Helper;
use App\Interfaces\Mailbox\DeleteIndividualMailboxInterface;
use App\Models\Mailbox;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MailboxIndividualDeleteAction implements DeleteIndividualMailboxInterface
{
    public static function execute($data)
    {
        DB::beginTransaction();
        try {
            $mail = Mailbox::findOrFail($data['mail']);
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
                        Storage::disk('public')->deleteDirectory("mailbox/{$full_path}/{$fileName}");
                    }
                }else{
                    if(Storage::disk('public')->exists("mailbox/{$full_path}/{$file}")){
                        unlink(storage_path("app/public/mailbox/{$full_path}/{$file}"));
                    }
                }
            }
            $mail->delete();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }

    }

}
