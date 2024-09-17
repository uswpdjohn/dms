<?php

namespace App\Actions\Hitpay;

//use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class Hitpay
{
    private function buildURL($endpoint, $queryParam=null)
    {
        $url=config('hitpay.host') . '/' . config('hitpay.version') . '/' . $endpoint;
        if($queryParam != null){
            $url=$url.'?'.Arr::query($queryParam);
        }
        return $url;
    }

    private function validateData($data)
    {
        if(!array_key_exists('amount', $data)){
            throw new \Error('Amount key is not exist in data array');
        }
        if(!is_numeric($data['amount'])){
            throw new \Error('Amount value is not numeric');
        }
        if(!array_key_exists('currency', $data)){
            throw new \Error('Currency key is not exist in data array');
        }
        if(!$data['currency']=='SGD'){
            throw new \Error("Currency value is not valid. Try 'SGD'");
        }
        if(!array_key_exists('redirect_url', $data)){
            throw new \Error('Redirect URL key is not exist in data array');
        }
        if(!array_key_exists('reference_number', $data)){
            throw new \Error('Reference Number is not exist in data array');
        }

        return $data;

    }

    private function callingApi($url, $method = "GET", $requestBody = [], $content_type = 'application/x-www-form-urlencoded')
    {
//        dd($url.Arr::query($requestBody));
        try {
            logger('url: ' . $url.Arr::query($requestBody));
            logger('method: ' . $method);
            logger('$requestBody');
            logger($requestBody);

            $headers = [
                'X-Requested-With' => 'XMLHttpRequest',
                'X-BUSINESS-API-KEY' => config('hitpay.client_key'),
                'Content-Type' => $content_type
            ];
            $client = Http::withHeaders($headers);


            if ($method == 'GET') {
                $response = $client->get($url);
            } else {
                $response = $client->asForm()->post($url, $requestBody);
//                dd($response);
            }

            logger('response:');
            logger($response->getBody());
            $responseBody = $response->getBody();
            logger(gettype($responseBody));
//            logger($responseBody->data);
//            if (array_key_exists('data', $responseBody)) {
//                $decodeResponseData = json_decode(json_encode($responseBody->data[0]), true);
//                if (array_key_exists('output', $decodeResponseData)) {
//                    logger('$decodeResponseData[output]');
//                    logger($decodeResponseData['output']);
//                    return $decodeResponseData['output'];
//                }
//                logger('$decodeResponseData');
//                logger($decodeResponseData);
//                return $decodeResponseData;
//
//            }
            return $responseBody;

        }
//        catch(ClientException $e){
//            logger('ClientException $e->getMessage()');
//            logger($e);
//            return $e->getResponse()->getBody();
//        }
//        catch (Exception $e) {
//
//            // If there are network errors, we need to ensure the application doesn't crash.
//            // if $e->hasResponse is not null we can attempt to get the message
//            // Otherwise, we'll just pass a network unavailable message.
//            if ($e->hasResponse()) {
//                $exception = (string) $e->getResponse()->getBody();
//                $exception = json_decode($exception);
//                return $exception;
////                throw new NotFoundHttpException($exception['message']);
////                return new JsonResponse($exception, $e->getCode());
//            } else {
////                return new JsonResponse($e->getMessage(), 503);
//            }
//
//        }
        catch (\Exception $e) {
            // echo '<pre>';
            // print_r($e);
            // echo '</pre>';
            // die();
            logger('Exception $e');
            logger($e);
            // $d = json_decode($e->getResponse()->getBody(), true);
            throw new \Error($e);
            // throw new \Error($d['message']);
        }
    }

    public function paymentRequest($data)
    {
        try {
            return $this->callingApi(
                $this->buildURL(config('hitpay.api.payment_request')),
                "POST", $this->validateData($data)
            );
        }
        catch(\Exception $e){
            throw new \Error($e);
        }
    }
    public function makePayment($referenceId){
        return $this->callingApi(
            $this->buildURL(config('hitpay.api.payment_request').'/'. $referenceId)
        );
    }

}
