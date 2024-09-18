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


//Notification
    Route::get('notification', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notification.index');
    Route::get('mark-as-read/{id}',[\App\Http\Controllers\NotificationController::class,'markAsRead'])->name('mark.as.read');
    Route::get('mark-as-unread/{id}',[\App\Http\Controllers\NotificationController::class,'markAsUnread'])->name('mark.as.unread');
    Route::get('delete-marked/{id}',[\App\Http\Controllers\NotificationController::class,'deleteMarked'])->name('delete.marked');
    Route::get('search-notification/{search}',[\App\Http\Controllers\NotificationController::class,'searchNotification'])->name('search.notification');


    Route::post('create-company-user', [CompanyController::class, 'companyUser'])->name('company.user');

});

require __DIR__.'/auth.php';
