<x-app-layout titulo="Registro de Vendas">
    <div class="space-y-8">
        <section class="overflow-hidden rounded-3xl bg-gradient-to-br from-[#2a1b17] via-[#4e342e] to-[#7d562d] p-8 text-white shadow-[0_24px_80px_rgba(42,27,23,0.18)]">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs uppercase tracking-[0.35em] text-[#f2ddcf]">Terminal PDV</p>
                    <h1 class="mt-3 text-3xl font-bold lg:text-4xl">Registro de Venda</h1>
                    <p class="mt-3 text-sm leading-6 text-white/75">Venda rápida de produtos com cadastro de cliente e cálculo de pontos. Use a lista de produtos para adicionar itens ao carrinho.</p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-semibold text-[#2a1b17] transition-transform hover:-translate-y-0.5">
                        <span class="material-symbols-outlined text-[18px]">point_of_sale</span>
                        Nova Venda
                    </button>
                </div>
            </div>
        </section>

        <div class="grid gap-6 xl:grid-cols-[1.6fr_1fr]">
            <section class="rounded-3xl bg-slate-50 p-6 shadow-sm">
                <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-slate-900">Catálogo de Produtos</h2>
                        <p class="mt-2 text-sm text-slate-500">Busque pelo nome ou código e escolha o produto para incluir no carrinho.</p>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="relative rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm focus-within:border-[#D4A373] focus-within:ring-2 focus-within:ring-[#D4A373]/20">
                            <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                                <span class="material-symbols-outlined">search</span>
                            </div>
                            <input
                                type="text"
                                placeholder="Buscar produtos por nome ou código..."
                                class="w-full border-none bg-transparent pl-11 text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none"
                            />
                        </div>
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse($produtos as $produto)
                    <article class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1" onclick="addToCart('{{ $produto->nome }}', {{ $produto->preco }}, {{ $produto->pontos_compra }})">
                        <div class="relative h-40 bg-slate-100">
                            <div class="h-full w-full object-cover flex items-center justify-center text-slate-400 text-xs">
                                <span>Sem imagem</span>
                            </div>
                            <span class="absolute top-3 right-3 inline-flex items-center gap-1 rounded-full bg-[#FAEDCD] px-2 py-1 text-xs font-semibold text-[#6e4a26]">
                                <span class="material-symbols-outlined text-[14px]">star</span>
                                +{{ $produto->pontos_compra }} pts
                            </span>
                        </div>
                        <div class="space-y-3 p-4">
                            <div>
                                <h3 class="text-base font-semibold text-slate-900">{{ $produto->nome }}</h3>
                                <p class="text-sm text-slate-500">{{ $produto->descricao ?? '-' }}</p>
                            </div>
                            <div class="flex items-center justify-between gap-3">
                                <strong class="text-lg text-[#2a1b17]">R$ {{ number_format($produto->preco, 2, ',', '.') }}</strong>
                                <button class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-[#2a1b17] transition group-hover:bg-[#D4A373] group-hover:text-white">
                                    <span class="material-symbols-outlined">add</span>
                                </button>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-slate-500 text-sm">Nenhum produto disponível no momento.</p>
                    </div>
                    @endforelse
                </div>
            </section>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-slate-900">Vincular Cliente</h3>
                    <p class="mt-2 text-sm text-slate-500">Busque por CPF ou e-mail para associar o cliente à venda.</p>

                    <div class="mt-4 relative rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 shadow-sm focus-within:border-[#D4A373] focus-within:ring-2 focus-within:ring-[#D4A373]/20">
                        <label class="absolute -top-2 left-4 bg-white px-1 text-[10px] uppercase tracking-[0.18em] text-slate-500">CPF ou E-mail</label>
                        <input
                            type="text"
                            placeholder="Digite para buscar..."
                            class="w-full border-none bg-transparent text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none"
                        />
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 text-[#D4A373] transition hover:text-[#9c6c4a]">
                            <span class="material-symbols-outlined">search</span>
                        </button>
                    </div>

                    <p class="mt-4 text-sm italic text-slate-500">Nenhum cliente vinculado.</p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 bg-[#FAEDCD]/70 p-5">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-2 text-slate-900">
                                <span class="material-symbols-outlined">shopping_cart</span>
                                <h3 class="text-lg font-semibold">Carrinho</h3>
                            </div>
                            <span id="cart-count" class="rounded-full bg-[#2a1b17] px-3 py-1 text-xs font-semibold text-white">0 itens</span>
                        </div>
                    </div>

                    <div id="cart-items" class="space-y-4 p-5">
                        <!-- Itens do carrinho serão injetados aqui via JavaScript -->
                    </div>

                    <div class="rounded-b-3xl bg-slate-50 p-5">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between text-sm text-slate-600">
                                <span>Subtotal</span>
                                <span id="subtotal">R$ 0,00</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-slate-600">
                                <span>Descontos</span>
                                <span>R$ 0,00</span>
                            </div>
                        </div>

                        <div class="mt-4 rounded-3xl border border-[#D4A373]/25 bg-[#EFF5EF] p-4">
                            <div class="flex items-center justify-between text-sm font-semibold text-[#2a1b17]">
                                <span class="inline-flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">stars</span>
                                    Pontos a Creditar
                                </span>
                                <span id="points-credit" class="text-lg font-bold text-[#6e4a26]">+0</span>
                            </div>
                        </div>

                        <div class="mt-4 flex items-end justify-between gap-4">
                            <div>
                                <p class="text-sm text-slate-600">Total</p>
                                <p id="total" class="text-3xl font-bold text-slate-900">R$ 0,00</p>
                            </div>
                            <button class="rounded-3xl bg-[#D4A373] px-6 py-4 text-sm font-semibold text-white transition hover:bg-[#c39160]">
                                <span class="material-symbols-outlined align-middle">payments</span>
                                Finalizar Venda
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #d4c3bf;
            border-radius: 9999px;
        }
        .focus-ring-bronze:focus-within {
            border-color: #D4A373;
            box-shadow: 0 0 0 2px rgba(212, 163, 115, 0.2);
        }
    </style>

    <script>
        /*
            Implementação do carrinho em JS puro.
            Funções públicas exigidas:
            - adicionarProduto()
            - removerProduto()
            - atualizarCarrinho()
            - calcularTotal()

            Também expõe uma função global `addToCart(name, price, points)` para compatibilidade
            com os botões existentes que chamam `addToCart(...)` via onclick.
        */

        // Estado do carrinho: mapa productId -> item
        const carrinho = {};

        // Helper: gera um id a partir do nome (slug simples)
        function gerarId(nome) {
            return String(nome).toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        }

        // adicionarProduto: aceita Event (botões que têm data-attributes) ou productId (string)
        function adicionarProduto(arg) {
            // Se veio um ID (string), incrementa quantidade do item existente
            if (typeof arg === 'string') {
                const id = arg;
                if (!carrinho[id]) return;
                carrinho[id].quantidade += 1;
                atualizarCarrinho();
                return;
            }

            // Se for um Event (botão com data-*), extrai dados do dataset
            const btn = arg.currentTarget || arg.target;
            const id = btn.dataset.id || gerarId(btn.dataset.nome || 'produto');
            const nome = btn.dataset.nome || btn.dataset.nome || 'Produto';
            const preco = parseFloat((btn.dataset.preco || '0').toString().replace(',', '.')) || 0;
            const pontos = parseInt(btn.dataset.pontos || '0', 10) || 0;

            if (carrinho[id]) {
                carrinho[id].quantidade += 1;
            } else {
                carrinho[id] = { id, nome, preco, pontos, quantidade: 1 };
            }

            atualizarCarrinho();
        }

        // removerProduto: decrementa quantidade; remove item se quantidade <= 0
        function removerProduto(id) {
            if (!carrinho[id]) return;
            carrinho[id].quantidade -= 1;
            if (carrinho[id].quantidade <= 0) delete carrinho[id];
            atualizarCarrinho();
        }

        // calcularTotal: retorna soma de preco * quantidade
        function calcularTotal() {
            return Object.values(carrinho).reduce((acc, item) => acc + (item.preco * item.quantidade), 0);
        }

        // atualizarCarrinho: redesenha a lista, contadores e totais
        function atualizarCarrinho() {
            const container = document.getElementById('cart-items');
            const cartCount = document.getElementById('cart-count');
            const subtotalEl = document.getElementById('subtotal');
            const totalEl = document.getElementById('total');
            const pointsEl = document.getElementById('points-credit');

            // Garante referências
            if (!container || !cartCount || !subtotalEl || !totalEl || !pointsEl) return;

            container.innerHTML = '';
            let itensCount = 0;
            let pontosTotais = 0;

            Object.values(carrinho).forEach(item => {
                itensCount += item.quantidade;
                pontosTotais += (item.pontos || 0) * item.quantidade;

                const linha = document.createElement('div');
                linha.className = 'rounded-3xl border border-slate-200 bg-slate-50 p-4';
                linha.innerHTML = `
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="font-medium text-slate-900">${item.nome}</p>
                            <p class="mt-1 text-xs text-slate-500">+${item.pontos} pts</p>
                        </div>
                        <div class="flex items-center gap-2 rounded-2xl border border-slate-300 bg-white px-2 py-1 text-slate-700">
                            <button data-action="remove" data-id="${item.id}"><span class="material-symbols-outlined text-[16px]">remove</span></button>
                            <span class="font-medium">${item.quantidade}</span>
                            <button data-action="add" data-id="${item.id}"><span class="material-symbols-outlined text-[16px]">add</span></button>
                        </div>
                    </div>
                    <div class="mt-4 text-right text-sm font-semibold text-slate-900">R$ ${item.preco.toFixed(2).replace('.',',')}</div>
                `;

                container.appendChild(linha);
            });

            cartCount.textContent = `${itensCount} ${itensCount === 1 ? 'item' : 'itens'}`;

            const subtotal = calcularTotal();
            subtotalEl.textContent = `R$ ${subtotal.toFixed(2).replace('.',',')}`;
            totalEl.textContent = `R$ ${subtotal.toFixed(2).replace('.',',')}`;
            pointsEl.textContent = `+${pontosTotais}`;

            // Delegação: conecta botões add/remove recém-criados
            container.querySelectorAll('button[data-action]').forEach(btn => {
                const action = btn.dataset.action;
                const id = btn.dataset.id;
                btn.onclick = () => {
                    if (action === 'add') adicionarProduto(id);
                    if (action === 'remove') removerProduto(id);
                };
            });
        }

        // Wrapper global para compatibilidade com onclick="addToCart(name, price, points)"
        function addToCart(name, price, points) {
            // Gera id simples a partir do nome
            const id = gerarId(name);

            // Se já existe, incrementa
            if (carrinho[id]) {
                carrinho[id].quantidade += 1;
            } else {
                const preco = parseFloat(String(price).replace(',', '.')) || 0;
                const pts = parseInt(points || 0, 10) || 0;
                carrinho[id] = { id, nome: name, preco, pontos: pts, quantidade: 1 };
            }

            atualizarCarrinho();
        }

        // Inicialização: conecta botões que possam ter data-attributes (compatibilidade futura)
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('button[data-id][data-nome][data-preco]').forEach(btn => {
                btn.addEventListener('click', adicionarProduto);
            });

            // Desenha estado inicial
            atualizarCarrinho();
        });
    </script>
</x-app-layout>
