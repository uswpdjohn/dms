<?php

use App\Http\Controllers\SetupController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function (){
    Route::controller(SetupController::class)->prefix('setup')->name('setup.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('{setup_id}/change', 'update')->name('change');
        Route::put('category/update-recipient', 'updateRecipient')->name('updateRecipient');
        Route::get('{recipient_id}/remove-recipient', 'removeRecipient')->name('removeRecipient');
        //FAQ
        Route::get('faq', 'faq')->name('faq.index');
        Route::post('faq/store', 'faqStore')->name('faq.store');
        Route::get('faq/{faq_id}/show', 'faqShow')->name('faq.show');
        Route::put('faq/{faq_id}/update', 'faqUpdate')->name('faq.update');
        Route::delete('faq/{faq_id}/delete', 'faqDelete')->name('faq.delete');
    });
});

