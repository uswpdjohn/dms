<?php

namespace App\Actions\ESOP;


use App\Models\ESOP;

class ESOPShowAction
{
    public function execute($id)
    {
        return ESOP::with(['member', 'company'])->findOrFail($id);
    }
}
