<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracoesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            return view('dashboard.configuracoes', [
                'model' => $user,
                'type' => 'user',
            ]);
        }

        $cliente = Cliente::first() ?? new Cliente();

        return view('dashboard.configuracoes', [
            'model' => $cliente,
            'type' => 'cliente',
        ]);
    }

    public function update(Request $request)
    {
        if (Auth::check()) {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);

            $user = Auth::user();
            $user->fill($data);
            $user->save();

            return redirect()->route('configuracoes')->with('status', 'Configurações atualizadas com sucesso.');
        }

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:50',
        ]);

        $cliente = Cliente::first() ?? new Cliente();
        $cliente->fill($data);
        $cliente->saldo_pontos = $cliente->saldo_pontos ?? 0;
        $cliente->save();

        return redirect()->route('configuracoes')->with('status', 'Configurações atualizadas com sucesso.');
    }
}
