<?php

namespace App\Actions\Invoice;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class InvoiceVoidAction
{
    public function execute($id)
    {
        DB::beginTransaction();
        try {
            $invoice = Invoice::where('id',$id)->first();
            $invoice->status = 'void';
            $invoice->save();
            DB::commit();
            Session::put(['invoice_id'=> $invoice->id, 'call'=>'invoice void']);
            return $invoice;

        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }
}
