<div class="overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-lg">
    <div class="flex flex-col gap-4 border-b border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
        <h3 class="text-xl font-semibold text-slate-900">Transações Recentes</h3>
        <div class="flex items-center gap-2">
            <button class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100">
                <span class="material-symbols-outlined">filter_list</span>
            </button>
            <button class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100">
                <span class="material-symbols-outlined">download</span>
            </button>
        </div>
    </div>

    <div class="overflow-x-auto px-6 pb-6">
            @php
                use App\Models\Venda;
                use Carbon\Carbon;

                $vendas = Venda::with('cliente')->latest()->take(50)->get();
            @endphp

            <table class="min-w-[900px] w-full border-separate border-spacing-0 text-left">
                <thead class="bg-slate-100 text-slate-500">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-[0.2em]">ID</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-[0.2em]">Cliente</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-[0.2em]">Tipo</th>
                        <th class="px-6 py-4 text-sm font-semibold uppercase tracking-[0.2em]">Data e Hora</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold uppercase tracking-[0.2em]">Valor/Pontos</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-[0.2em]">Status</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-[0.2em]">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white text-sm text-slate-700">
                    @forelse($vendas as $venda)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium text-slate-900">#{{ $venda->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">{{ optional($venda->cliente)->nome ?? '—' }}</p>
                                        <p class="text-xs text-slate-500">{{ optional($venda->cliente)->email ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="inline-flex items-center gap-2 text-slate-700">
                                    <span class="material-symbols-outlined text-amber-600">shopping_bag</span>
                                    Venda
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-700">{{ Carbon::parse($venda->created_at)->format('d M, Y') }}</div>
                                <div class="text-xs text-slate-500">{{ Carbon::parse($venda->created_at)->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 text-right font-semibold text-slate-900">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Concluído</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('registro-de-vendas') }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-600 transition hover:bg-slate-100">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-6 text-center text-sm text-slate-500">Nenhuma venda registrada ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col gap-4 border-t border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-slate-600">Mostrando {{ $vendas->count() }} transações</p>
            <div class="flex flex-wrap items-center gap-2">
                <button class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100" disabled>
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-950 text-white">1</button>
                <button class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100">2</button>
                <button class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100">3</button>
                <span class="px-2 text-sm text-slate-500">...</span>
                <button class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100">1</button>
                <button class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
