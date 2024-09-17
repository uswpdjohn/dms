<?php

namespace App\Actions\CapTable;

use App\Helpers\CapTableCompanyHelper;
use App\Models\CompanyMember;

class GetCompanyMembersAction
{
    public function execute()
    {
        $data= CompanyMember::where('company_id', CapTableCompanyHelper::get())->get();
        return $data;
    }

}
