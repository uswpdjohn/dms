<?php

namespace App\Actions\Company;

use App\Models\SSIC;

class GetAllSSICAction
{
    public function execute()
    {
        $ssics= SSIC::select('id', 'title', 'code')->get();
        return $ssics;
    }

}
