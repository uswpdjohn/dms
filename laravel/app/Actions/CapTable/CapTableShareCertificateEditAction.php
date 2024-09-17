<?php

namespace App\Actions\CapTable;

use App\Helpers\CapTableCompanyHelper;
use App\Models\CompanyMember;
use App\Models\ShareCertificate;

class CapTableShareCertificateEditAction
{
    public function execute($id)
    {
        $certificate = ShareCertificate::with(['certificateSigners','company','member'])
            ->whereHas('company')
            ->where('id',$id)->first();
        $company_members= CompanyMember::where('company_id',CapTableCompanyHelper::get())->orderBy('name')->get();
        return ['certificate'=>$certificate,'company_members'=>$company_members];
    }

}
