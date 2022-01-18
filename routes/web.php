<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

//service
Route::get('/setting/service', [SettingController::class, 'serviceList'])->middleware(['auth'])->name('service');
Route::get('/setting/service/new', [SettingController::class, 'serviceAddForm'])->middleware(['auth'])->name('service-add');
Route::post('/setting/service/save', [SettingController::class, 'serviceSave'])->middleware(['auth']);
Route::get('/setting/service/{id}/edit', [SettingController::class, 'serviceEdit'])->middleware(['auth']);
Route::get('/setting/service/{id}/delete', [SettingController::class, 'serviceDelete'])->middleware(['auth']);

//category
Route::get('/setting/category', [SettingController::class, 'categoryList'])->middleware(['auth'])->name('category');
Route::get('/setting/category/new', [SettingController::class, 'categoryAddForm'])->middleware(['auth'])->name('category-add');
Route::post('/setting/category/save', [SettingController::class, 'categorySave'])->middleware(['auth']);
Route::get('/setting/category/{id}/edit', [SettingController::class, 'categoryEdit'])->middleware(['auth']);
Route::get('/setting/category/{id}/delete', [SettingController::class, 'categoryDelete'])->middleware(['auth']);

//priority
Route::get('/setting/priority', [SettingController::class, 'priorityList'])->middleware(['auth'])->name('priority');
Route::get('/setting/priority/new', [SettingController::class, 'priorityAddForm'])->middleware(['auth'])->name('priority-add');
Route::post('/setting/priority/save', [SettingController::class, 'prioritySave'])->middleware(['auth']);
Route::get('/setting/priority/{id}/edit', [SettingController::class, 'priorityEdit'])->middleware(['auth']);
Route::get('/setting/priority/{id}/delete', [SettingController::class, 'priorityDelete'])->middleware(['auth']);

//organization setting
Route::get('/setting/organization', [SettingController::class, 'organizationSetting'])->middleware(['auth'])->name('organization');
Route::post('/setting/organization/save', [SettingController::class, 'updateOrganization'])->middleware(['auth'])->name('organization.updateOrganization');

//user
Route::get('/user/{type}', [UserController::class, 'userList'])->middleware(['auth'])->name('user');
Route::get('/user/{type}/new', [UserController::class, 'userAddForm'])->middleware(['auth'])->name('user-add');
Route::post('/user/save', [UserController::class, 'userSave'])->middleware(['auth']);
Route::get('/user/{type}/{id}/edit', [UserController::class, 'userEdit'])->middleware(['auth']);
Route::get('/user/{type}/{id}/delete', [UserController::class, 'userDelete'])->middleware(['auth']);

//ticket
Route::get('/ticket/open', [TicketController::class, 'openTicketList'])->middleware(['auth'])->name('ticket');
Route::get('/ticket/re-open', [TicketController::class, 'reOpenTicketList'])->middleware(['auth'])->name('ticket.reopen');
Route::get('/ticket/close-solved', [TicketController::class, 'closeSolved'])->middleware(['auth'])->name('ticket.closeSolved');
Route::get('/ticket/close-unsolved', [TicketController::class, 'closeUnsolved'])->middleware(['auth'])->name('ticket.closeUnsolved');
Route::get('/ticket/new', [TicketController::class, 'addTicketForm'])->middleware(['auth'])->name('ticket.addTicketForm');
Route::post('/ticket/save', [TicketController::class, 'saveTicket'])->middleware(['auth'])->name('ticket.saveTicket');
Route::get('/ticket/{id}/changeStatus', [TicketController::class, 'changeStatus'])->middleware(['auth'])->name('ticket.changeStatus');
Route::get('/ticket/{id}/details', [TicketController::class, 'ticketDetails'])->middleware(['auth'])->name('ticket.ticketDetails');
Route::post('/ticket/replay/save', [TicketController::class, 'ticketReplaySave'])->middleware(['auth'])->name('ticket.ticketReplaySave');

Route::get('/unauthorized', function () {
    return view('unauthorized');
});


require __DIR__.'/auth.php';
