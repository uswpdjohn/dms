<?php

use App\Http\Controllers\BusinessSettingController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('sign-up', [UserController::class, 'signUpForm'])->name('signup');
Route::post('request-sign-up', [UserController::class, 'requestSignUp'])->name('request.signUp')->middleware('honeypot');
Route::get('sign-up/mail-sent', [UserController::class, 'requestSignUpMailSent'])->name('request.signUp.mailSent');

Route::get('set-password/{token}',[UserController::class,'showSetPasswordForm'])->name('set.password');
Route::post('update-password', [UserController::class,'updatePassword'])->name('update.password');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Business Setting
Route::get('/privacy-policy',[BusinessSettingController::class,  'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-of-use',[BusinessSettingController::class,  'termsOfUse'])->name('terms.use');

//Route::middleware('honeypot')->group(function() {
//    Auth::routes(['verify' => true]);
//});

////Set password

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('get-tickets/{ticketCount}/{orderBy}', 'getTickets');
        Route::get('get-chart-data', 'getPieChartData');
        Route::get('send-payment-reminder', 'sendPaymentReminder')->name('send.payment.reminder');
    });
//Role
//    Route::resource('role', RoleController::class);

//Ticket
    Route::resource('ticket', TicketController::class)->middleware('honeypot');
    Route::get('support-ticket', [TicketController::class, 'adminIndex'])->name('admin.support.ticket');
    Route::get('ticket/{id}/download', [TicketController::class, 'downloadTicket'])->name('ticket.download');
    Route::put('support-ticket/reopen/{id}', [TicketController::class, 'reopen'])->name('support.ticket.reopen');

    Route::post('ticket/store-from-faq', [TicketController::class, 'storeFromFaq'])->name('ticket.from.faq');



//Dashboard
//    Route::controller(DashboardController::class)->group(function () {
//        Route::get('dashboard', 'dashboard')->name('dashboard');
//        Route::get('get-tickets/{ticketCount}/{orderBy}', 'getTickets');
//        Route::get('get-chart-data', 'getPieChartData');
//        Route::get('send-payment-reminder', 'sendPaymentReminder')->name('send.payment.reminder');
//    });
//Notification
    Route::get('notification', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notification.index');
    Route::get('mark-as-read/{id}',[\App\Http\Controllers\NotificationController::class,'markAsRead'])->name('mark.as.read');
    Route::get('mark-as-unread/{id}',[\App\Http\Controllers\NotificationController::class,'markAsUnread'])->name('mark.as.unread');
    Route::get('delete-marked/{id}',[\App\Http\Controllers\NotificationController::class,'deleteMarked'])->name('delete.marked');
    Route::get('search-notification/{search}',[\App\Http\Controllers\NotificationController::class,'searchNotification'])->name('search.notification');
//Mailbox
//    Route::get('mail/index', [MailboxController::class, 'adminIndex'])->name('mail.admin.index');
//    Route::get('mail', [MailboxController::class, 'index'])->name('mail.index');                //customer
//    Route::post('mail', [MailboxController::class, 'store'])->name('mail.store')->middleware('honeypot');
//    Route::get('mail/delete', [MailboxController::class, 'delete'])->name('mail.delete'); //bulk delete
//    Route::get('mail/delete-individual/{mail}', [MailboxController::class, 'deleteIndividual'])->name('mail.delete.individual'); //bulk delete
//    Route::get('mail-download/attachment', [MailboxController::class,'downloadAttachment'])->name('mail.downloadAttachment'); //bulk
//    Route::get('individual/download/{id}', [MailboxController::class,'individualDownload'])->name('mail.individual.download'); //individual
//    Route::get('mail/mark-as-downloaded/{id}', [MailboxController::class,'markAsDownloaded'])->name('mark.as.downloaded');
//    Route::get('mail/get-mail-for-company/{id}', [MailboxController::class, 'getMail'])->name('mail.getMail');
//    Route::get('mail/get-mail-by-priority/{priority}', [MailboxController::class, 'getMailByPriority'])->name('mail.priority');
//    Route::get('mail/get-admin-mail-by-priority/{priority}', [MailboxController::class, 'getAdminMailByPriority'])->name('mail.admin.priority');
//    Route::get('mail/get-mail-by-category/{category}', [MailboxController::class, 'getMailByCategory'])->name('mail.category');
//    Route::get('mail/get-admin-mail-by-category/{category}', [MailboxController::class, 'getAdminMailByCategory'])->name('mail.admin.category');
//    Route::get('mail/search-mail/{search}', [MailboxController::class, 'searchMail'])->name('mail.search');
//    Route::get('mail/customer-search-mail/{search}', [MailboxController::class, 'customerSearchMail'])->name('customer.mail.search');

    //start change request JULY 2024
//    Route::get('/get-directories/{company_id}/{category}', [MailboxController::class, 'getDirectories'])->name('mail.getDirectories');
//    Route::get('/get-company-directories/{company_id}', [MailboxController::class, 'getCompanyDirectories'])->name('mail.getCompanyDirectories');
//    Route::post('folder-rename', [MailboxController::class, 'renameFolder'])->name('rename.folder');
//    Route::get('mail/{company_root_directory}/{category}/{directory}/delete-directory', [MailboxController::class, 'deleteDirectory'])->name('mail.delete.directory');
//    end change request JULY 2024

//Company Management
//    Route::get('company-management/{id}/set-company', [CompanyManagementController::class, 'setCompany'])->name('company-management.set-company');
//    Route::resource('company-management', CompanyManagementController::class);
//Company
//    Route::resource('company', CompanyController::class);
//    Route::get('company/filter-by-name/{order}', [CompanyController::class, 'filterByName'])->name('company.filter.name');
//    Route::get('company/search/{search}', [CompanyController::class, 'searchCompany'])->name('company.search');
////    Route::post('company/{id}/{company_id}/{user_type}/remove-user', [CompanyController::class, 'removeFromCompany'])->name('company.removeUser');
//    Route::post('company/remove-user', [CompanyController::class, 'removeFromCompany'])->name('company.removeUser');
//    Route::get('export-companies', [CompanyController::class, 'export'])->name('export.companies');
//    Route::get('get-all-ssic', [CompanyController::class, 'getAllSsic'])->name('company.getSsic');
//    Route::get('change-company-status/{company_id}', [CompanyController::class, 'changeStatus'])->name('company.changeStatus');
//    Route::get('sort-company/{sortBy}/{currentDirection}', [CompanyController::class, 'sort'])->name('company.sort');
//
//    Route::get('get-company-edit-shareholder/{slug}', [CompanyController::class, 'getShareholderForEdit'])->name('company.getShareholderForEdit');
//    Route::get('get-company-edit-director/{slug}', [CompanyController::class, 'getDirectorForEdit'])->name('company.getDirectorForEdit');
    /**
     *Create directories for all existing company
     */
//    Route::get('make-directory', [CompanyController::class, 'makeDirectory'])->name('company.makeDirectory');




    Route::post('create-company-user', [CompanyController::class, 'companyUser'])->name('company.user');
//    Route::post('update-user/{slug}', [UserController::class, 'update'])->name('update');
//    Route::post('admin/user',[UserController::class, 'adminUserStore'])->name('admin.user.store');


    //Document Management

//    Route::controller(DocumentManagementController::class)->group(function (){
//        Route::get('document-management', 'index')->name('document-management.index');
//        Route::get('fetch-document/{service_id}', 'documents')->name('document.fetch');
//        Route::get('fetch-esop-document/{service_id}/{company_id}', 'esopDocuments')->name('esop.document.fetch');
//        Route::get('upload-document', 'create')->name('document.create');
//        Route::get('view/{document_id}', 'show')->name('document.show');
//        Route::get('search/{service_id}/{search}', 'search')->name('document.search');
//        Route::get('esop-search/{service_id}/{search}/{company_id}', 'esopSearch')->name('esopDocument.search'); //search+filter
//        Route::get('esop-filter-by-company/{service_id}/{company_id}', 'esopFilterByCompany')->name('esopDocument.filter'); //filter
//        Route::get('refresh/{document_id}/document-status', 'refresh')->name('document.refresh.status');
//
//        Route::post('upload-document', 'uploadDocument')->name('upload.document');
//        Route::get('document/edit/{document_id}', 'edit')->name('document.edit'); //fetch data in edit
//        Route::post('edit-document', 'editDocument')->name('edit.document'); //edit submit
//        Route::get('delete-document/{document_id}', 'deleteDocument')->name('delete.document'); //delete from signNow
//        Route::delete('del-doc/{document_id}/delete', 'del')->name('document.del'); //delete from internal DB
//        Route::delete('esop-del-doc/{document_id}/delete', 'esopDel')->name('esop.document.del'); //delete from internal DB //for ESOP document only from ESOP module
//        Route::get('invite-to-sign/{document_id}', 'inviteToSign')->name('invite.sign');
//        Route::post('invite/{document_id}','invite')->name('invite');
//        Route::get('cancel-invite/{document_id}','cancelInvite')->name('cancel.invite');
//        Route::get('customer/document-management/{service_id}','customerView')->name('documentManagement.customer');
//        Route::get('download-document','downloadDocument')->name('download.document');
//        Route::get('download-document/individual/{document_id}','individualDownloadDocument')->name('download.individual.document');
//        Route::get('fetchSigners/{company_id}', 'getShareholdersAndDirectors')->name('fetch'); //fetching the company users when user select company
//    });

    //setup transferred  to single route file
//    Route::controller(SetupController::class)->prefix('setup')->name('setup.')->group(function (){
//        Route::get('/', 'index')->name('index');
//        Route::put('{setup_id}/change', 'update')->name('change');
//        Route::put('category/update-recipient', 'updateRecipient')->name('updateRecipient');
//        Route::get('{recipient_id}/remove-recipient', 'removeRecipient')->name('removeRecipient');
//        //FAQ
//        Route::get('faq', 'faq')->name('faq.index');
//        Route::post('faq/store', 'faqStore')->name('faq.store');
//        Route::get('faq/{faq_id}/show', 'faqShow')->name('faq.show');
//        Route::put('faq/{faq_id}/update', 'faqUpdate')->name('faq.update');
//        Route::delete('faq/{faq_id}/delete', 'faqDelete')->name('faq.delete');
//
//    });
    //customer support
//    Route::controller(CustomerSupportController::class)->prefix('customer-support')->name('customer-support.')->group(function (){
//        Route::get('/', 'index')->name('index');
//        Route::get('/{slug}', 'show')->name('show');
//    });
    //CAP table
//    Route::controller(CapTableController::class)->prefix('cap-table')->name('cap-table.')->group(function () {
//        Route::get('/', 'index')->name('index');
//        Route::get('/{companyId}/set-company', 'setCompany')->name('set-company');
//    });

    // Cap table overview
//    Route::resource('cap-table-overview', CapTableOverviewController::class);
//
//    //CAP table Activity Entry
//    Route::resource('cap-table-activity-entry', CapTableActivityEntryController::class);
//    Route::get('/cap-table-activity-entry-search/{search}', [CapTableActivityEntryController::class, 'search'])->name('activity_entry.search');

    //Cap Table Company Member
//    Route::post('/create-company-members', [CapTableMembersController::class, 'store'])->name('capTable.member.store');
    /**
     * Create Esop Reserve member for all existing company
     *Run this method will create the Esop Reserve member
     */
//    Route::get('update-company-members', [CompanyController::class, 'createEntries'])->name('memberEntries.forCompany');
//
//    //Cap Table Members
//    Route::get('/cap-table-members', [CapTableMembersController::class, 'membersIndex'])->name('capTableMembers.index');
//    Route::get('/cap-table-members-search/{search}', [CapTableMembersController::class, 'search'])->name('members.search');
//    Route::get('/cap-table-members-as-on-filter/{asOn}', [CapTableMembersController::class, 'asOn'])->name('members.asOn');


    //Cap Table Share Certificate
//    Route::resource('share-certificate', CapTableShareCertificateController::class);
//    Route::get('get-share-certificate-id', [CapTableShareCertificateController::class, 'getUniqueShareCertificateId'])->name('get.shareCertificateId');
//    Route::get('get-share-certificate-id-edit', [CapTableShareCertificateController::class, 'getUniqueShareCertificateIdEdit'])->name('get.shareCertificateIdEdit');
//    Route::get('get-company_details-for-share-certificate', [CapTableShareCertificateController::class, 'getCompanyDetails'])->name('get.CompanyDetails');
//    Route::get('get-company_members', [CapTableShareCertificateController::class, 'getCompanyMembers'])->name('get.CompanyMembers');
//    Route::get('cer-refresh/{document_id}/document-status', [CapTableShareCertificateController::class,'cerRefresh'])->name('document.cerRefresh.status');

    /*This route is not using for downloading share certificate right now*/
//    Route::get('download-share_certificate/individual/{document_id}',[CapTableShareCertificateController::class,'shareCertificateDownload'])->name('download.shareCertificate');

//    Route::get('download-share_certificate/{document_id}',[CapTableShareCertificateController::class,'downloadShareCertificate'])->name('shareCertificate.download');
//    Route::get('share-certificate-send-invite/{document_id}',[CapTableShareCertificateController::class, 'sendInvite'])->name('shareCertificate.invite');

    //ESOP Entries
    // Route::resource('esopEntry', ESOPEntryController::class);
//    Route::post('/create-members', [ESOPEntryController::class, 'createMember'])->name('esopEntry.member.store');


    // ESOP
//    Route::get('/esop/overview/{asOn}', [ESOPController::class, 'asOn'])->name('esop.overview.asOn');
//    Route::prefix('esop')->name('esop.')->group(function (){
//        Route::get('overview/graph', [ESOPOverviewController::class, 'graph'])->name('overview.graph');
//        Route::resource('overview', ESOPOverviewController::class);
//        Route::get('/{companyId}/set-esop-company', [ESOPController::class, 'setEsopCompany'])->name('set-company-esop');
//    });
//    Route::resource('esop', ESOPController::class);

//    Route::controller(ESOPEntryController::class)->prefix('esop-entry')->group(function (){
//        Route::get('/', 'index')->name('esop-entry.index');
//        Route::post('/create-entry', 'store')->name('esop-entry.store');
//        Route::get('/edit-entry/{id}', 'edit')->name('esop-entry.edit');
//        Route::get('/{id}/show-entry', 'show')->name('esop-entry.show');
//        Route::put('/update-entry/{id}', 'update')->name('esop-entry.update');
//        Route::delete('/{id}/delete-entry', 'delete')->name('esop-entry.delete');
//        Route::post('/create-members', [ESOPEntryController::class, 'createMember'])->name('esop-entry.member.store');
//
//    });

});


//Route::middleware('auth')->group(function () {
//    //billing
//    Route::controller(InvoiceController::class)->prefix('billing')->group(function (){
//        Route::get('/', 'index')->name('billing.index');
//        Route::post('/create-invoice', 'store')->name('billing.store');
//        Route::get('/edit-invoice/{id}', 'edit')->name('billing.edit');
//        Route::put('/update-invoice/{id}', 'update')->name('billing.update');
//        Route::get('/view-invoice/{id}', 'show')->name('billing.show');
//        Route::get('/download-invoice-pdf/{id}', 'pdf')->name('invoice.pdf');
//
//        //Hitpay
//        Route::post('/hitpay-payment', 'hitpayPayment')->name('hitpay.payment');
//        Route::get('/hitpay-payment-success/{reference_number}', 'hitpayPaymentSuccess')->name('hitpay.payment.success');
//    });
//    Route::get('/get-company-directors/{company_id}', [InvoiceController::class, 'getCompanyDirectors'])->name('company.directors');
//    Route::get('/get-company-details/{company_id}', [InvoiceController::class, 'getCompanyDetails'])->name('company.details');
//    Route::get('/get-directors-email/{user_id}', [InvoiceController::class, 'getDirectorsEmail'])->name('directors.email');
//    Route::get('/search-invoice/{search}', [InvoiceController::class, 'search'])->name('invoice.search');
//    Route::get('/filter-invoice-by-order/{order}', [InvoiceController::class, 'filterByInvoiceNo'])->name('invoice.filter');
//    Route::get('/filter-invoice-by-status/{status}', [InvoiceController::class, 'filterByStatus'])->name('invoice.filter.status');
//    Route::get('/void-invoice/{id}', [InvoiceController::class, 'voidInvoice'])->name('void.invoice');
////Route::get('billing/download-invoice-pdf/{id}', [InvoiceController::class,'pdf'])->name('invoice.pdf');
//    Route::get('company-management/{id}/set-company', [CompanyManagementController::class, 'setCompany'])->name('company-management.set-company');
//
//    Route::get('/message', [CompanyController::class, 'userWithNoCompany'])->name('companies.empty');
//    Route::get('/failed-to-change-status-in-xero', [InvoiceController::class, 'customerMessage'])->name('customer.message');
//
//    //Xero Route
//    Route::get('/authorize', [XeroController::class, 'index'])->name('authorize');
//    Route::get('/xero-authorize-callback', [XeroController::class, 'callback'])->name('xero.authorize.callback');
//    Route::get('/authorize-resource', [XeroController::class, 'authResource'])->name('authorization.resource');
//    Route::get('/disconnect-from-xero', [XeroController::class, 'disconnect'])->name('xero.disconnect');
//    Route::get('/get-connected-xero-organization', [XeroController::class, 'getConnection'])->name('get.connection');
//    //if authorize route says 403 then change 127.0.0.1 to localhost in redirect_uri [FOR localhost ONLY]
//
//    //Settings
//    Route::controller(SettingsController::class)->prefix('settings')->name('settings.')->group(function (){
//        Route::get('update', 'edit')->name('edit');
//        Route::put('update/{slug}', 'update')->name('update');
//    });
//});

require __DIR__.'/auth.php';
