<?php

namespace App\Actions\Ticket;

use App\Interfaces\Ticket\GetTicketInterface;
use App\Models\Ticket;

class TicketGetAction implements GetTicketInterface
{
    public static function execute($data)
    {
        $ticket = Ticket::with(['categories', 'companies'])->where('slug',$data['slug'])->first();
        return $ticket;

    }

}
