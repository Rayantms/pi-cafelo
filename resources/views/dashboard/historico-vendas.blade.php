<x-app-layout titulo="Histórico de Vendas">

    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <h2 class="text-3xl font-semibold tracking-tight text-slate-900">Histórico de Transações</h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">Gerencie e audite todas as movimentações financeiras e de pontos da sua cafeteria.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2 rounded-3xl border border-slate-200 bg-white/90 p-1 shadow-sm">
            <button class="rounded-3xl bg-slate-950 px-4 py-2 text-sm font-semibold text-white shadow-sm">Hoje</button>
            <button class="rounded-3xl px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100">7 dias</button>
            <button class="rounded-3xl px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100">30 dias</button>
            <button class="inline-flex items-center gap-2 rounded-3xl px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100">
                <span class="material-symbols-outlined text-base">calendar_today</span>
                Personalizado
            </button>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
        <div class="glass-card relative overflow-hidden rounded-[28px] p-6 shadow-lg transition-transform duration-300 hover:-translate-y-0.5 hover:shadow-xl">
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-amber-100 blur-3xl"></div>
            <div class="flex items-center justify-between gap-4">
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-amber-100 text-amber-700 shadow-sm">
                    <span class="material-symbols-outlined">payments</span>
                </div>
                <div class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700">+12%</div>
            </div>
            <div class="mt-6">
                <p class="text-sm font-medium text-slate-500">Total de Vendas</p>
                <h3 class="mt-3 text-3xl font-semibold text-slate-900">R$ 12.450,80</h3>
            </div>
        </div>

        <div class="glass-card relative overflow-hidden rounded-[28px] p-6 shadow-lg transition-transform duration-300 hover:-translate-y-0.5 hover:shadow-xl">
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-yellow-100 blur-3xl"></div>
            <div class="flex items-center justify-between gap-4">
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-yellow-100 text-yellow-700 shadow-sm">
                    <span class="material-symbols-outlined">stars</span>
                </div>
                <div class="rounded-full bg-amber-100 px-3 py-1 text-sm font-medium text-amber-700">Média 450/dia</div>
            </div>
            <div class="mt-6">
                <p class="text-sm font-medium text-slate-500">Pontos Creditados</p>
                <h3 class="mt-3 text-3xl font-semibold text-slate-900">45.200 <span class="text-base font-normal text-slate-600">pts</span></h3>
            </div>
        </div>

        <div class="glass-card relative overflow-hidden rounded-[28px] p-6 shadow-lg transition-transform duration-300 hover:-translate-y-0.5 hover:shadow-xl">
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-red-100 blur-3xl"></div>
            <div class="flex items-center justify-between gap-4">
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-red-100 text-red-700 shadow-sm">
                    <span class="material-symbols-outlined">redeem</span>
                </div>
                <div class="rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-600">85 hoje</div>
            </div>
            <div class="mt-6">
                <p class="text-sm font-medium text-slate-500">Resgates Realizados</p>
                <h3 class="mt-3 text-3xl font-semibold text-slate-900">1.240</h3>
            </div>
        </div>
    </div>

    <x-dashboard.transactions-table />

</x-app-layout>
