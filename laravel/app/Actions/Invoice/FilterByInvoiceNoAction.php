<?php

namespace App\Actions\Invoice;

use App\Models\Invoice;

class FilterByInvoiceNoAction
{
    public function execute($order,$count)
    {
         $invoice=Invoice::with(['user','company'])->orderBy('invoice_no', $order)->paginate($count);
         return $invoice;
    }
}
