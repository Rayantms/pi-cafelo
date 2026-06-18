<?php

use App\Http\Controllers\ConfiguracoesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientePerfilController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ResgateController;

/* Route::middleware(['auth'])->group(function () {
}); */

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/historico-vendas', [DashboardController::class, 'historicoVendas'])->name('dashboard.historico-vendas');

Route::get('/perfil', [ClientePerfilController::class, 'show'])->name('perfil');
Route::put('/perfil', [ClientePerfilController::class, 'update'])->name('perfil.update');
Route::post('/perfil/selecionar-cliente', [ClientePerfilController::class, 'selectCliente'])->name('perfil.select_cliente');
Route::get('/configuracoes', [ConfiguracoesController::class, 'index'])->name('configuracoes');
Route::put('/configuracoes', [ConfiguracoesController::class, 'update'])->name('configuracoes.update');

Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos');
Route::get('/produtos/criar', [ProdutosController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutosController::class, 'store'])->name('produtos.store');
Route::get('/produtos/{produto}', [ProdutosController::class, 'show'])->name('produtos.show');
Route::get('/produtos/{produto}/editar', [ProdutosController::class, 'edit'])->name('produtos.edit');
Route::put('/produtos/{produto}', [ProdutosController::class, 'update'])->name('produtos.update');
Route::delete('/produtos/{produto}', [ProdutosController::class, 'destroy'])->name('produtos.destroy');

Route::get('/resgates', [ResgateController::class, 'index'])->name('resgates');
Route::get('/resgastes', fn () => redirect()->route('resgates'));
Route::post('/resgates', [ResgateController::class, 'store'])->name('resgates.store');
Route::post('/resgates/selecionar-cliente', [ResgateController::class, 'selectCliente'])->name('resgates.select_cliente');

Route::get('/tela-login', [DashboardController::class, 'telaLogin'])->name('tela-login');
// Provide a named `login` route so `auth` middleware can redirect unauthenticated users
Route::get('/login', function () {
	return redirect()->route('tela-login');
})->name('login');
Route::get('/cadastro-cliente', [DashboardController::class, 'cadastroCliente'])->name('cadastro-cliente');
Route::post('/cadastro-cliente', [DashboardController::class, 'storeCliente'])->name('cadastro-cliente.store');

Route::get('/registro-de-vendas', [DashboardController::class, 'registroVendas'])->name('registro-de-vendas');
Route::post('/registro-de-vendas', [DashboardController::class, 'storeVenda'])->name('registro-de-vendas.store');
