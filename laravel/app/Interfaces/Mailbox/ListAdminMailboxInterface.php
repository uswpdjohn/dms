<?php

namespace App\Interfaces\Mailbox;

interface ListAdminMailboxInterface
{
    public static function execute( array $data,$count,$orderBy);

}
