<?php

namespace App\Interfaces\Mailbox;

interface ListMailboxInterface
{
    public static function execute( array $data,$count,$orderBy,$companyId);

}
