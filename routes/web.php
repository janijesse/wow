<?php
use App\Http\Controllers\WowController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::view('/','welcome')->name('welcome');



Route::middleware('auth')->group(function () {

    Route::view('/dashboard','dashboard')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/wows', [WowController::class, 'index'])
    ->name('wows.index');

    Route::post('/wows', [WowController::class, 'store'])
    ->name('wows.store');

    Route::get('/wows/{wow}/edit', [WowController::class, 'edit'])
    ->name('wows.edit');

    Route::put('/wows/{wow}', [WowController::class, 'update'])->name('wows.update');

    Route::delete('/wows/{wow}', [WowController::class, 'destroy'])->name('wows.destroy');



});

require __DIR__.'/auth.php';
