@props([
    'brand' => 'Cafélo',
    'subtitle' => 'Terminal de Admin',
])

@php
    $items = [
        ['label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('dashboard'), 'active' => request()->routeIs('dashboard')],
        ['label' => 'Perfil', 'icon' => 'person', 'href' => route('perfil'), 'active' => request()->routeIs('perfil')],
        ['label' => 'Produtos', 'icon' => 'inventory_2', 'href' => route('produtos'), 'active' => request()->routeIs('produtos')],
        ['label' => 'Clientes', 'icon' => 'group', 'href' => '#', 'active' => false],
        ['label' => 'Vendas', 'icon' => 'point_of_sale', 'href' => route('registro-devendas'), 'active' => request()->routeIs('registro-devendas')],
        ['label' => 'Resgates', 'icon' => 'redeem', 'href' => '#', 'active' => false],
        ['label' => 'Histórico', 'icon' => 'history', 'href' => route('dashboard.historico-vendas'), 'active' => request()->routeIs('dashboard.historico-vendas')],
    ];
@endphp

<aside class="fixed left-0 top-0 flex h-full w-[280px] flex-col bg-[#2a1b17] text-white shadow-[0_20px_70px_rgba(42,27,23,0.35)]">

    <div class="p-6">
        <h1 class="text-2xl font-bold tracking-wide">
            {{ $brand }}
        </h1>

        <p class="text-sm text-[#d9c6b8]">
            {{ $subtitle }}
        </p>
    </div>

    <nav class="mt-2 flex-1 space-y-1 px-3">

        @foreach ($items as $item)

            <a
                href="{{ $item['href'] }}"
                @class([
                    'flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-colors',
                    'bg-white/10 text-white shadow-inner' => $item['active'],
                    'text-white/70 hover:bg-white/5 hover:text-white' => ! $item['active'],
                ])
            >
                <span class="material-symbols-outlined text-[20px]">
                    {{ $item['icon'] }}
                </span>
                <span>
                    {{ $item['label'] }}
                </span>
            </a>

        @endforeach

    </nav>

    <div class="p-4">

        <button class="w-full rounded-xl bg-[#d4a373] px-4 py-3 text-sm font-semibold text-[#2a1b17] transition-colors hover:bg-[#e0b27f]">
            Nova Venda
        </button>

    </div>

    <div class="space-y-1 p-3">

        <a href="{{ route('configuracoes') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-white/70 transition-colors hover:bg-white/5 hover:text-white">
            <span class="material-symbols-outlined text-[20px]">settings</span>
            <span>Configurações</span>
        </a>

        <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-white/70 transition-colors hover:bg-white/5 hover:text-white">
            <span class="material-symbols-outlined text-[20px]">logout</span>
            <span>Sair</span>
        </a>

    </div>

</aside>