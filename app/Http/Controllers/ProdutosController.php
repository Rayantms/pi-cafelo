<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::query()->latest()->get();

        return view('dashboard.produtos', compact('produtos'));
    }

    public function create()
    {
        return view('dashboard.produtos-create');
    }

    public function edit(Produto $produto)
    {
        return view('dashboard.produtos-edit', compact('produto'));
    }

    public function show(Produto $produto)
    {
        return view('dashboard.produtos-show', compact('produto'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'preco' => ['required', 'numeric', 'min:0'],
            'pontos_compra' => ['required', 'integer', 'min:0'],
            'pontos_resgate' => ['required', 'integer', 'min:0'],
            'imagem' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('produtos', 'public');
            $validated['imagem'] = $path;
        }

        Produto::create($validated);

        return redirect()
            ->route('produtos')
            ->with('success', 'Produto cadastrado com sucesso.');
    }

    public function update(Request $request, Produto $produto)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'preco' => ['required', 'numeric', 'min:0'],
            'pontos_compra' => ['required', 'integer', 'min:0'],
            'pontos_resgate' => ['required', 'integer', 'min:0'],
            'imagem' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('imagem')) {
            if ($produto->imagem && \Storage::disk('public')->exists($produto->imagem)) {
                \Storage::disk('public')->delete($produto->imagem);
            }
            $path = $request->file('imagem')->store('produtos', 'public');
            $validated['imagem'] = $path;
        }

        $produto->update($validated);

        return redirect()
            ->route('produtos')
            ->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto)
    {
        if ($produto->imagem && \Storage::disk('public')->exists($produto->imagem)) {
            \Storage::disk('public')->delete($produto->imagem);
        }
        $produto->delete();

        return redirect()
            ->route('produtos')
            ->with('success', 'Produto deletado com sucesso.');
    }
}
