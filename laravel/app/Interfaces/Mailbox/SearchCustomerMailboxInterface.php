<?php

namespace App\Interfaces\Mailbox;

interface SearchCustomerMailboxInterface
{
    public static function execute(array $data, $search,$orderBy,$count);

}
