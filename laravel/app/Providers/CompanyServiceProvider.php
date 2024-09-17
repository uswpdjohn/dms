<?php

namespace App\Providers;

use App\Actions\Company\CompanyCreateAction;
use App\Actions\Company\CompanyListAction;
use App\Actions\Company\CompanyShowAction;
use App\Actions\Company\CompanyUpdateAction;
use App\Actions\Company\RemoveUserFromCompanyAction;
use App\Interfaces\Company\ListCompanyInterface;
use App\Interfaces\Company\RemoveCompanyUserInterface;
use App\Interfaces\Company\ShowCompanyInterface;
use App\Interfaces\Company\StoreCompanyInterface;
use App\Interfaces\Company\UpdateCompanyInterface;
use App\Interfaces\CompanyManagement\UpdateCompanyManagementInterface;
use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ListCompanyInterface::class, CompanyListAction::class);
        $this->app->bind(RemoveCompanyUserInterface::class, RemoveUserFromCompanyAction::class);
        $this->app->bind(UpdateCompanyInterface::class, CompanyUpdateAction::class);
        $this->app->bind(StoreCompanyInterface::class, CompanyCreateAction::class);
        $this->app->bind(ShowCompanyInterface::class, CompanyShowAction::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(base_path().'/routes/company.php');
    }
}
