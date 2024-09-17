<?php

namespace App\Actions\Invoice;

use App\Models\Invoice;

class FilterByStatusAction
{
    public function execute($status,$count,$orderBy)
    {
        if ($status=='all'){
            $invoice = Invoice::with(['user','company'])
                ->orderBy('created_at',$orderBy)
                ->paginate($count);
            return $invoice;
        }
        $invoice = Invoice::with(['user','company'])
            ->where('status',$status)
            ->orderBy('created_at',$orderBy)
            ->paginate($count);
        return $invoice;
    }

}
