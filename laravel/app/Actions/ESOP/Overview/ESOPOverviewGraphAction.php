<?php

namespace App\Actions\ESOP\Overview;

use App\Models\ESOP;

class ESOPOverviewGraphAction
{
    public function execute($date)
    {
        return ESOP::sumofShares()
            ->companyId()
            ->where('issue_date','<=',$date)
            ->get();
    }

}
