<?php

namespace App\Actions\Invoice;

use App\Models\Invoice;

class InvoiceAdminListAction
{
    public function execute($count,$orderBy,$request)
    {
        $invoice = Invoice::with(['company','user'])->whereHas('company')->orderBy('created_at',$orderBy)->paginate($count);
        return $invoice;
    }

}
