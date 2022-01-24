<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstalltionController;
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

Route::get('/install', [InstalltionController::class, 'index']);
Route::get('/installation/step1', [InstalltionController::class, 'step1']);
Route::post('/installtion/db-connect', [InstalltionController::class, 'dbConnect'])->name('install.db');
Route::get('/installtion/import-sql', [InstalltionController::class, 'importSql'])->name('install.import');
Route::get('/installtion/upload-sql', [InstalltionController::class, 'uploadSql'])->name('install.upload');
Route::get('/installtion/basic-setting', [InstalltionController::class, 'basicSetting'])->name('install.basicSetting');

