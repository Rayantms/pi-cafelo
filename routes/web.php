<?php

use App\Http\Controllers\DashboardController;

/* Route::middleware(['auth'])->group(function () {
}); */

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

use App\Models\Cliente;

Route::get('/', function () {

    $cliente = Cliente::find(1);

    return view('pontos', compact('cliente'));
});