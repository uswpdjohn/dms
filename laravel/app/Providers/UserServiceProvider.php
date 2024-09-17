<?php

namespace App\Providers;

use App\Actions\User\UserCreateAction;
use App\Actions\User\UserListAction;
use App\Actions\User\UserRequestSignUpAction;
use App\Actions\User\UserShowAction;
use App\Interfaces\User\GetUserInterface;
use App\Interfaces\User\ListUserInterface;
use App\Interfaces\User\RegisterUserInterface;
use App\Interfaces\User\StoreUserInterface;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ListUserInterface::class, UserListAction::class);
        $this->app->bind(StoreUserInterface::class, UserCreateAction::class);
        $this->app->bind(GetUserInterface::class, UserShowAction::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(base_path(). "/routes/user.php");
    }
}
