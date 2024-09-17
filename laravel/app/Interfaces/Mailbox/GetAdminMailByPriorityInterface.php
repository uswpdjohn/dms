<?php

namespace App\Interfaces\Mailbox;

interface GetAdminMailByPriorityInterface
{
    public static function execute(array $data,$priority,$orderBy,$count);

}
