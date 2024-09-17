<?php

namespace App\Actions\Company;

use App\Models\Company;

class CompanyEditAction
{
    public function execute($slug)
    {
        $response = Company::where('slug', $slug)->first();
        return $response;

    }

}
