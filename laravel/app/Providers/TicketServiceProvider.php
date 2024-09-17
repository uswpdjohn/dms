<?php

namespace App\Providers;

use App\Actions\Ticket\TicketAdminListAction;
use App\Actions\Ticket\TicketCreateAction;
use App\Actions\Ticket\TicketDestroyAction;
use App\Actions\Ticket\TicketDownloadAction;
use App\Actions\Ticket\TicketGetAction;
use App\Actions\Ticket\TicketListAction;
use App\Actions\Ticket\TicketReopenAction;
use App\Actions\Ticket\TicketShowAction;
use App\Actions\Ticket\TicketUpdateAction;
use App\Interfaces\Ticket\DeleteTicketInterface;
use App\Interfaces\Ticket\DownloadTicketInterface;
use App\Interfaces\Ticket\GetTicketInterface;
use App\Interfaces\Ticket\ListAdminTicketInterface;
use App\Interfaces\Ticket\ListTicketInterface;
use App\Interfaces\Ticket\ReopenTicketInterface;
use App\Interfaces\Ticket\ShowTicketInterface;
use App\Interfaces\Ticket\StoreTicketInterface;
use App\Interfaces\Ticket\UpdateTicketInterface;
use Illuminate\Support\ServiceProvider;

class TicketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ListAdminTicketInterface::class, TicketAdminListAction::class);
        $this->app->bind(GetTicketInterface::class, TicketGetAction::class);
        $this->app->bind(StoreTicketInterface::class, TicketCreateAction::class);
        $this->app->bind(ShowTicketInterface::class, TicketShowAction::class);
        $this->app->bind(ReopenTicketInterface::class, TicketReopenAction::class);
        $this->app->bind(UpdateTicketInterface::class, TicketUpdateAction::class);
        $this->app->bind(DeleteTicketInterface::class, TicketDestroyAction::class);
        $this->app->bind(DownloadTicketInterface::class, TicketDownloadAction::class);
        $this->app->bind(ListTicketInterface::class, TicketListAction::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(base_path().'/routes/ticket.php');
    }
}
