<?php

namespace App\Actions\Xero;

//use App\Action\Storage;
use App\Models\XeroAuthCredential;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use XeroAPI\XeroPHP\Api\AccountingApi;
use XeroAPI\XeroPHP\Api\AssetApi;
use XeroAPI\XeroPHP\Api\IdentityApi;
use XeroAPI\XeroPHP\Api\ProjectApi;
use XeroAPI\XeroPHP\Configuration;
use XeroAPI\XeroPHP\Models\Accounting\Contact;
use XeroAPI\XeroPHP\Models\Accounting\Contacts;
use XeroAPI\XeroPHP\Models\Accounting\Invoice;
use XeroAPI\XeroPHP\Models\Accounting\Invoices;
use XeroAPI\XeroPHP\Models\Accounting\LineItem;

class AuthorizationResourceAction
{
    public function execute()
    {
        ini_set('display_errors', 'On');
//        require __DIR__ . '/vendor/autoload.php';
//        require_once('storage.php');

        // Use this class to deserialize error caught


        // Storage Class uses sessions for storing token > extend to your DB of choice
//        $storage = new StorageClass();
//        $storage = (new StorageAction());
        $xero_auth_cred  = XeroAuthCredential::where('id',1)->first();
//        $xeroTenantId = (string)$storage->getSession()['tenant_id'];
        if($xero_auth_cred!=null){
            $xeroTenantId = (string)$xero_auth_cred->tenant_id;
        }else{
            return view('errors.noTenantFound');
        }
        $now = Carbon::parse(time())->toDateTime();
//        dd($now > $xero_auth_cred->expires);


//        if ($storage->getHasExpired()) {
        if ($now > $xero_auth_cred->expires) {
            try {
                $provider = new \League\OAuth2\Client\Provider\GenericProvider([
                    'clientId'                => config('xero.xero_cred.client_id'),
                    'clientSecret'            => config('xero.xero_cred.client_secret'),
                    'redirectUri'             => route('xero.authorize.callback'),
                    'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
                    'urlAccessToken'          => 'https://identity.xero.com/connect/token',
                    'urlResourceOwnerDetails' => 'https://identity.xero.com/resources'
                ]);
                $newAccessToken = $provider->getAccessToken('refresh_token', [
//                'refresh_token' => $storage->getRefreshToken()
                    'refresh_token' => $xero_auth_cred->refresh_token
                ]);
                // Save my token, expiration and refresh token
                $xero_auth_cred->access_token = $newAccessToken->getToken();
                $xero_auth_cred->expires = Carbon::parse($newAccessToken->getExpires())->toDateTime();
                $xero_auth_cred->tenant_id =  $xeroTenantId;
                $xero_auth_cred->refresh_token =   $newAccessToken->getRefreshToken();
                $xero_auth_cred->id_token =   $newAccessToken->getValues()["id_token"];
                $xero_auth_cred->save();
//            $storage->setToken(
//                $newAccessToken->getToken(),
//                $newAccessToken->getExpires(),
//                $xeroTenantId,
//                $newAccessToken->getRefreshToken(),
//                $newAccessToken->getValues()["id_token"] );
            }catch(\Exception $e){
                return view('errors.noTenantFound');
            }
        }

//        $config = Configuration::getDefaultConfiguration()->setAccessToken((string)$storage->getSession()['token'] );
        $config = Configuration::getDefaultConfiguration()->setAccessToken((string)$xero_auth_cred->access_token );
        $invoice_id = Session::get('invoice_id');
        if(Session::get('call') == 'invoice create'){
            $invoice = (new InvoiceCreateAction())->execute($config,$xeroTenantId,$invoice_id);
            if (key_exists('error', $invoice)){
                return redirect()->route('billing.index')->with('error', 'Xero Failure | Billing has reverted to previous stage');
//                    return $invoice['error'];
            }elseif (key_exists('disconnected', $invoice)){
                return view('errors.noTenantFound');
            }
            return redirect()->route('billing.index')->with('success',  'Invoice Created in Xero Successfully');
        } else if(Session::get('call') == 'invoice edit'){
            try {
                $invoice = (new InvoiceUpdateAction())->execute($config,$xeroTenantId,$invoice_id);
                if (key_exists('error', $invoice)){
                    return redirect()->route('billing.index')->with('error', 'Failed to update invoice in Xero');
//                    return $invoice['error'];

                }elseif (key_exists('disconnected', $invoice)){
                    return view('errors.noTenantFound');
                }
                return redirect()->route('billing.index')->with('success',  'Invoice updated in Xero successfully');
            }catch(\Exception $e){
                throw new \Exception($e->getMessage());
            }
        }else if(Session::get('call') == 'invoice void'){
            try {
                $invoice = (new InvoiceVoidAction())->execute($config,$xeroTenantId,$invoice_id);
                if (key_exists('error', $invoice)){
                    return redirect()->route('billing.index')->with('error', 'Failed to void invoice in Xero');
//                    return $invoice['error'];
                }elseif (key_exists('disconnected', $invoice)){
                    return view('errors.noTenantFound');
                }
                return redirect()->route('billing.index')->with('success',  'Invoice voided in Xero successfully');
            }catch(\Exception $e){
                throw new \Exception($e->getMessage());
            }
        }else if(Session::get('call') == 'disconnect'){
            try {
                $invoice = (new DisconnectFromXeroAction())->execute($config);
                if (key_exists('error', $invoice)){
                    return redirect()->route('billing.index')->with('error', 'Failed to void invoice in Xero');
//                    return $invoice['error'];
                }elseif (key_exists('disconnected', $invoice)){
                    return redirect()->route('billing.index')->with('error', 'You are already disconnected');
//                    return $invoice['error'];
//                    return view('errors.noTenantFound');
                }
                return redirect()->route('billing.index')->with('success',  'Disconnected From Xero successfully');
            }catch(\Exception $e){
                throw new \Exception($e->getMessage());
            }
        } else if(Session::get('call') == 'get connection'){
            $connection = (new GetOrganizationConnectionAction())->execute($config,$xeroTenantId);
            if (key_exists('disconnected', $connection)){
                return view('errors.noTenantFound');
            }elseif (key_exists('unauthorized', $connection)){
                return  view('errors.noTenantFound');
            }
            return redirect()->route('billing.index')->with('success',  $connection['message']);
        }else{
            exit();
        }


//        $accountingApi = new AccountingApi(
////            new GuzzleHttp\Client(),
//            new Client(),
//            $config
//        );
//
//        $assetApi = new AssetApi(
////            new GuzzleHttp\Client(),
//            new Client(),
//            $config
//        );
//
////        $identityApi = new XeroAPI\XeroPHP\Api\IdentityApi(
//        $identityApi = new IdentityApi(
////            new GuzzleHttp\Client(),
//            new Client(),
//            $config
//        );
//
////        $projectApi = new XeroAPI\XeroPHP\Api\ProjectApi(
//        $projectApi = new ProjectApi(
////            new GuzzleHttp\Client(),
//            new Client(),
//            $config
//        );

//        $message = "no API calls";
//        if (isset($_GET['action'])) {
//            if ($_GET["action"] == 1) {
//                // Get Organisation details
//                $apiResponse = $accountingApi->getOrganisations($xeroTenantId);
//                $message = 'Organisation Name: ' . $apiResponse->getOrganisations()[0]->getName();
//            } else if ($_GET["action"] == 2) {
//                // Create Contact
//                try {
////                    $person = new XeroAPI\XeroPHP\Models\Accounting\ContactPerson;
//                    $person = new ContactPerson();
//                    $person->setFirstName("John")
//                        ->setLastName("Smith")
//                        ->setEmailAddress("john.smith@24locks.com")
//                        ->setIncludeInEmails(true);
//
//                    $arr_persons = [];
//                    array_push($arr_persons, $person);
//
////                    $contact = new XeroAPI\XeroPHP\Models\Accounting\Contact;
//                    $contact = new Contact();
//                    $contact->setName('FooBar')
//                        ->setFirstName("Foo")
//                        ->setLastName("Bar")
//                        ->setEmailAddress("ben.bowden@24locks.com")
//                        ->setContactPersons($arr_persons);
//
//                    $arr_contacts = [];
//                    array_push($arr_contacts, $contact);
////                    $contacts = new XeroAPI\XeroPHP\Models\Accounting\Contacts;
//                    $contacts = new Contacts();
//                    $contacts->setContacts($arr_contacts);
//
//                    $apiResponse = $accountingApi->createContacts($xeroTenantId,$contacts);
//                    $message = 'New Contact Name: ' . $apiResponse->getContacts()[0]->getName();
//                } catch (\XeroAPI\XeroPHP\ApiException $e) {
//                    $error = AccountingObjectSerializer::deserialize(
//                        $e->getResponseBody(),
//                        '\XeroAPI\XeroPHP\Models\Accounting\Error',
//                        []
//                    );
//                    $message = "ApiException - " . $error->getElements()[0]["validation_errors"][0]["message"];
//                }
//            } else if ($_GET["action"] == 3) {
//                $if_modified_since = new \DateTime("2019-01-02T19:20:30+01:00"); // \DateTime | Only records created or modified since this timestamp will be returned
//                $if_modified_since = null;
//                $where = 'Type=="ACCREC"'; // string
//                $where = null;
//                $order = null; // string
//                $ids = null; // string[] | Filter by a comma-separated list of Invoice Ids.
//                $invoice_numbers = null; // string[] |  Filter by a comma-separated list of Invoice Numbers.
//                $contact_ids = null; // string[] | Filter by a comma-separated list of ContactIDs.
//                $statuses = array("DRAFT", "SUBMITTED");;
//                $page = 1; // int | e.g. page=1 – Up to 100 invoices will be returned in a single API call with line items
//                $include_archived = null; // bool | e.g. includeArchived=true - Contacts with a status of ARCHIVED will be included
//                $created_by_my_app = null; // bool | When set to true you'll only retrieve Invoices created by your app
//                $unitdp = null; // int | e.g. unitdp=4 – You can opt in to use four decimal places for unit amounts
//
//                try {
//                    $apiResponse = $accountingApi->getInvoices($xeroTenantId, $if_modified_since, $where, $order, $ids, $invoice_numbers, $contact_ids, $statuses, $page, $include_archived, $created_by_my_app, $unitdp);
//                    if ( count($apiResponse->getInvoices()) > 0 ) {
//                        $message = 'Total invoices found: ' . count($apiResponse->getInvoices());
//                    } else {
//                        $message = "No invoices found matching filter criteria";
//                    }
//                } catch (Exception $e) {
//                    echo 'Exception when calling AccountingApi->getInvoices: ', $e->getMessage(), PHP_EOL;
//                }
//            } else if ($_GET["action"] == 4) {
//                // Create Multiple Contacts
//                try {
////                    $contact = new XeroAPI\XeroPHP\Models\Accounting\Contact;
//                    $contact = new Contact();
//                    $contact->setName('George Jetson')
//                        ->setFirstName("George")
//                        ->setLastName("Jetson")
//                        ->setEmailAddress("george.jetson@aol.com");
//
//                    // Add the same contact twice - the first one will succeed, but the
//                    // second contact will throw a validation error which we'll catch.
//                    $arr_contacts = [];
//                    array_push($arr_contacts, $contact);
//                    array_push($arr_contacts, $contact);
////                    $contacts = new XeroAPI\XeroPHP\Models\Accounting\Contacts;
//                    $contacts = new Contacts();
//                    $contacts->setContacts($arr_contacts);
//
//                    $apiResponse = $accountingApi->createContacts($xeroTenantId,$contacts,false);
//                    $message = 'First contacts created: ' . $apiResponse->getContacts()[0]->getName();
//
//                    if ($apiResponse->getContacts()[1]->getHasValidationErrors()) {
//                        $message = $message . '<br> Second contact validation error : ' . $apiResponse->getContacts()[1]->getValidationErrors()[0]["message"];
//                    }
//                } catch (\XeroAPI\XeroPHP\ApiException $e) {
//                    $error = AccountingObjectSerializer::deserialize(
//                        $e->getResponseBody(),
//                        '\XeroAPI\XeroPHP\Models\Accounting\Error',
//                        []
//                    );
//                    $message = "ApiException - " . $error->getElements()[0]["validation_errors"][0]["message"];
//                }
//            } else if ($_GET["action"] == 5) {
//                // DELETE the org FIRST Connection returned
//                $connections = $identityApi->getConnections();
//                $id = $connections[0]->getId();
//                $result = $identityApi->deleteConnection($id);
//            }
//        }



    }

}
