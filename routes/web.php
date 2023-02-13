<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\BarcodeController;
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
    return view('welcome');
});


// Backend
Route::get('/adminlogin',[AdminController::class, 'index']);
Route::get('/dashboard',[AdminController::class, 'show_dashboard'])->name('homeadmin');
Route::get('/logout',[AdminController::class, 'logout'])->name('logoutdadmin');
Route::post('/admin-dashboard',[AdminController::class, 'dashboard'])->name('dashboardadmin');
// barcode
// Route::get('/add-dictionary()',[DictionaryController::class, 'create']);
// Route::get('/all-dictionary',[DictionaryController::class, 'all_dictionary']);
Route::resource('dictionary',DictionaryController::class);
Route::resource('barcode',BarcodeController::class);
Route::post('getdictionary',[BarcodeController::class,'getdictionary'])->name('getdictionary');
// in thông tin
Route::get('print-order/{checkout_code}',[BarcodeController::class,'print_order'])->name('print-order');