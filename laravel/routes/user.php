<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['web','auth'])->group(function (){
    Route::resource('user', UserController::class);

    Route::get('user/{search}/search', [UserController::class, 'search'])->name('user.search');
    Route::get('user/manage-actions/table', [UserController::class, 'manageAction'])->name('user.manage.action');//Manage action table in create modal
    Route::get('user/{designation}/filter', [UserController::class, 'filterByDesignation'])->name('user.filter.designation');
    Route::get('user/filter-by-name/{order}', [UserController::class, 'filterByName'])->name('user.filter.name');
    Route::get('user/delete/bulk', [UserController::class, 'deleteBulkUser'])->name('user.delete.bulk');
    //Register User

//    Route::post('request-sign-up', [UserController::class, 'requestSignUp'])->name('request.signUp')->middleware('honeypot');
//    Route::get('sign-up/mail-sent', [UserController::class, 'requestSignUpMailSent'])->name('request.signUp.mailSent');
});

Route::get('sign-up', [UserController::class, 'signUpForm'])->name('signup')->middleware('web');
