<x-app-layout titulo="Visualizar Produto">
    <div class="space-y-8">
        <section class="overflow-hidden rounded-3xl bg-gradient-to-br from-[#2a1b17] via-[#4e342e] to-[#7d562d] p-8 text-white shadow-[0_24px_80px_rgba(42,27,23,0.18)]">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs uppercase tracking-[0.35em] text-[#f2ddcf]">Consulta de Produtos</p>
                    <h1 class="mt-3 text-3xl font-bold lg:text-4xl">Visualizar produto</h1>
                    <p class="mt-3 text-sm leading-6 text-white/75">
                        Confira os dados cadastrados para {{ $produto->nome }} sem permitir alterações.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('produtos.edit', $produto) }}" class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-semibold text-[#2a1b17] transition-transform hover:-translate-y-0.5">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                        Editar produto
                    </a>

                    <a href="{{ route('produtos') }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-5 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Voltar para a lista
                    </a>
                </div>
            </div>
        </section>

        <section class="grid gap-6 xl:grid-cols-[1.25fr_0.75fr]">
            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-slate-900">Dados do produto</h2>
                    <p class="mt-2 text-sm text-slate-500">Os campos abaixo estão desabilitados apenas para leitura.</p>
                </div>

                <div class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2 md:col-span-2">
                            <label for="nome" class="block text-sm font-semibold text-slate-700">Nome do produto</label>
                            <input
                                id="nome"
                                type="text"
                                value="{{ $produto->nome }}"
                                disabled
                                class="w-full cursor-not-allowed rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 opacity-90"
                            />
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label for="descricao" class="block text-sm font-semibold text-slate-700">Descrição</label>
                            <textarea
                                id="descricao"
                                rows="4"
                                disabled
                                class="w-full cursor-not-allowed rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 opacity-90"
                            >{{ $produto->descricao }}</textarea>
                        </div>

                        <div class="space-y-2">
                            <label for="preco" class="block text-sm font-semibold text-slate-700">Preço</label>
                            <input
                                id="preco"
                                type="text"
                                value="R$ {{ number_format((float) $produto->preco, 2, ',', '.') }}"
                                disabled
                                class="w-full cursor-not-allowed rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 opacity-90"
                            />
                        </div>

                        <div class="space-y-2">
                            <label for="pontos_compra" class="block text-sm font-semibold text-slate-700">Pontos de compra</label>
                            <input
                                id="pontos_compra"
                                type="text"
                                value="{{ $produto->pontos_compra }}"
                                disabled
                                class="w-full cursor-not-allowed rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 opacity-90"
                            />
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label for="pontos_resgate" class="block text-sm font-semibold text-slate-700">Pontos de resgate</label>
                            <input
                                id="pontos_resgate"
                                type="text"
                                value="{{ $produto->pontos_resgate }}"
                                disabled
                                class="w-full cursor-not-allowed rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 opacity-90"
                            />
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">
                        <a href="{{ route('produtos.edit', $produto) }}" class="inline-flex items-center justify-center rounded-3xl bg-[#2a1b17] px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-900">
                            <span class="material-symbols-outlined mr-2 text-[18px]">edit</span>
                            Ir para edição
                        </a>

                        <a href="{{ route('produtos') }}" class="inline-flex items-center justify-center rounded-3xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-slate-900">Resumo do produto</h3>
                    <p class="mt-2 text-sm text-slate-500">ID #{{ $produto->id }}</p>

                    <div class="mt-5 space-y-3">
                        <div class="rounded-2xl bg-slate-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Nome</p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">{{ $produto->nome }}</p>
                        </div>
                        <div class="rounded-2xl bg-[#faedcd] px-4 py-3 text-[#7d562d]">
                            <p class="text-xs uppercase tracking-[0.2em] text-[#9c6c4a]">Preço</p>
                            <p class="mt-1 text-sm font-semibold">R$ {{ number_format((float) $produto->preco, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3 text-slate-900">
                        <span class="material-symbols-outlined text-2xl text-amber-600">visibility</span>
                        <h3 class="text-lg font-semibold">Leitura</h3>
                    </div>

                    <ol class="mt-4 space-y-3 text-sm text-slate-600">
                        <li class="rounded-2xl bg-slate-50 px-4 py-3">1. A visualização bloqueia edição direta.</li>
                        <li class="rounded-2xl bg-slate-50 px-4 py-3">2. Use o botão de edição para alterar os dados.</li>
                        <li class="rounded-2xl bg-slate-50 px-4 py-3">3. Os valores exibidos vêm da tabela <strong class="font-semibold text-slate-900">produtos</strong>.</li>
                    </ol>
                </div>
            </aside>
        </section>
    </div>
</x-app-layout>