<?php

namespace App\Actions\CapTable;

use App\Models\ShareCertificate;

class DownloadShareCertificateAction
{
    public function execute($document_id)
    {
        $share_cert = ShareCertificate::where('document_id', $document_id)->first();
        $fileName= $share_cert->file;
        $pathToFile= public_path('images/shareCertificate/'. $fileName);
        return $pathToFile;

    }

}
