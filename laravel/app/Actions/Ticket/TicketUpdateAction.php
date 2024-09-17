<?php

namespace App\Actions\Ticket;


use App\Interfaces\Ticket\UpdateTicketInterface;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketNotification;
use App\Notifications\TicketUpdateNotification;
use Illuminate\Support\Facades\Auth;

class TicketUpdateAction implements UpdateTicketInterface
{
    public static function execute($validatedData)
    {

        $item = Ticket::where('id', $validatedData['id'])->first();
        $item->status = 'closed';
        $item->reviewer_id = \auth()->guard('web')->user()->id;
        $item->update($validatedData);

        $user=User::find($item->issuer_id);
        $user->notify(new TicketUpdateNotification($item));
//        return $item;
        return $item;
    }

}
