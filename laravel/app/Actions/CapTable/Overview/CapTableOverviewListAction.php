<?php

namespace App\Actions\CapTable\Overview;

use App\Helpers\CapTableCompanyHelper;
use App\Models\CapTableActivity;

class CapTableOverviewListAction
{
    public function execute($date)
    {
        $data = CapTableActivity::where('company_id', CapTableCompanyHelper::get())
            ->whereDate('transaction_date','<=',$date)
            ->selectRaw('share_type as name, sum(share_number) as shares, sum(amount) as total_amount')
            ->groupBy('share_type')
            ->get();

        return $data;
    }
}
