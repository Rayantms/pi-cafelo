<x-app-layout titulo="Novo Produto">
    <div class="space-y-8">
        <section class="overflow-hidden rounded-3xl bg-gradient-to-br from-[#2a1b17] via-[#4e342e] to-[#7d562d] p-8 text-white shadow-[0_24px_80px_rgba(42,27,23,0.18)]">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs uppercase tracking-[0.35em] text-[#f2ddcf]">Cadastro de Produtos</p>
                    <h1 class="mt-3 text-3xl font-bold lg:text-4xl">Inserir novo produto</h1>
                    <p class="mt-3 text-sm leading-6 text-white/75">
                        Cadastre itens com preço e pontos para compra e resgate usando o mesmo padrão visual do sistema.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('produtos') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-semibold text-[#2a1b17] transition-transform hover:-translate-y-0.5">
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
                    <p class="mt-2 text-sm text-slate-500">Preencha os campos abaixo para gravar o produto no banco.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 rounded-3xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                        <p class="font-semibold">Corrija os itens abaixo:</p>
                        <ul class="mt-2 list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2 md:col-span-2">
                            <label for="nome" class="block text-sm font-semibold text-slate-700">Nome do produto</label>
                            <input
                                id="nome"
                                name="nome"
                                type="text"
                                value="{{ old('nome') }}"
                                placeholder="Ex.: Café Especial 250g"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#d4a373] focus:ring-2 focus:ring-[#d4a373]/20"
                            />
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label for="descricao" class="block text-sm font-semibold text-slate-700">Descrição</label>
                            <textarea
                                id="descricao"
                                name="descricao"
                                rows="4"
                                placeholder="Descreva o produto, características e indicações de uso"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#d4a373] focus:ring-2 focus:ring-[#d4a373]/20"
                            >{{ old('descricao') }}</textarea>
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label for="imagem" class="block text-sm font-semibold text-slate-700">Foto do produto</label>
                            <input
                                id="imagem"
                                name="imagem"
                                type="file"
                                accept="image/jpeg,image/png,image/jpg,image/gif"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#d4a373] focus:ring-2 focus:ring-[#d4a373]/20"
                            />
                            <p class="text-xs text-slate-500">Formatos: JPEG, PNG, JPG, GIF. Máximo: 2MB</p>
                        </div>

                        <div class="space-y-2">
                            <label for="preco" class="block text-sm font-semibold text-slate-700">Preço</label>
                            <input
                                id="preco"
                                name="preco"
                                type="number"
                                step="0.01"
                                min="0"
                                value="{{ old('preco') }}"
                                placeholder="0,00"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#d4a373] focus:ring-2 focus:ring-[#d4a373]/20"
                            />
                        </div>

                        <div class="space-y-2">
                            <label for="pontos_compra" class="block text-sm font-semibold text-slate-700">Pontos de compra</label>
                            <input
                                id="pontos_compra"
                                name="pontos_compra"
                                type="number"
                                min="0"
                                value="{{ old('pontos_compra', 0) }}"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#d4a373] focus:ring-2 focus:ring-[#d4a373]/20"
                            />
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label for="pontos_resgate" class="block text-sm font-semibold text-slate-700">Pontos de resgate</label>
                            <input
                                id="pontos_resgate"
                                name="pontos_resgate"
                                type="number"
                                min="0"
                                value="{{ old('pontos_resgate', 0) }}"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#d4a373] focus:ring-2 focus:ring-[#d4a373]/20"
                            />
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">
                        <a href="{{ route('produtos') }}" class="inline-flex items-center justify-center rounded-3xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            Cancelar
                        </a>

                        <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-[#2a1b17] px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-900">
                            <span class="material-symbols-outlined mr-2 text-[18px]">save</span>
                            Salvar Produto
                        </button>
                    </div>
                </form>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-slate-900">Resumo do cadastro</h3>
                    <p class="mt-2 text-sm text-slate-500">Os dados são enviados diretamente para o model <strong class="font-semibold text-slate-900">Produto</strong>.</p>

                    <div class="mt-5 space-y-3">
                        <div class="rounded-2xl bg-slate-50 px-4 py-3">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Campos principais</p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">Nome, descrição, preço e pontos</p>
                        </div>
                        <div class="rounded-2xl bg-[#faedcd] px-4 py-3 text-[#7d562d]">
                            <p class="text-xs uppercase tracking-[0.2em] text-[#9c6c4a]">Validação</p>
                            <p class="mt-1 text-sm font-semibold">O formulário exige valores numéricos válidos e não negativos.</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3 text-slate-900">
                        <span class="material-symbols-outlined text-2xl text-amber-600">inventory_2</span>
                        <h3 class="text-lg font-semibold">Fluxo</h3>
                    </div>

                    <ol class="mt-4 space-y-3 text-sm text-slate-600">
                        <li class="rounded-2xl bg-slate-50 px-4 py-3">1. Preencha os dados do produto.</li>
                        <li class="rounded-2xl bg-slate-50 px-4 py-3">2. Envie o formulário para o controller.</li>
                        <li class="rounded-2xl bg-slate-50 px-4 py-3">3. O item é persistido na tabela <strong class="font-semibold text-slate-900">produtos</strong>.</li>
                    </ol>
                </div>
            </aside>
        </section>
    </div>
</x-app-layout>