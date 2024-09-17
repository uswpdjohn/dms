<?php

use App\Http\Controllers\CompanyManagementController;
use Illuminate\Support\Facades\Route;

Route::resource('company-management', CompanyManagementController::class);
Route::get('company-management/{id}/set-company', [CompanyManagementController::class, 'setCompany'])->name('company-management.set-company');
