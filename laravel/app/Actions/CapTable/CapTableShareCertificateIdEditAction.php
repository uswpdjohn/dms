<?php

namespace App\Actions\CapTable;

use App\Models\ShareCertificate;

class CapTableShareCertificateIdEditAction
{
    public function execute($share_type,$company_id,$cer_id)
    {
        $data=ShareCertificate::where('id',$cer_id)->first();
        if ($share_type == $data->share_type ){
            return $data->share_certificate_id;
        }else{
            $count_share_cer_id = ShareCertificate::where('share_type', $share_type)->where('company_id',$company_id)->count();
            if($share_type=='preference'){
                return 'P'.($count_share_cer_id+1);
            }else{

                return $count_share_cer_id+1;
            }
        }
    }

}
