<?php

namespace App\Actions\Xero;

use App\Models\XeroAuthCredential;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use XeroAPI\XeroPHP\Api\IdentityApi;
use XeroAPI\XeroPHP\Configuration;

class CallbackAction
{
    public function execute()
    {
        ini_set('display_errors', 'On');

        // Storage Class uses sessions for storing token > extend to your DB of choice
//        $storage = new StorageClass();
        $storage = (new StorageAction());
        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => config('xero.xero_cred.client_id'),
            'clientSecret'            => config('xero.xero_cred.client_secret'),
            'redirectUri'             => route('xero.authorize.callback'),
            'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
            'urlAccessToken'          => 'https://identity.xero.com/connect/token',
            'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
        ]);

        // If we don't have an authorization code then get one
        if (!isset($_GET['code'])) {
            echo "Something went wrong, no authorization code found";
            exit("Something went wrong, no authorization code found");

            // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            echo "Invalid State";
            unset($_SESSION['oauth2state']);
            exit('Invalid state');
        } else {
            try {
                // Try to get an access token using the authorization code grant.
                $accessToken = $provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);


                $config = Configuration::getDefaultConfiguration()->setAccessToken( (string)$accessToken->getToken() );
                $identityApi = new IdentityApi(
                    new Client(),
                    $config
                );

                $result = $identityApi->getConnections();
                $store_auth_cred = XeroAuthCredential::where('id',1)->first();

                if(!$store_auth_cred){
                    $store_auth_cred = new XeroAuthCredential();
                    $store_auth_cred->access_token = $accessToken->getToken();
                    $store_auth_cred->expires = Carbon::parse($accessToken->getExpires())->toDateTime();
                    $store_auth_cred->tenant_id =  $result[0]->getTenantId();
                    $store_auth_cred->refresh_token =   $accessToken->getRefreshToken();
                    $store_auth_cred->id_token =   $accessToken->getValues()["id_token"];
                    $store_auth_cred->save();

                }else{
                    $store_auth_cred->access_token = $accessToken->getToken();
                    $store_auth_cred->expires = Carbon::parse($accessToken->getExpires())->toDateTime();
                    $store_auth_cred->tenant_id =  $result[0]->getTenantId();
                    $store_auth_cred->refresh_token =   $accessToken->getRefreshToken();
                    $store_auth_cred->id_token =   $accessToken->getValues()["id_token"];
                    $store_auth_cred->save();
                }
               if (Session::has('call') && Session::has('invoice_id') ){
                   return (new AuthorizationResourceAction())->execute();
               }
                return redirect()->route('dashboard')->with('success', 'Connected to Xero');
//                $storage->setToken(
//                    $accessToken->getToken(),
//                    $accessToken->getExpires(),
//                    $result[0]->getTenantId(),
//                    $accessToken->getRefreshToken(),
//                    $accessToken->getValues()["id_token"]
//                );



//                header('Location: ' . './authorizedResource.php');
//                header('Location: ' . route('authorization.resource'));
//                header('Location: ' . route('dashboard'));
                exit();


            } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                echo "Callback failed";
                exit();
            }
        }
    }

}
