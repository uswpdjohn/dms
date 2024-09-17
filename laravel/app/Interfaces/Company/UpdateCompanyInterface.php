<?php

namespace App\Interfaces\Company;

interface UpdateCompanyInterface
{
    public static function execute(array $data,$slug);

}
