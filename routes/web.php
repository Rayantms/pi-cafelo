<?php

use App\Http\Controllers\ConfiguracoesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientePerfilController;

/* Route::middleware(['auth'])->group(function () {
}); */

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/perfil', [ClientePerfilController::class, 'show'])->name('perfil');
Route::put('/perfil', [ClientePerfilController::class, 'update'])->name('perfil.update');

Route::get('/cadastro-cliente', [DashboardController::class, 'cadastroCliente'])->name('cadastro-cliente');
Route::get('/tela-Login', [DashboardController::class, 'telaLogin'])->name('tela-login');
Route::get('/configuracoes', [ConfiguracoesController::class, 'index'])->name('configuracoes');
Route::put('/configuracoes', [ConfiguracoesController::class, 'update'])->name('configuracoes.update');


