<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web','auth'])->group(function (){
    Route::resource('ticket', TicketController::class)->middleware('honeypot');
    Route::get('support-ticket', [TicketController::class, 'adminIndex'])->name('admin.support.ticket');
    Route::get('ticket/{id}/download', [TicketController::class, 'downloadTicket'])->name('ticket.download');
    Route::put('support-ticket/reopen/{id}', [TicketController::class, 'reopen'])->name('support.ticket.reopen');

    Route::post('ticket/store-from-faq', [TicketController::class, 'storeFromFaq'])->name('ticket.from.faq');
});

