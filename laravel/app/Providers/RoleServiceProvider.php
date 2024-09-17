<?php

namespace App\Providers;

use App\Actions\Role\RoleCreateAction;
use App\Interfaces\Role\StoreRoleInterface;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StoreRoleInterface::class, RoleCreateAction::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
