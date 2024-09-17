<?php

namespace App\Interfaces\Ticket;

interface ListAdminTicketInterface
{
    public static function execute(array $data,$orderBy,$count);

}
