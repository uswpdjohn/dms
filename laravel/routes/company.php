<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function (){
    Route::resource('company', CompanyController::class);
    Route::get('company/filter-by-name/{order}', [CompanyController::class, 'filterByName'])->name('company.filter.name');
    Route::get('company/search/{search}', [CompanyController::class, 'searchCompany'])->name('company.search');
//    Route::post('company/{id}/{company_id}/{user_type}/remove-user', [CompanyController::class, 'removeFromCompany'])->name('company.removeUser');
    Route::post('company/remove-user', [CompanyController::class, 'removeFromCompany'])->name('company.removeUser');
    Route::get('export-companies', [CompanyController::class, 'export'])->name('export.companies');
    Route::get('get-all-ssic', [CompanyController::class, 'getAllSsic'])->name('company.getSsic');
    Route::get('change-company-status/{company_id}', [CompanyController::class, 'changeStatus'])->name('company.changeStatus');
    Route::get('sort-company/{sortBy}/{currentDirection}', [CompanyController::class, 'sort'])->name('company.sort');

    Route::get('get-company-edit-shareholder/{slug}', [CompanyController::class, 'getShareholderForEdit'])->name('company.getShareholderForEdit');
    Route::get('get-company-edit-director/{slug}', [CompanyController::class, 'getDirectorForEdit'])->name('company.getDirectorForEdit');
    Route::get('make-directory', [CompanyController::class, 'makeDirectory'])->name('company.makeDirectory');
});

