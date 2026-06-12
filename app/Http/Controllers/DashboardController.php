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
        $today = now()->startOfDay();

        $vendasHoje = \App\Models\Venda::where('created_at', '>=', $today)->sum('valor_total');
        $pontosDistribuidos = \App\Models\MovimentacaoPontos::where('tipo', 'credito')->where('created_at', '>=', $today)->sum('pontos');
        $resgatesHoje = \App\Models\Resgate::where('created_at', '>=', $today)->count();
        $novosClientes = \App\Models\Cliente::where('created_at', '>=', $today)->count();

        // Monta transações recentes combinando vendas e resgates
        $vendas = \App\Models\Venda::with('cliente')->latest()->take(6)->get()->map(function($v) {
            return [
                'cliente' => optional($v->cliente)->nome ?? '—',
                'tipo' => 'Venda',
                'valor' => 'R$ '.number_format($v->valor_total, 2, ',', '.'),
                'status' => 'Concluído',
                'icone' => 'payments',
                'created_at' => $v->created_at,
            ];
        });

        $resgates = \App\Models\Resgate::with('cliente')->latest()->take(6)->get()->map(function($r) {
            return [
                'cliente' => optional($r->cliente)->nome ?? '—',
                'tipo' => 'Resgate',
                'valor' => '-' . number_format($r->pontos_utilizados, 0, ',', '.') . ' pts',
                'status' => 'Concluído',
                'icone' => 'redeem',
                'created_at' => $r->created_at,
            ];
        });

        $transacoesRecentes = $vendas->concat($resgates)->sortByDesc('created_at')->values()->take(4)->map(function($t) {
            unset($t['created_at']);
            return $t;
        })->toArray();

        return view('dashboard.index', compact('vendasHoje', 'pontosDistribuidos', 'resgatesHoje', 'novosClientes', 'transacoesRecentes'));
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
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('clientes', 'public');
            $validated['foto'] = $path;
        }

        Cliente::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'] ?? null,
            'telefone' => $validated['telefone'] ?? null,
            'saldo_pontos' => 0,
            'foto' => $validated['foto'] ?? null,
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

    public function historicoVendas(Request $request)
    {
        $period = $request->query('period', 'all');
        $now = now();

        switch ($period) {
            case 'today':
                $from = $now->copy()->startOfDay();
                break;
            case '7':
                $from = $now->copy()->subDays(6)->startOfDay();
                break;
            case '30':
                $from = $now->copy()->subDays(29)->startOfDay();
                break;
            default:
                $from = null;
        }

        if ($from) {
            $totalVendas = Venda::where('created_at', '>=', $from)->sum('valor_total');
            $pontosCreditados = MovimentacaoPontos::where('tipo', 'credito')->where('created_at', '>=', $from)->sum('pontos');
            $resgatesRealizados = \App\Models\Resgate::where('created_at', '>=', $from)->count();
        } else {
            $totalVendas = Venda::sum('valor_total');
            $pontosCreditados = MovimentacaoPontos::where('tipo', 'credito')->sum('pontos');
            $resgatesRealizados = \App\Models\Resgate::count();
        }

        return view('dashboard.historico-vendas', compact('totalVendas', 'pontosCreditados', 'resgatesRealizados', 'period'));
    }

}
