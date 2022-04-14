<?php

use App\Http\Controllers\BiddingController;
use App\Http\Controllers\BiddingsController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('biddings', BiddingController::class)->middleware(['auth', 'verified']);

Route::resource('deals', DealController::class)->middleware(['auth', 'verified']);

Route::resource('quizzes', QuizController::class)->middleware(['auth', 'verified']);
Route::get('quizzes/{quiz}/generate-deals', [QuizController::class, 'generateDeals'])->middleware(['auth', 'verified'])->name('quizzes.generate-deals');

Route::resource('trainings', TrainingController::class)->middleware(['auth', 'verified']);
Route::get('trainings/{training}/start', [TrainingController::class, 'start'])->middleware(['auth', 'verified'])->name('trainings.start');

Route::resource('deal_constraints', DealConstraintController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
