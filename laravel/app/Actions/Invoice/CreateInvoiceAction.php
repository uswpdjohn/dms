<?php

namespace App\Actions\Invoice;

use App\Actions\Xero\AuthorizationAction;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CreateInvoiceAction
{
    public function execute($validatedData)
    {

        DB::beginTransaction();
        try {
            $invoice = Invoice::create($validatedData);
            DB::commit();
            $invoice_id = $invoice->id;
            Session::put(['invoice_id'=> $invoice_id, 'call'=>'invoice create']);
            //connecting with Xero from invoice on submit//
            return $invoice;
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }

}
