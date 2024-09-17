<?php

namespace App\Actions\Company;

use App\Models\Company;

class GetDirectorForEditAction
{
    public function execute($slug)
    {
        $response = Company::with(['directors','shareholders'])->where('slug', $slug)->first();
        return $response;

    }

}
