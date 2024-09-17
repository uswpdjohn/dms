<?php

namespace App\Actions\Mailbox;

use App\Models\Mailbox;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Util\Exception;

class MailboxRenameDirectoryAction
{
    public function execute($validatedData)
    {
        DB::beginTransaction();
        try {
            $prefix = 'mailbox/'.$validatedData['company_root_directory'].'/'.$validatedData['company_category_directory'];
            $from = $prefix.'/'. $validatedData['prev_directory'];
            $to= $prefix.'/'.$validatedData['directory'];
            if($validatedData['directory'] != $validatedData['prev_directory']){
                Storage::disk('public')->move($from,$to);
                Mailbox::where('directory', $validatedData['prev_directory'])->update(['directory' => $validatedData['directory']]);
                DB::commit();
                return true;
            }
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }


    }

}
