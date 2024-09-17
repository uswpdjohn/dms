<?php

namespace App\Actions\Xero;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use XeroAPI\XeroPHP\AccountingObjectSerializer;
use XeroAPI\XeroPHP\Api\AccountingApi;
use XeroAPI\XeroPHP\Api\IdentityApi;
use XeroAPI\XeroPHP\Models\Accounting\Contact;
use XeroAPI\XeroPHP\Models\Accounting\Contacts;
use XeroAPI\XeroPHP\Models\Accounting\Invoice;
use XeroAPI\XeroPHP\Models\Accounting\LineItem;

class InvoiceVoidAction
{
    public function execute($config,$xeroTenantId, $invoice_id)
    {
        $accountingApi = new AccountingApi(
            new Client(),
            $config
        );
        $identityApi = new IdentityApi(
            new Client(),
            $config
        );
        $result = $identityApi->getConnections();
        if ($result!=null){
            //        $apiResponse = $accountingApi->getOrganisations($xeroTenantId);

            $billing_invoice = \App\Models\Invoice::where('id', $invoice_id)->first();

            /*INVOICE START*/
            $invoice = new Invoice();
            $invoice->setStatus(Invoice::STATUS_VOIDED);
            try {
                $result = $accountingApi->updateInvoice($xeroTenantId,$billing_invoice->xero_invoice_id,$invoice);
                Session::forget(['call','invoice_id']);
//            // DELETE the org Connection returned
//            $connections = $identityApi->getConnections();
//            foreach ($connections as $connection){
//                $id = $connection->getId();
//                $identityApi->deleteConnection($id);
//            }
                return array('success' => 1);

            } catch (\XeroAPI\XeroPHP\ApiException $e) {
                $error = AccountingObjectSerializer::deserialize(
                    $e->getResponseBody(),
                    '\XeroAPI\XeroPHP\Models\Accounting\Error',
                    []
                );
                $message = "ApiException - " . $error->getElements()[0]["validation_errors"][0]["message"];
                return array('error' => $message);
            }
            /*INVOICE END*/
        }else{
            return  array('disconnected' =>'disconnected');
        }
    }

}
