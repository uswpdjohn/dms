<?php

namespace App\Actions\Ticket;


use App\Interfaces\Ticket\ListTicketInterface;
use App\Models\Ticket;

class TicketListAction implements ListTicketInterface
{
    public static function execute($data,$count,$orderBy){
        $item = Ticket::with('categories')->where('company_id',\session()->get('auth_user_company')->id ?? '')->orderBy('id', $orderBy)->paginate($count);
        return $item;
    }
}
