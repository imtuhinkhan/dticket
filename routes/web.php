<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
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

//category
Route::get('/category', [SettingController::class, 'categoryList'])->middleware(['auth'])->name('category');
Route::get('/category/new', [SettingController::class, 'categoryAddForm'])->middleware(['auth'])->name('category-add');
Route::post('/category/save', [SettingController::class, 'categorySave'])->middleware(['auth']);

Route::get('/ticket', function () {
    return view('ticket');
})->middleware(['auth'])->name('ticket');
require __DIR__.'/auth.php';
