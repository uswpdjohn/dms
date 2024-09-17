<?php

namespace App\Actions\Ticket;

use App\Interfaces\Ticket\ListAdminTicketInterface;
use App\Models\Ticket;

class TicketAdminListAction implements ListAdminTicketInterface
{
    public static function execute($data,$orderBy,$count){
        $item = Ticket::with('categories', 'companies')
            ->whereHas('categories')->whereHas('companies')
            ->orderBy('status', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->paginate($count);

        return $item;
    }

}
