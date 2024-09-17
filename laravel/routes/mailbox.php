<?php

use App\Http\Controllers\MailboxController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('mail/index', [MailboxController::class, 'adminIndex'])->name('mail.admin.index');
    Route::get('mail', [MailboxController::class, 'index'])->name('mail.index');                //customer
    Route::post('mail', [MailboxController::class, 'store'])->name('mail.store')->middleware('honeypot');
    Route::get('mail/delete', [MailboxController::class, 'delete'])->name('mail.delete'); //bulk delete
    Route::get('mail/delete-individual/{mail}', [MailboxController::class, 'deleteIndividual'])->name('mail.delete.individual'); //bulk delete
    Route::get('mail-download/attachment', [MailboxController::class, 'downloadAttachment'])->name('mail.downloadAttachment'); //bulk
    Route::get('individual/download/{id}', [MailboxController::class, 'individualDownload'])->name('mail.individual.download'); //individual
    Route::get('mail/mark-as-downloaded/{id}', [MailboxController::class, 'markAsDownloaded'])->name('mark.as.downloaded');
    Route::get('mail/get-mail-for-company/{id}', [MailboxController::class, 'getMail'])->name('mail.getMail');
    Route::get('mail/get-mail-by-priority/{priority}', [MailboxController::class, 'getMailByPriority'])->name('mail.priority');
    Route::get('mail/get-admin-mail-by-priority/{priority}', [MailboxController::class, 'getAdminMailByPriority'])->name('mail.admin.priority');
    Route::get('mail/get-mail-by-category/{category}', [MailboxController::class, 'getMailByCategory'])->name('mail.category');
    Route::get('mail/get-admin-mail-by-category/{category}', [MailboxController::class, 'getAdminMailByCategory'])->name('mail.admin.category');
    Route::get('mail/search-mail/{search}', [MailboxController::class, 'searchMail'])->name('mail.search');
    Route::get('mail/customer-search-mail/{search}', [MailboxController::class, 'customerSearchMail'])->name('customer.mail.search');

    Route::get('/get-directories/{company_id}/{category}', [MailboxController::class, 'getDirectories'])->name('mail.getDirectories');
    Route::get('/get-company-directories/{company_id}', [MailboxController::class, 'getCompanyDirectories'])->name('mail.getCompanyDirectories');
    Route::post('folder-rename', [MailboxController::class, 'renameFolder'])->name('rename.folder');
    Route::get('mail/{company_root_directory}/{category}/{directory}/delete-directory', [MailboxController::class, 'deleteDirectory'])->name('mail.delete.directory');
});
