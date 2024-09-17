<?php

namespace App\Providers;

use App\Actions\Mailbox\MailboxCreateAction;
use App\Actions\Mailbox\MailboxCustomerSearchAction;
use App\Actions\Mailbox\MailboxDestroyAction;
use App\Actions\Mailbox\MailboxGeAdminMailByPriorityAction;
use App\Actions\Mailbox\MailboxGetAdminMailByCategory;
use App\Actions\Mailbox\MailboxGetMailByCategory;
use App\Actions\Mailbox\MailboxGetMailByPriorityAction;
use App\Actions\Mailbox\MailboxIndividualDeleteAction;
use App\Actions\Mailbox\MailboxListAction;
use App\Actions\Mailbox\MailboxListActionAdmin;
use App\Actions\Mailbox\MailboxSearchAction;
use App\Interfaces\Mailbox\DeleteBulkMailboxInterface;
use App\Interfaces\Mailbox\DeleteIndividualMailboxInterface;
use App\Interfaces\Mailbox\GetAdminMailByCategoryInterface;
use App\Interfaces\Mailbox\GetAdminMailByPriorityInterface;
use App\Interfaces\Mailbox\GetMailByCategoryInterface;
use App\Interfaces\Mailbox\GetMailByPriorityInterface;
use App\Interfaces\Mailbox\ListAdminMailboxInterface;
use App\Interfaces\Mailbox\ListMailboxInterface;
use App\Interfaces\Mailbox\SearchCustomerMailboxInterface;
use App\Interfaces\Mailbox\SearchMailboxInterface;
use App\Interfaces\Mailbox\StoreMailboxInterface;
use Illuminate\Support\ServiceProvider;

class MailboxServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ListMailboxInterface::class, MailboxListAction::class);
        $this->app->bind(ListAdminMailboxInterface::class, MailboxListActionAdmin::class);
        $this->app->bind(StoreMailboxInterface::class, MailboxCreateAction::class);
        $this->app->bind(DeleteBulkMailboxInterface::class, MailboxDestroyAction::class);
        $this->app->bind(DeleteIndividualMailboxInterface::class, MailboxIndividualDeleteAction::class);
        $this->app->bind(GetMailByPriorityInterface::class, MailboxGetMailByPriorityAction::class);
        $this->app->bind(GetAdminMailByPriorityInterface::class, MailboxGeAdminMailByPriorityAction::class);
        $this->app->bind(GetMailByCategoryInterface::class, MailboxGetMailByCategory::class);
        $this->app->bind(GetAdminMailByCategoryInterface::class, MailboxGetAdminMailByCategory::class);
        $this->app->bind(SearchMailboxInterface::class, MailboxSearchAction::class);
        $this->app->bind(SearchCustomerMailboxInterface::class, MailboxCustomerSearchAction::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(base_path(). '/routes/mailbox.php');
    }
}
