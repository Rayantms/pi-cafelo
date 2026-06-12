<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ItemVenda;
use App\Models\MovimentacaoPontos;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function storeCliente(Request $request)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'telefone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        Cliente::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'] ?? null,
            'telefone' => $validated['telefone'] ?? null,
            'saldo_pontos' => 0,
        ]);

        return redirect()->route('cadastro-cliente')->with('success', 'Cliente cadastrado com sucesso.');
    }

    public function registroVendas()
    {
        $produtos = Produto::query()->latest()->get();
        $clientes = Cliente::all();

        return view('dashboard.registro-de-vendas', compact('produtos', 'clientes'));
    }

    public function storeVenda(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.produto_id' => ['required', 'integer', 'exists:produtos,id'],
            'items.*.quantidade' => ['required', 'integer', 'min:1'],
        ]);

        $cliente = Cliente::findOrFail($validated['cliente_id']);
        $items = collect($validated['items']);
        $produtos = Produto::whereIn('id', $items->pluck('produto_id'))->get()->keyBy('id');

        DB::transaction(function () use ($cliente, $items, $produtos) {
            $valorTotal = 0;
            $pontosCredito = 0;

            $venda = Venda::create([
                'cliente_id' => $cliente->id,
                'valor_total' => 0,
            ]);

            foreach ($items as $item) {
                $produto = $produtos[$item['produto_id']];
                $quantidade = (int) $item['quantidade'];
                $valorUnitario = $produto->preco;
                $subtotal = $valorUnitario * $quantidade;

                ItemVenda::create([
                    'venda_id' => $venda->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $quantidade,
                    'valor_unitario' => $valorUnitario,
                    'subtotal' => $subtotal,
                ]);

                $valorTotal += $subtotal;
                $pontosCredito += $produto->pontos_compra * $quantidade;
            }

            $venda->valor_total = $valorTotal;
            $venda->save();

            if ($pontosCredito > 0) {
                MovimentacaoPontos::create([
                    'cliente_id' => $cliente->id,
                    'tipo' => 'credito',
                    'pontos' => $pontosCredito,
                    'descricao' => "Pontos creditados pela venda #{$venda->id}",
                ]);

                $cliente->increment('saldo_pontos', $pontosCredito);
            }
        });

        return redirect()->route('registro-de-vendas')->with('success', 'Venda registrada com sucesso.');
    }

    public function telaLogin()
    {
        return view('stitch.tela-Login');
    }

}
