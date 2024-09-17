<?php

namespace App\Actions\ESOP;

use App\Models\ESOP;

class FetchEditEntryDataAction
{
    public function execute($entry)
    {
        $data = ESOP::with(['member'])->where('id', $entry)->first();
        return $data;
    }

}
