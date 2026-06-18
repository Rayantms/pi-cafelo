<div class="overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-lg">
    <div class="flex flex-col gap-4 border-b border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
        <h3 class="text-xl font-semibold text-slate-900">Transações Recentes</h3>
        <div class="flex items-center gap-2">
            <button id="transactionsFilterBtn" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100" title="Mostrar todos">
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
                use App\Models\Resgate;
                use Carbon\Carbon;

                $vendas = Venda::with('cliente')->latest()->get()->map(function($v) {
                    return [
                        'id' => $v->id,
                        'cliente' => optional($v->cliente)->nome ?? '—',
                        'email' => optional($v->cliente)->email ?? '',
                        'tipo' => 'Venda',
                        'created_at' => $v->created_at,
                        'valor_str' => 'R$ '.number_format($v->valor_total, 2, ',', '.'),
                        'status' => 'Concluído',
                        'action_url' => route('registro-de-vendas'),
                    ];
                });

                $resgates = Resgate::with('cliente')->latest()->get()->map(function($r) {
                    return [
                        'id' => $r->id,
                        'cliente' => optional($r->cliente)->nome ?? '—',
                        'email' => optional($r->cliente)->email ?? '',
                        'tipo' => 'Resgate',
                        'created_at' => $r->created_at,
                        'valor_str' => '-' . number_format($r->pontos_utilizados, 0, ',', '.') . ' pts',
                        'status' => 'Concluído',
                        'action_url' => route('resgates'),
                    ];
                });

                $transacoes = $vendas->concat($resgates)->sortByDesc('created_at')->values()->take(50);
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
                    @forelse($transacoes as $t)
                        <tr class="hover:bg-slate-50" data-tipo="{{ $t['tipo'] }}">
                            <td class="px-6 py-4 font-medium text-slate-900">#{{ $t['id'] }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">{{ $t['cliente'] }}</p>
                                        <p class="text-xs text-slate-500">{{ $t['email'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="inline-flex items-center gap-2 text-slate-700">
                                    <span class="material-symbols-outlined text-{{ $t['tipo'] === 'Venda' ? 'amber' : 'red' }}-600">{{ $t['tipo'] === 'Venda' ? 'shopping_bag' : 'redeem' }}</span>
                                    {{ $t['tipo'] }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-700">{{ Carbon::parse($t['created_at'])->format('d M, Y') }}</div>
                                <div class="text-xs text-slate-500">{{ Carbon::parse($t['created_at'])->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 text-right font-semibold text-slate-900">{{ $t['valor_str'] }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">{{ $t['status'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ $t['action_url'] }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-600 transition hover:bg-slate-100">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-6 text-center text-sm text-slate-500">Nenhuma transação registrada ainda.</td>
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

    <script>
        (function () {
            const btn = document.getElementById('transactionsFilterBtn');
            if (!btn) return;

            const states = ['all', 'Venda', 'Resgate'];
            let idx = 0;

            const container = btn.closest('.overflow-x-auto');
            const tbody = container ? container.querySelector('tbody') : null;

            function applyFilter() {
                const state = states[idx];
                btn.title = state === 'all' ? 'Mostrar todos' : 'Filtrar: ' + state;
                if (!tbody) return;
                Array.from(tbody.querySelectorAll('tr')).forEach(row => {
                    const tipo = row.dataset.tipo || '';
                    row.style.display = (state === 'all' || tipo === state) ? '' : 'none';
                });
            }

            btn.addEventListener('click', function () {
                idx = (idx + 1) % states.length;
                applyFilter();
            });

            // initialize
            applyFilter();
        })();
    </script>
