<?php

use App\Http\Controllers\DashboardController;

/* Route::middleware(['auth'])->group(function () {
}); */

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/cadastro-cliente', [DashboardController::class, 'cadastroCliente'])->name('cadastro-cliente');
Route::get('/tela-Login', [DashboardController::class, 'telaLogin'])->name('tela-login');