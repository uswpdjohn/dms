<?php

namespace App\Actions\Invoice;

use App\Models\Invoice;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;

class UpdateInvoiceAction
{
    public function execute($validatedData,$id)
    {
        try {
            $invoice=Invoice::where('id', $id)->first();
            $invoice->update($validatedData);
            Session::put(['invoice_id'=> $invoice->id, 'call'=>'invoice edit']);
            return $invoice;

        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }

}
