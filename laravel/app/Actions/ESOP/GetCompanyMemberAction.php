<?php

namespace App\Actions\ESOP;

use App\Helpers\EsopCompanyHelper;
use App\Models\CompanyMember;

class GetCompanyMemberAction
{
    public function execute()
    {
        $members = CompanyMember::where('company_id', EsopCompanyHelper::get())->where('name', '!=', 'ESOP Reserve')->orderBy('name')->get();
        return $members;
    }

}
