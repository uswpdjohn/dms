<?php

namespace App\Actions\SignNow;

use SignNow\Api\Action\OAuth as SignNowOAuth;
use SignNow\Api\Entity\Auth\Token;
use SignNow\Api\Entity\Auth\TokenRequestAuthorizationCode;
use SignNow\Api\Service\Factories\TokenFactory;
use SignNow\Api\Service\Factory\EntityManagerFactory;
use SignNow\Rest\Http\Request;

class signNowOAuthAction
{
    public function execute()
    {
        $auth = new SignNowOAuth(config('signNow.api.host'));
        $entityManager = $auth->bearerByPassword(config('signNow.api.basic_token'), config('signNow.api.username'), config('signNow.api.password'));
        return $entityManager;
//
    }

}
