<?php

namespace App\Interfaces\Ticket;

interface ListTicketInterface
{
    public static function execute(array $data,$count,$orderBy);

}
