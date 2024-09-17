<?php

namespace App\Actions\CapTable;

use App\Helpers\CapTableCompanyHelper;
use App\Models\ShareCertificate;

class CapTableShareCertificateListAction
{
    public function execute($company_id,$count,$orderBy,$search=null)
    {
        $data=ShareCertificate::with(['company','member'=>function ($query) use ($search){
//            if ($search){
//                 $query->where('name', 'like', '%' . $search . '%');
//            }
        }])->where('company_id',$company_id);

        if($search){
            $data=$data->where('share_certificate_id','like', '%' . $search . '%');
        }

        $data=$data->orderBy('created_at', $orderBy)->paginate($count)->appends(array('search' => $search));
        return $data;


    }

}
