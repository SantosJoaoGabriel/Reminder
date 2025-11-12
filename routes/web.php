<?php

use App\Http\Controllers\ReminderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ReminderController::class, 'index'])->middleware('auth')->name('home');

Route::get('/reminders', function () {
    return view('reminders');
})->middleware(['auth', 'verified'])->name('reminders');

Route::middleware('auth')->group(function () {
    Route::resource('reminders', ReminderController::class); // sem barra no começo!
});

require __DIR__.'/auth.php';
