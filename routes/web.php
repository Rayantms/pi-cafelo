<?php

use App\Http\Controllers\DashboardController;
use App\Models\Cliente;

/* Route::middleware(['auth'])->group(function () {
}); */

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/registro-de-vendas', function () {
    return view('dashboard.registrodevendas');
})->name('registro-devendas');

//