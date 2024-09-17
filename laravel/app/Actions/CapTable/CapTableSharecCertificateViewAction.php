<?php

namespace App\Actions\CapTable;

use App\Models\ShareCertificate;

class CapTableSharecCertificateViewAction
{
    public function execute($share_certificate)
    {
        $certificate = ShareCertificate::with(['certificateSigners','company','member'])
            ->whereHas('company')
            ->where('id',$share_certificate)->first();
        return ['certificate'=>$certificate];
    }

}
