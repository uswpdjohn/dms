<?php

namespace App\Providers;

use App\Actions\CompanyManagement\CompanyManagementCreateAction;
use App\Actions\CompanyManagement\CompanyManagementDestroyAction;
use App\Actions\CompanyManagement\CompanyManagementUpdateAction;
use App\Interfaces\Company\CompanyManagement\ListCompanyManagementInterface;
use App\Interfaces\CompanyManagement\DeleteCompanyManagementInterface;
use App\Interfaces\CompanyManagement\StoreCompanyManagementInterface;
use App\Interfaces\CompanyManagement\UpdateCompanyManagementInterface;
use Illuminate\Support\ServiceProvider;

class CompanyManagementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StoreCompanyManagementInterface::class, CompanyManagementCreateAction::class);
        $this->app->bind(UpdateCompanyManagementInterface::class, CompanyManagementUpdateAction::class);
        $this->app->bind(DeleteCompanyManagementInterface::class, CompanyManagementDestroyAction::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(base_path().'/routes/companyManagement.php');
    }
}
