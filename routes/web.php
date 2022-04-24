<?php

use App\Http\Controllers\BiddingController;
use App\Http\Controllers\MyBiddingsController;
use App\Http\Controllers\DealConstraintController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TrainingController;
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

Route::get('dashboard', [MyBiddingsController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('bidding/create', [MyBiddingsController::class, 'create'])->middleware(['auth', 'verified'])->name('mybidding.create');
Route::get('bidding/next/{bidding}', [MyBiddingsController::class, 'next'])->middleware(['auth', 'verified'])->name('mybidding.next');
Route::get('bidding/nextbid/{bidding?}', [MyBiddingsController::class, 'next'])->middleware(['auth', 'verified'])->name('mybidding.nextbid');
Route::get('bidding/{bidding}', [MyBiddingsController::class, 'bidding'])->middleware(['auth', 'verified'])->name('mybidding');

Route::resource('biddings', BiddingController::class)->middleware(['auth', 'verified']);
Route::put('biddings/{bidding}/place-bid', [BiddingController::class, 'placeBid'])->middleware(['auth', 'verified'])->name('biddings.place-bid');

Route::resource('deals', DealController::class)->middleware(['auth', 'verified']);

Route::resource('quizzes', QuizController::class)->middleware(['auth', 'verified']);
Route::get('quizzes/{quiz}/generate-deals', [QuizController::class, 'generateDeals'])->middleware(['auth', 'verified'])->name('quizzes.generate-deals');

Route::resource('trainings', TrainingController::class)->middleware(['auth', 'verified']);
Route::get('trainings/{training}/start', [TrainingController::class, 'start'])->middleware(['auth', 'verified'])->name('trainings.start');

Route::resource('deal_constraints', DealConstraintController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
