<?php

namespace App\Actions\Invoice;

use App\Models\Company;
use App\Models\CompanyManagement;
use App\Models\Invoice;

class GetInvoiceAction
{
    public function execute($id)
    {
        $invoice = Invoice::with(['user','company', 'adminUser'])->where('id',$id)->first();
        $companies=Company::all();
        $director =CompanyManagement::where('id',$invoice->user_id)->first();
        return [$invoice,$companies,$director];
    }
}
