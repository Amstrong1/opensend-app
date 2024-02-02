<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UUIDController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WithDrawController;
use App\Http\Controllers\SendMoneyController;
use App\Http\Controllers\TransfertValidation;

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

Route::middleware('setLocale')->group(function () {

    Route::match(['get', 'post'], '/', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified']);

    Route::match(['get', 'post'], '/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::match(['get', 'post'], '/confirm', [ConfirmController::class, 'index'])->name('confirm');

    Route::post('/lang', [LangController::class, 'index'])->name('lang');

    Route::middleware('auth')->group(function () {
        Route::post('/session', [StripeController::class, 'session'])->name('session');
        Route::get('/success', [StripeController::class, 'success'])->name('success');

        Route::get('/done', function () {
            return view('success');
        })->name('done');

        Route::get('/send', [SendMoneyController::class, 'create'])->name('send.create');
        Route::post('/send', [SendMoneyController::class, 'store'])->name('send.store');

        Route::get('/history', [HistoryController::class, 'index'])->name('history');

        Route::get('/withdraw', [WithDrawController::class, 'create'])->name('withdraw.create');
        Route::post('/withdraw', [WithDrawController::class, 'store'])->name('withdraw.store');

        Route::get('/uuid', [UUIDController::class, 'index'])->name('uuid.index');

        Route::post('/transfer-validation', [TransfertValidation::class, 'store'])->name('transfer-validation');

        Route::post('/topup', [TopUpController::class, 'index'])->name('topup');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/chat', [ChatController::class, 'index'])->name('chat');
        Route::get('/messages', [ChatController::class, 'fetchMessages']);
        Route::post('/messages', [ChatController::class, 'sendMessage']);
    });
});

require __DIR__ . '/auth.php';
