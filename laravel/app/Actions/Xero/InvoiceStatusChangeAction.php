<?php

namespace App\Actions\Xero;

use App\Jobs\SendReminderStatusChangeFailingInXero;
use App\Models\User;
use App\Models\XeroAuthCredential;
use App\Notifications\MailboxNotification;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use XeroAPI\XeroPHP\AccountingObjectSerializer;
use XeroAPI\XeroPHP\Api\AccountingApi;
use XeroAPI\XeroPHP\Api\IdentityApi;
use XeroAPI\XeroPHP\Configuration;
use XeroAPI\XeroPHP\Models\Accounting\Account;
use XeroAPI\XeroPHP\Models\Accounting\Invoice;
use XeroAPI\XeroPHP\Models\Accounting\Payment;
use XeroAPI\XeroPHP\Models\Accounting\Payments;

class InvoiceStatusChangeAction
{
    public function execute($invoice_id,$amount,$reference_number)

    {
        $xeroTenantId='';
        $xero_auth_cred  = XeroAuthCredential::where('id',1)->first();
        if($xero_auth_cred!=null){
            $xeroTenantId = (string)$xero_auth_cred->tenant_id;
        }else{
            if (auth()->guard('web')->user()->hasRole('Company User')){
                return view('errors.noTenantForCustomer');
            }
        }
        $now = Carbon::parse(time())->toDateTime();

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
            } catch (Exception $exception){

            }

        }

        $config = Configuration::getDefaultConfiguration()->setAccessToken((string)$xero_auth_cred->access_token );
        $accountingApi = new AccountingApi(
            new Client(),
            $config
        );
        $identityApi = new IdentityApi(
            new Client(),
            $config
        );
        try {
            $result = $identityApi->getConnections();
        }catch (Exception $exception){
            SendReminderStatusChangeFailingInXero::dispatch($invoice_id); //notify admin that xero action failed
//            return view('errors.noTenantForCustomer');
        }


//        if ($result!=null){
            /*INVOICE START*/
            $invoice = new Invoice();
            $invoice->setInvoiceID($invoice_id);
            $invoice->setReference($reference_number);
            $invoice->setLineItems([]);

            $account = new Account();
            $account->setCode('GOA-200');

            $payment = new Payment();
            $payment->setAccount($account);
            $payment->setInvoice($invoice);
            $payment->setAmount($amount);
            $payment->setDate(now()->toDateString());


            try {
                return $accountingApi->createPayment($xeroTenantId, $payment);
            } catch (\XeroAPI\XeroPHP\ApiException $e) {
                $error = AccountingObjectSerializer::deserialize(
                    $e->getResponseBody(),
                    '\XeroAPI\XeroPHP\Models\Accounting\Error',
                    []
                );
                if($error->getElements() !=null){
                    $message = "ApiException - " . $error->getElements()[0]["validation_errors"][0]["message"];
                    return array('error' => $message);
                }

            }
//        }else{
//            SendReminderStatusChangeFailingInXero::dispatch($invoice_id); //notify admin that xero action failed
//        }
    }

}
