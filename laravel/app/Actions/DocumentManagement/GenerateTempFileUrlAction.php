<?php

namespace App\Actions\DocumentManagement;

use App\Models\DocumentManagement;
use Illuminate\Support\Facades\Storage;

class GenerateTempFileUrlAction
{
    public function execute($document_id)
    {
        $doc = DocumentManagement::where('document_id', $document_id)->pluck('file');
        $disk = Storage::disk('public');
        return $disk->temporaryUrl($doc[0], now()->addMinutes(config('tempUrlExpiryTime.expiry')));
    }

}
