<?php

namespace App\Actions\Xero;

use Carbon\Carbon;
use Cassandra\Date;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use XeroAPI\XeroPHP\AccountingObjectSerializer;
use XeroAPI\XeroPHP\Api\AccountingApi;
use XeroAPI\XeroPHP\Api\IdentityApi;
use XeroAPI\XeroPHP\ApiException;
use XeroAPI\XeroPHP\Models\Accounting\Contact;
use XeroAPI\XeroPHP\Models\Accounting\Contacts;
use XeroAPI\XeroPHP\Models\Accounting\Invoice;
use XeroAPI\XeroPHP\Models\Accounting\Invoices;
use XeroAPI\XeroPHP\Models\Accounting\LineItem;

class InvoiceCreateAction
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
        if ($result !=null){
            $billing_invoice = \App\Models\Invoice::where('id', $invoice_id)->first();
//        dd($billing_invoice->invoice_no);
            $summarizeErrors = true;
            $unitdp = 2;
            $contact_id = '';

            /*CONTACT START*/

            $contact = new Contact();
            //check if contact exists
            $if_modified_since = null;
            $where = 'Name==' . '"'.$billing_invoice->user->first_name . ' '. $billing_invoice->user->last_name . '"'; // string
            $order = null; // string
            $ids = null; // string[] | Filter by a comma-separated list of Contact Ids.
            $page = 1; // int | e.g. page=1 – Up to 100 invoices will be returned in a single API call with line items
            $include_archived = null; // bool | e.g. includeArchived=true - Contacts with a status of ARCHIVED will be included
            $summary_only = null;
            $search_terms = null;
            $get_contact = $accountingApi->getContacts($xeroTenantId, $if_modified_since, $where, $order, $ids,$page, $include_archived, $summary_only, $search_terms);

            $xero_contact = $get_contact->getContacts() != null ? $get_contact->getContacts()[0]->getName() : '';
            $billing_contact = $billing_invoice->user->first_name . ' '. $billing_invoice->user->last_name;



            //if contact does not exist then execute following
            if( $xero_contact != $billing_contact){
                $contact->setName($billing_invoice->user->first_name . ' '. $billing_invoice->user->last_name);
                $contact->setFirstName($billing_invoice->user->first_name);
                $contact->setLastName( $billing_invoice->user->last_name);
                $contact->setEmailAddress($billing_invoice->user->email);

                $contacts = new Contacts();
                $arr_contacts = [];
                array_push($arr_contacts, $contact);
                $contacts->setContacts($arr_contacts);
                try {
                    $result = $accountingApi->createContacts($xeroTenantId, $contacts, $summarizeErrors);
                    $contact_id = $result->getContacts()[0]->getContactId();
//                $get_contact = $accountingApi->getContacts($xeroTenantId,$contact->contact_id);
                } catch (ApiException $e) {
                    throw new Exception( 'Exception when calling AccountingApi->createContacts: ' .$e->getMessage());
//            echo 'Exception when calling AccountingApi->createContacts: ', $e->getMessage(), PHP_EOL;
                }
            }else{
                $contact_id = $get_contact->getContacts()[0]->getContactId();
            }
            $contact = new Contact();
            $contact->setContactID($contact_id);
            /*CONTACT END*/
            /*LINE ITEM START*/
            $lineItem = new LineItem();
            $lineItem->setDescription($billing_invoice->description);
            $lineItem->setQuantity(1.0);
            if($billing_invoice->discount != null){
                $lineItem->setUnitAmount($billing_invoice->sub_total);
                $lineItem->setDiscountAmount($billing_invoice->discount);
            }else{
                $lineItem->setLineAmount($billing_invoice->sub_total);
            }

            if ($billing_invoice->gst == 8){

                $lineItem->setTaxType('TAX001');

            }elseif ($billing_invoice->gst == 9){

                $lineItem->setTaxType('TAX002');
            }else{

                $lineItem->setTaxType('TAX003');
            }
            $lineItem->setAccountCode('200');
            $lineItems = [];
            array_push($lineItems, $lineItem);
            /*LINE ITEM START*/

            /*INVOICE START*/
            $invoice = new Invoice();
            $invoice->setCurrencyCode('SGD');
            $invoice->setType(Invoice::TYPE_ACCREC);
            $invoice->setLineAmountTypes('Exclusive');
            $invoice->setInvoiceNumber($billing_invoice->invoice_no);
            $invoice->setContact($contact);
            $invoice->setDate($billing_invoice->invoice_date);
            $invoice->setDueDate($billing_invoice->due_date);
            $invoice->setLineItems($lineItems);
//        $invoice->setReference('Subscription Fee');
//        $invoice->setStatus(Invoice::STATUS_DRAFT);
            $invoice->setStatus(Invoice::STATUS_AUTHORISED);

            $invoices = new Invoices();
            $arr_invoices = [];
            array_push($arr_invoices, $invoice);
            $invoices->setInvoices($arr_invoices);

            try {
                $result = $accountingApi->createInvoices($xeroTenantId, $invoices, $summarizeErrors, $unitdp);
                $xero_invoice_id = $result->getInvoices()[0]->getInvoiceId();
                if ($xero_invoice_id){
                    $goa_invoice = \App\Models\Invoice::where('id', $invoice_id)->first();
                    $goa_invoice->xero_invoice_id = $xero_invoice_id;
                    $goa_invoice->save();
                    Session::forget(['call','invoice_id']);
                }


                return array('success' => 1);

            } catch (\XeroAPI\XeroPHP\ApiException $e) {
                $error = AccountingObjectSerializer::deserialize(
                    $e->getResponseBody(),
                    '\XeroAPI\XeroPHP\Models\Accounting\Error',
                    []
                );
                $invoice = \App\Models\Invoice::where('id', $invoice_id)->first();
                $invoice->delete();
                Session::forget(['call','invoice_id']);

//                $message = "ApiException - " . $error->getElements()[0]["validation_errors"][0]["message"];
                $message = 'Api Error';
                return array('error' => $message);
            }
            /*INVOICE END*/
        }else{
            return  array('disconnected' =>'disconnected');
        }


    }
}
