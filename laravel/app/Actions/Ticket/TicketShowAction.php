<?php

namespace App\Actions\Ticket;


use App\Interfaces\Ticket\ShowTicketInterface;
use App\Models\Ticket;


class TicketShowAction implements ShowTicketInterface
{
    public static function execute($data){
        $item = Ticket::where('slug', $data['slug'])->first();
        return $item;
    }
}
