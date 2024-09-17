<?php

namespace App\Actions\Ticket;


use App\Interfaces\Ticket\DeleteTicketInterface;
use App\Models\Ticket;


class TicketDestroyAction implements DeleteTicketInterface
{
    public static function execute($data){
        $item = Ticket::where('slug', $data['slug'])->first();
        return $item->delete();
    }
}
