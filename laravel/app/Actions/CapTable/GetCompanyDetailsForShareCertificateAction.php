<?php

namespace App\Actions\CapTable;

use App\Helpers\CapTableCompanyHelper;
use App\Models\Company;

class GetCompanyDetailsForShareCertificateAction
{
    public function execute()
    {
        $data= Company::where('id', CapTableCompanyHelper::get())->first();
        return $data;
    }

}
