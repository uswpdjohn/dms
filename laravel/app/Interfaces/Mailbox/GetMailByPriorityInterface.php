<?php

namespace App\Interfaces\Mailbox;

interface GetMailByPriorityInterface
{
    public static function execute(array $data, $priority,$orderBy,$count);

}
