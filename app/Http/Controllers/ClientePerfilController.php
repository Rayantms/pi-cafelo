<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class ClientePerfilController extends Controller
{
    public function show()
    {
        $clientes = Cliente::all();

        // For testing: use first user if not authenticated
        $user = auth()->user() ?? User::first();

        $activeCliente = null;
        if ($user && $user->active_cliente_id) {
            $activeCliente = Cliente::find($user->active_cliente_id);
        }

        $cliente = $activeCliente ?? (Cliente::first() ?? new Cliente());

        return view('dashboard.perfil', compact('cliente', 'clientes'));
    }

    public function selectCliente(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        // For testing: use first user if not authenticated
        $user = $request->user() ?? User::first();

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

    public function update(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:50',
        ]);

        $cliente = Cliente::first();

        if (! $cliente) {
            $cliente = new Cliente();
            $cliente->saldo_pontos = 0;
        }

        $cliente->fill($data);
        $cliente->save();

        return redirect()->route('perfil')->with('status', 'Perfil atualizado com sucesso.');
    }
}
