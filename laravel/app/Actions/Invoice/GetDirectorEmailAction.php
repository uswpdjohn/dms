<?php

namespace App\Actions\Invoice;

use App\Models\CompanyManagement;

class GetDirectorEmailAction
{
    public function execute($user_id)
    {
        $user = CompanyManagement::where('id', $user_id)->first();
        return $user;
    }

}
