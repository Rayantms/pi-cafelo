<?php

use App\Http\Controllers\ConfiguracoesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientePerfilController;
use App\Http\Controllers\ProdutosController;

/* Route::middleware(['auth'])->group(function () {
}); */

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/perfil', [ClientePerfilController::class, 'show'])->name('perfil');
Route::put('/perfil', [ClientePerfilController::class, 'update'])->name('perfil.update');

Route::get('/produtos', [ProdutosController::class,'index'])->name('produtos');
Route::get('/produtos/novo', [ProdutosController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutosController::class, 'store'])->name('produtos.store');
Route::get('/produtos/{produto}/editar', [ProdutosController::class, 'edit'])->name('produtos.edit');
Route::get('/produtos/{produto}', [ProdutosController::class, 'show'])->name('produtos.show');
Route::put('/produtos/{produto}', [ProdutosController::class, 'update'])->name('produtos.update');

Route::get('/cadastro-cliente', [DashboardController::class, 'cadastroCliente'])->name('cadastro-cliente');
Route::get('/tela-Login', [DashboardController::class, 'telaLogin'])->name('tela-login');
Route::get('/configuracoes', [ConfiguracoesController::class, 'index'])->name('configuracoes');
Route::put('/configuracoes', [ConfiguracoesController::class, 'update'])->name('configuracoes.update');

Route::get('/registro-de-vendas', function () {
    return view('dashboard.registrodevendas');
})->name('registro-devendas');

Route::view('/resgates', 'dashboard.tela-resgate')->name('resgates');