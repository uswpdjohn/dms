<?php

namespace App\Actions\Xero;

use GuzzleHttp\Client;
use XeroAPI\XeroPHP\Api\AccountingApi;
use XeroAPI\XeroPHP\Api\IdentityApi;

class GetOrganizationConnectionAction
{
    public function execute($config,$xeroTenantId)
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
        $responseArray=array();

        if ($result!=null){
            // Get Organisation details
            try {
                $apiResponse = $accountingApi->getOrganisations($xeroTenantId);
                $message = 'Organisation Name: ' . $apiResponse->getOrganisations()[0]->getName();
                return $responseArray = array('success' => true, 'message' => $message );
            }catch (\Exception $exception){
                return array('unauthorized' => true);
            }
        }else{
            return $responseArray = array('disconnected' => true);
        }
    }

}
