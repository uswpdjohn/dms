<?php

namespace App\Actions\DocumentManagement;

use App\Models\DocumentManagement;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class DownloadLocalFileAction
{
    public function execute($document_id)
    {
        $document = DocumentManagement::where('document_id', $document_id)->pluck('file');
//        $path_to_file = Storage::disk('public')->path($document[0]);

        $file =  Storage::disk('public')->get($document[0]);
        $decrypted = Crypt::decrypt($file);
        return [ 'decrypted_file' => $decrypted, 'file'=> $document[0]];


    }

}
