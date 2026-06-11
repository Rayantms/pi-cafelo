@props([
    'titulo' => 'Dashboard',
])

<header class="sticky top-0 z-40 bg-white/90 border-b border-slate-200 backdrop-blur-sm">
    <div class="mx-auto flex h-16 max-w-[1450px] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-1">
            <span class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Painel</span>
            <h2 class="text-2xl font-semibold text-slate-900">{{ $titulo }}</h2>
        </div>

        <div class="hidden grow items-center gap-3 lg:flex">
            <div class="relative w-full max-w-sm">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input
                    type="text"
                    placeholder="Buscar transação..."
                    class="w-full rounded-full border border-slate-200 bg-white/95 py-2 pl-11 pr-4 text-sm text-slate-700 shadow-sm focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-200"
                />
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button class="flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:bg-slate-50">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <button class="flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:bg-slate-50">
                <span class="material-symbols-outlined">help</span>
            </button>
            <div class="h-11 w-11 overflow-hidden rounded-full border border-slate-200 bg-white shadow-sm">
                <img
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBePPFK9uX28LmcF6QdnzS55B_8fqjKGisn3KZt72EbFprWgXHCvJPb0ba9tfGufGELxfHMnIuFYiyipG1ZARaVC0HpGZCzuZOLgefMSJnumJY4RF3AZEsvV013cCEk0of_kSkt-kzr24WArdmHP12ojNyNhZROenxKO6ymurSzeig5dN_I-yS7nTIkJeaDX4ncU84CIxZ0czp2dH1HVpMY5__dNGNBDcRQkGhGK3hcJfoXhovpUYzB_UbSAv9sGWC2_QhycvGUm5dN"
                    alt="Foto de Perfil do Administrador"
                    class="h-full w-full object-cover"
                />
            </div>
        </div>

    </div>
</header>