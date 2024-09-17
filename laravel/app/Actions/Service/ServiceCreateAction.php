<?php

namespace App\Actions\Service;


use App\Models\Service;

class ServiceCreateAction
{
    public function execute($validatedData){
        $service = Service::create($validatedData);
        return $service;
    }
}
