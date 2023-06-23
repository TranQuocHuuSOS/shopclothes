<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

// Route::get('/', function () {
//     return view('master');
// });

Route::get('/',[PageController::class,'getIndex']);
Route::get('add-to-cart/{id}', [PageController::class, 'getAddToCart'])->name('themgiohang');
Route::get('del-cart/{id}', [PageController::class, 'getDelItemCart'])->name('xoagiohang');