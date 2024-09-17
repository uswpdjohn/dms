<?php

namespace App\Actions\Ticket;

use App\Interfaces\Ticket\DownloadTicketInterface;
use App\Models\Ticket;

class TicketDownloadAction implements DownloadTicketInterface
{
    public static function execute($data){
        $ticket=Ticket::where('id', $data['id'])->first();
        $pathToFile = storage_path('app/public/ticket/' . $ticket->file);
        return $pathToFile;
    }

}
