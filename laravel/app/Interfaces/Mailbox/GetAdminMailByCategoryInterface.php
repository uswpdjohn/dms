<?php

namespace App\Interfaces\Mailbox;

interface GetAdminMailByCategoryInterface
{
    public static function execute(array $data,$category, $orderBy, $count);
}
