<?php


use App\Http\Controllers\DocumentManagementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::middleware(['web', 'auth'])->group(function () {
    Route::controller(DocumentManagementController::class)->group(function () {
        Route::get('document-management', 'index')->name('document-management.index');
        Route::get('fetch-document/{service_id}', 'documents')->name('document.fetch');
        Route::get('fetch-esop-document/{service_id}/{company_id}', 'esopDocuments')->name('esop.document.fetch');
        Route::get('upload-document', 'create')->name('document.create');
        Route::get('view/{document_id}', 'show')->name('document.show');
        Route::get('search/{service_id}/{search}', 'search')->name('document.search');
        Route::get('esop-search/{service_id}/{search}/{company_id}', 'esopSearch')->name('esopDocument.search'); //search+filter
        Route::get('esop-filter-by-company/{service_id}/{company_id}', 'esopFilterByCompany')->name('esopDocument.filter'); //filter
        Route::get('refresh/{document_id}/document-status', 'refresh')->name('document.refresh.status');

        Route::post('upload-document', 'uploadDocument')->name('upload.document');
        Route::get('document/edit/{document_id}', 'edit')->name('document.edit'); //fetch data in edit
        Route::post('edit-document', 'editDocument')->name('edit.document'); //edit submit
        Route::get('delete-document/{document_id}', 'deleteDocument')->name('delete.document'); //delete from signNow
        Route::delete('del-doc/{document_id}/delete', 'del')->name('document.del'); //delete from internal DB
        Route::delete('esop-del-doc/{document_id}/delete', 'esopDel')->name('esop.document.del'); //delete from internal DB //for ESOP document only from ESOP module
        Route::get('invite-to-sign/{document_id}', 'inviteToSign')->name('invite.sign');
        Route::post('invite/{document_id}', 'invite')->name('invite');
        Route::get('cancel-invite/{document_id}', 'cancelInvite')->name('cancel.invite');
        Route::get('customer/document-management/{service_id}', 'customerView')->name('documentManagement.customer');
        Route::get('download-document', 'downloadDocument')->name('download.document');
        Route::get('download-document/individual/{document_id}', 'individualDownloadDocument')->name('download.individual.document'); //signNow doc download
        Route::get('download-local-document/individual/{document_id}', 'downloadLocalDocument')->name('download.local.document'); //for local files
        Route::get('fetchSigners/{company_id}', 'getShareholdersAndDirectors')->name('fetch'); //fetching the company users when user select company
        //NEW
        Route::get('{document_id}/generate-temp-url', 'generateTempUrl')->name('generate.temp.url');

    });

});
Route::get('local/temp/{path}', [DocumentManagementController::class, 'downloadFromTempUrl'])
    ->middleware('signed')
    ->name('local.temp');
