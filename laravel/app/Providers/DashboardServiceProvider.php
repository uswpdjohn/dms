<?php

namespace App\Providers;

use App\Actions\Dashboard\ChartAction;
use App\Interfaces\Dashboard\ChartInterface;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ChartInterface::class, ChartAction::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(base_path().'/routes/dashboard.php');
    }
}
