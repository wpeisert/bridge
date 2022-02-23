<?php

use App\Http\Controllers\BiddingController;
use App\Http\Controllers\BiddingsController;
use App\Http\Controllers\DealController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/biddings', BiddingsController::class)->middleware(['auth', 'verified'])->name('biddings');
Route::get('/bidding/{bidding}', [BiddingController::class, 'show'])->middleware(['auth', 'verified'])->name('bidding');

Route::resource('deals', DealController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
