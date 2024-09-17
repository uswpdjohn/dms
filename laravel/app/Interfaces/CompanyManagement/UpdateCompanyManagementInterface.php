<?php

namespace App\Interfaces\CompanyManagement;

interface UpdateCompanyManagementInterface
{
    public static function execute(array $data, $slug);
}
