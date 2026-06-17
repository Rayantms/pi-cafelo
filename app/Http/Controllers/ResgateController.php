<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Resgate;
use App\Models\MovimentacaoPontos;
use Illuminate\Support\Facades\DB;

class ResgateController extends Controller
{
    protected function getCliente()
    {
        return Cliente::first();
    }

    public function index()
    {
        $cliente = $this->getCliente();

        if (! $cliente) {
            return redirect()->route('dashboard')->with('error', 'Nenhum cliente encontrado.');
        }

        $produtos = Produto::all();

        return view('dashboard.tela-resgate', compact('cliente', 'produtos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produto_id' => ['required', 'exists:produtos,id'],
        ]);

        $cliente = $this->getCliente();

        if (! $cliente) {
            return redirect()->route('dashboard')->with('error', 'Nenhum cliente encontrado.');
        }

        $produto = Produto::findOrFail($validated['produto_id']);

        if ($cliente->saldo_pontos < $produto->pontos_resgate) {
            return redirect()->route('resgates')->with('error', 'Saldo insuficiente para este resgate.');
        }

        DB::transaction(function () use ($cliente, $produto) {
            $cliente->decrement('saldo_pontos', $produto->pontos_resgate);

            Resgate::create([
                'cliente_id' => $cliente->id,
                'produto_id' => $produto->id,
                'pontos_utilizados' => $produto->pontos_resgate,
            ]);

            MovimentacaoPontos::create([
                'cliente_id' => $cliente->id,
                'tipo' => 'debito',
                'pontos' => $produto->pontos_resgate,
                'descricao' => "Resgate de produto: {$produto->nome}",
            ]);
        });

        return redirect()->route('resgates')->with('success', 'Resgate realizado com sucesso.');
    }
}
