<?php

namespace App\Actions\Invoice;

use App\Actions\Hitpay\Hitpay;
use App\Actions\Xero\InvoiceStatusChangeAction;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class MakePaymentAction
{
    public function execute($data)
    {
//        $result =(new Hitpay)->makePayment($reference_number); //reference id from paymentRequest()
        $billing_invoice = Invoice::where('reference_number',$data['invoice_reference_number'])->first();
        $billing_invoice->status = 'paid';
        $billing_invoice->payment_date=Carbon::now();
        $billing_invoice->save();


        $company = Company::where('id',$billing_invoice->company_id)->first();
        $company->status = 'active';
        $company->save();

        $invoice_payment = new InvoicePayment();
        $invoice_payment->user_id = auth()->guard('web')->user()->id;
        $invoice_payment->invoice_id = $billing_invoice->id;
        $invoice_payment->hitpay_payment_id = $data['hitpay_payment_id'];
        $invoice_payment->save();

        return (new InvoiceStatusChangeAction())->execute($billing_invoice->xero_invoice_id,$billing_invoice->grand_total,$data['invoice_reference_number']);




//        return $billing_invoice;



























//        $invoice->setStatus(\XeroAPI\XeroPHP\Models\Accounting\Invoice::STATUS_PAID);
//        try {
//            $result = $accountingApi->updateInvoice($xeroTenantId,$billing_invoice->xero_invoice_id,$invoice);
////            Session::forget(['call','invoice_id']);
////            // DELETE the org Connection returned
////            $connections = $identityApi->getConnections();
////            foreach ($connections as $connection){
////                $id = $connection->getId();
////                $identityApi->deleteConnection($id);
////            }
//            return array('success' => 1);
//
//        } catch (\XeroAPI\XeroPHP\ApiException $e) {
//            $error = AccountingObjectSerializer::deserialize(
//                $e->getResponseBody(),
//                '\XeroAPI\XeroPHP\Models\Accounting\Error',
//                []
//            );
//            $message = "ApiException - " . $error->getElements()[0]["validation_errors"][0]["message"];
//            return array('error' => $message);
//        }
        /*INVOICE END*/

//        return $invoice;

    }

}
