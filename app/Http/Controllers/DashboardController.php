<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'vendasHoje' => 4250,
            'pontosDistribuidos' => 1850,
            'resgatesHoje' => 24,
            'novosClientes' => 18,
            'transacoesRecentes' => [
                [
                    'cliente' => 'Maria Silva',
                    'tipo' => 'Venda',
                    'valor' => 'R$ 45,00',
                    'status' => 'Aprovado',
                    'icone' => 'payments',
                ],
                [
                    'cliente' => 'João Souza',
                    'tipo' => 'Resgate',
                    'valor' => '-150 pts',
                    'status' => 'Concluído',
                    'icone' => 'redeem',
                ],
                [
                    'cliente' => 'Ana Lima',
                    'tipo' => 'Venda',
                    'valor' => 'R$ 120,50',
                    'status' => 'Pendente',
                    'icone' => 'payments',
                ],
                [
                    'cliente' => 'Pedro Alves',
                    'tipo' => 'Venda',
                    'valor' => 'R$ 22,00',
                    'status' => 'Aprovado',
                    'icone' => 'payments',
                ],
            ],
        ]);
    }

    public function cadastroCliente()
    {
        return view('cadastro-cliente');
    }

    public function registroVendas()
    {
        $produtos = Produto::query()->latest()->get();
        return view('dashboard.registro-de-vendas', compact('produtos'));
    }

    public function telaLogin()
    {
        return view('stitch.tela-Login');
    }

}
