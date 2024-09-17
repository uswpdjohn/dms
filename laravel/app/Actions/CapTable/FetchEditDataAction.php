<?php

namespace App\Actions\CapTable;

use App\Helpers\CapTableCompanyHelper;
use App\Models\CapTableActivity;

class FetchEditDataAction
{
    public function execute($activity_entry)
    {
        $data = CapTableActivity::with(['member', 'transferMember'])->where('id', $activity_entry)->first();
        return $data;
    }

}
