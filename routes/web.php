<?php

use App\Http\Controllers\ReminderController;
use Illuminate\Support\Facades\Route;

// Home da aplicação aponta para a lista de lembretes
Route::get('/', [ReminderController::class, 'index'])
    ->middleware('auth')
    ->name('home');

    Route::get('/', [ReminderController::class, 'create'])
    ->middleware('auth')
    ->name('home');

// Todas as rotas de lembretes protegidas para usuários autenticados
Route::middleware('auth')->group(function () {
    Route::resource('reminders', ReminderController::class);
});

require __DIR__.'/auth.php';