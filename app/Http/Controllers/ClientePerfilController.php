<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientePerfilController extends Controller
{
    public function show()
    {
        $cliente = Cliente::first() ?? new Cliente();

        return view('dashboard.perfil', compact('cliente'));
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
