<?php

namespace App\Actions\CapTable;

use App\Models\ShareCertificate;

class CapTableGenerateShareCertificateId
{
    public function execute($share_type,$company_id)
    {
        $count_share_cer_id = ShareCertificate::where('share_type', $share_type)->where('company_id',$company_id)->count();
        return $count_share_cer_id+1;
//        $last_id = ShareCertificate::orderBy('id', 'desc')->first()->id ?? 0;
//        return str_pad($last_id+1, 1, '0', STR_PAD_LEFT);
//        return $final_share_certificate_id;
    }

}
