<?php

namespace App\Actions\Ticket;

use App\Interfaces\Ticket\ReopenTicketInterface;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketReopenNotification;
use App\Notifications\TicketUpdateNotification;

class TicketReopenAction implements ReopenTicketInterface
{
    public static function execute($data){
        $item = Ticket::where('id', $data['id'])->first();
        $item->status = 'open';
        $item->save();
        $user=User::find($item->issuer_id);
        $user->notify(new TicketReopenNotification($item));
        return $item;
    }

}
