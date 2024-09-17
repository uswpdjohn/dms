<?php

namespace App\Interfaces\Company;

interface ListCompanyInterface
{
    public static function execute(array $data, $count, $orderBy);

}
