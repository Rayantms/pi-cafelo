<?php

use App\Http\Controllers\ConfiguracoesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientePerfilController;
use App\Http\Controllers\ProdutosController;

/* Route::middleware(['auth'])->group(function () {
}); */

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/historico-vendas', [DashboardController::class, 'historicoVendas'])->name('dashboard.historico-vendas');

Route::get('/perfil', [ClientePerfilController::class, 'show'])->name('perfil');
Route::put('/perfil', [ClientePerfilController::class, 'update'])->name('perfil.update');
Route::get('/configuracoes', [ConfiguracoesController::class, 'index'])->name('configuracoes');
Route::put('/configuracoes', [ConfiguracoesController::class, 'update'])->name('configuracoes.update');

Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos');
Route::get('/produtos/criar', [ProdutosController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutosController::class, 'store'])->name('produtos.store');
Route::get('/produtos/{produto}', [ProdutosController::class, 'show'])->name('produtos.show');
Route::get('/produtos/{produto}/editar', [ProdutosController::class, 'edit'])->name('produtos.edit');
Route::put('/produtos/{produto}', [ProdutosController::class, 'update'])->name('produtos.update');

Route::get('/resgates', function () {
	return view('dashboard.tela-resgate');
})->name('resgates');

Route::get('/tela-login', [DashboardController::class, 'tela-login'])->name('tela-login');
Route::get('/cadastro-cliente', [DashboardController::class, 'cadastroCliente'])->name('cadastro-cliente');
Route::post('/cadastro-cliente', [DashboardController::class, 'storeCliente'])->name('cadastro-cliente.store');

Route::get('/registro-de-vendas', [DashboardController::class, 'registroVendas'])->name('registro-de-vendas');
Route::post('/registro-de-vendas', [DashboardController::class, 'storeVenda'])->name('registro-de-vendas.store');