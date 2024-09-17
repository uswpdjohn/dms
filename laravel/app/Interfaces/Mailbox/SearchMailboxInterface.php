<?php

namespace App\Interfaces\Mailbox;

interface SearchMailboxInterface
{
    public static function execute(array $data,$search,$orderBy,$count);

}
