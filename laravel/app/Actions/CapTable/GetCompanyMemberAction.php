<?php

namespace App\Actions\CapTable;

use App\Helpers\CapTableCompanyHelper;
use App\Models\CompanyMember;

class GetCompanyMemberAction
{
    public function execute()
    {
        $members = CompanyMember::where('company_id', CapTableCompanyHelper::get())->orderBy('name')->get();
        return $members;
    }

}
