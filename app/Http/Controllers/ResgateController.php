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
        // For testing: use first user if not authenticated
        $user = auth()->user() ?? \App\Models\User::first();
        
        $cliente = null;
        if ($user && $user->active_cliente_id) {
            $cliente = Cliente::find($user->active_cliente_id);
        }
        $cliente = $cliente ?? $this->getCliente();
        
        $clientes = Cliente::all();
        $produtos = Produto::all();

        return view('dashboard.tela-resgate', compact('cliente', 'clientes', 'produtos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produto_id' => ['required', 'exists:produtos,id'],
        ]);

        $cliente = $this->getCliente();

        if (! $cliente) {
            return redirect()->route('resgates')->with('error', 'Nenhum cliente encontrado. Cadastre um cliente antes de realizar resgates.');
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

    public function selectCliente(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        // For testing: use first user if not authenticated
        $user = $request->user() ?? \App\Models\User::first();

        if (! $user) {
            return response()->json(['success' => false, 'message' => 'Nenhum usuário disponível.'], 403);
        }

        $user->active_cliente_id = $data['cliente_id'];
        $user->save();

        $cliente = Cliente::find($data['cliente_id']);

        return response()->json([
            'success' => true,
            'cliente' => [
                'id' => $cliente->id,
                'nome' => $cliente->nome,
                'email' => $cliente->email,
                'telefone' => $cliente->telefone,
            ],
        ]);
    }
}
