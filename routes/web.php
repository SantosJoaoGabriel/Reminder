<?php

use App\Http\Controllers\ReminderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ReminderController::class, 'index'])->middleware('auth')->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('reminders', ReminderController::class); // sem barra no começo!
});

require __DIR__.'/auth.php';
