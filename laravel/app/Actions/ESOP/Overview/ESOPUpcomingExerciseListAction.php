<?php

namespace App\Actions\ESOP\Overview;

use App\Models\ESOP;

class ESOPUpcomingExerciseListAction
{
    public function execute($count)
    {
        $data = ESOP::with(['member', 'company'])
            ->companyId()
            ->issued()
            ->where('granted_date', '>=', today()->toDateString())
            ->orderBy('created_at','DESC')
            ->paginate($count);
        return $data;
    }

}
