<x-app-layout titulo="Produtos">
    @php
        $produtos = collect($produtos ?? []);
        $totalProdutos = $produtos->count();
        $valorTotal = $produtos->sum(fn ($produto) => (float) $produto->preco);
        $pontosCompraTotal = $produtos->sum('pontos_compra');
        $pontosResgateTotal = $produtos->sum('pontos_resgate');
        $precoMedio = $totalProdutos > 0 ? $valorTotal / $totalProdutos : 0;
        $produtoMaisCaro = $produtos->sortByDesc('preco')->first();
    @endphp

    <div class="space-y-8">
        @if (session('success'))
            <div class="rounded-3xl border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm font-medium text-emerald-700 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <section class="overflow-hidden rounded-3xl bg-gradient-to-br from-[#2a1b17] via-[#4e342e] to-[#7d562d] p-8 text-white shadow-[0_24px_80px_rgba(42,27,23,0.18)]">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs uppercase tracking-[0.35em] text-[#f2ddcf]">Catálogo Cafélo</p>
                    <h1 class="mt-3 text-3xl font-bold lg:text-4xl">Listagem de Produtos</h1>
                    <p class="mt-3 text-sm leading-6 text-white/75">
                        Consulte o catálogo, compare preços e acompanhe os pontos de compra e resgate de cada item.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="#catalogo-produtos" class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-semibold text-[#2a1b17] transition-transform hover:-translate-y-0.5">
                        <span class="material-symbols-outlined text-[18px]">search</span>
                        Ver catálogo
                    </a>

                    <a href="{{ route('produtos.create') }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-5 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
                        <span class="material-symbols-outlined text-[18px]">add_box</span>
                        Novo Produto
                    </a>
                </div>
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Produtos cadastrados</p>
                        <h2 class="mt-2 text-3xl font-bold text-slate-900">{{ $totalProdutos }}</h2>
                    </div>
                    <span class="material-symbols-outlined rounded-2xl bg-slate-100 p-3 text-slate-700">inventory_2</span>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Preço médio</p>
                        <h2 class="mt-2 text-3xl font-bold text-slate-900">R$ {{ number_format($precoMedio, 2, ',', '.') }}</h2>
                    </div>
                    <span class="material-symbols-outlined rounded-2xl bg-amber-50 p-3 text-amber-700">payments</span>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Pontos de compra</p>
                        <h2 class="mt-2 text-3xl font-bold text-slate-900">{{ $pontosCompraTotal }}</h2>
                    </div>
                    <span class="material-symbols-outlined rounded-2xl bg-emerald-50 p-3 text-emerald-700">stars</span>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Pontos de resgate</p>
                        <h2 class="mt-2 text-3xl font-bold text-slate-900">{{ $pontosResgateTotal }}</h2>
                    </div>
                    <span class="material-symbols-outlined rounded-2xl bg-[#faedcd] p-3 text-[#7d562d]">redeem</span>
                </div>
            </div>
        </section>

        <section id="catalogo-produtos" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-slate-900">Catálogo de Produtos</h2>
                    <p class="mt-2 text-sm text-slate-500">Use a busca para localizar rapidamente itens por nome, descrição ou valores.</p>
                </div>

                <div class="w-full lg:max-w-md">
                    <div class="relative rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 shadow-sm focus-within:border-[#d4a373] focus-within:ring-2 focus-within:ring-[#d4a373]/20">
                        <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                            <span class="material-symbols-outlined">search</span>
                        </div>
                        <input
                            id="product-search"
                            type="search"
                            placeholder="Buscar por nome, descrição, preço ou pontos..."
                            class="w-full border-none bg-transparent pl-11 text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none"
                        />
                    </div>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Produto</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Descrição</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Preço</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Pontos</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Atualizado</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="products-table-body" class="divide-y divide-slate-100 bg-white">
                            @forelse ($produtos as $produto)
                                <tr
                                    class="product-row transition hover:bg-slate-50"
                                    data-search="{{ mb_strtolower(trim($produto->nome.' '.$produto->descricao.' '.$produto->preco.' '.$produto->pontos_compra.' '.$produto->pontos_resgate)) }}"
                                >
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#faedcd] text-sm font-bold uppercase text-[#7d562d]">
                                                {{ mb_substr($produto->nome, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-slate-900">{{ $produto->nome }}</p>
                                                <p class="text-sm text-slate-500">ID #{{ $produto->id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="max-w-xl text-sm leading-6 text-slate-600">
                                            {{ $produto->descricao ?: 'Descrição não informada.' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-sm font-semibold text-emerald-700">
                                            R$ {{ number_format((float) $produto->preco, 2, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="space-y-1 text-sm text-slate-700">
                                            <div class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 font-medium text-slate-700">
                                                <span class="material-symbols-outlined text-[16px] text-amber-600">shopping_bag</span>
                                                Compra: {{ (int) $produto->pontos_compra }}
                                            </div>
                                            <div class="inline-flex items-center gap-2 rounded-full bg-[#faedcd] px-3 py-1 font-medium text-[#7d562d]">
                                                <span class="material-symbols-outlined text-[16px]">redeem</span>
                                                Resgate: {{ (int) $produto->pontos_resgate }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-sm text-slate-500">
                                        {{ $produto->updated_at?->format('d/m/Y') ?? '-' }}
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="{{ route('produtos.edit', $produto) }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-[#d4a373] hover:text-[#7d562d]">
                                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                                Editar
                                            </a>
                                            <a href="{{ route('produtos.show', $produto) }}" class="inline-flex items-center gap-2 rounded-full bg-[#2a1b17] px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-900">
                                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                                Ver
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-14 text-center">
                                        <div class="mx-auto flex max-w-md flex-col items-center gap-4">
                                            <span class="material-symbols-outlined rounded-full bg-slate-100 p-4 text-3xl text-slate-400">inventory_2</span>
                                            <div>
                                                <h3 class="text-lg font-semibold text-slate-900">Nenhum produto cadastrado</h3>
                                                <p class="mt-2 text-sm text-slate-500">Cadastre o primeiro produto para começar a montar o catálogo.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($produtoMaisCaro)
                <div class="mt-6 rounded-3xl border border-slate-200 bg-slate-50 p-5">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Produto em destaque</p>
                            <h3 class="mt-2 text-xl font-semibold text-slate-900">{{ $produtoMaisCaro->nome }}</h3>
                            <p class="mt-1 text-sm text-slate-600">Maior valor do catálogo no momento.</p>
                        </div>

                        <div class="flex items-center gap-3 rounded-3xl bg-white px-5 py-4 shadow-sm">
                            <span class="material-symbols-outlined text-2xl text-amber-600">local_mall</span>
                            <div>
                                <p class="text-xs uppercase tracking-[0.18em] text-slate-500">Preço</p>
                                <p class="text-lg font-semibold text-slate-900">R$ {{ number_format((float) $produtoMaisCaro->preco, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </div>

    <script>
        (function () {
            const searchInput = document.getElementById('product-search');
            const rows = document.querySelectorAll('.product-row');

            if (!searchInput || !rows.length) {
                return;
            }

            searchInput.addEventListener('input', () => {
                const term = searchInput.value.trim().toLowerCase();

                rows.forEach((row) => {
                    const haystack = row.dataset.search || '';
                    row.style.display = haystack.includes(term) ? '' : 'none';
                });
            });
        })();
    </script>
</x-app-layout>
