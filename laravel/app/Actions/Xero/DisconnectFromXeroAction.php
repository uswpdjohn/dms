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

class DisconnectFromXeroAction
{
    public function execute($config)
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
        try {
            if ($result !=null){
                // DELETE the org Connection returned
                $connections = $identityApi->getConnections();
                foreach ($connections as $connection){
                    $id = $connection->getId();
                    $identityApi->deleteConnection($id);
                }
                Session::forget('call');
                return  array('success' =>1);
//        dd('disconnected');
            }else{
                return  array('disconnected' =>'disconnected');
            }
        }catch (Exception $exception){
            return array('error' => $exception->getMessage());
        }



    }
}
