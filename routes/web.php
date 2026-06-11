<?php

use App\Http\Controllers\DashboardController;

/* Route::middleware(['auth'])->group(function () {
}); */

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Histórico de Vendas (view direta)
Route::get('/dashboard/historico-vendas', function () {
	return view('dashboard.historico-vendas');
})->name('dashboard.historico-vendas');

