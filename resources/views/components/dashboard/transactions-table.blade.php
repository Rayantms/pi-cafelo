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
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-medium text-slate-900">#TX-89234</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img class="h-10 w-10 rounded-full border border-slate-200 object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_jT9-v6waUQMpyWi90sTgFt2s6_wuMScFGUacSkTNPmbjPqNiSG0FNEUSRbmzyF_RbH2nucewuA7PK2tMoum_FLBAdHFERuP11SqhKmobhp6yAiXDow-4Ft5D-Y8HyXPnxFKKFaOzW6USFrO3-GlyhVt_S5zzBzcgikVsLRU1PrLwRLapuzw6jBVdtMH-nKrWCUHtBSxYr4TPqAWr2b4chx9cvoY7o-jcnrTOYJj3AKJEQKI59exmy4J9Zie5y4SeXtgJfQ0ZqoU8" alt="Avatar Cliente">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Mariana Silva</p>
                                <p class="text-xs text-slate-500">mariana.s@email.com</p>
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
                        <div class="text-slate-700">15 Out, 2023</div>
                        <div class="text-xs text-slate-500">14:32</div>
                    </td>
                    <td class="px-6 py-4 text-right font-semibold text-slate-900">R$ 45,00</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Concluído</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-600 transition hover:bg-slate-100">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-medium text-slate-900">#TX-89235</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img class="h-10 w-10 rounded-full border border-slate-200 object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDtujia6AL14_XiRkp3ApBvWGQZmYcfG05x-ww8q-C8Oh4S2pmnlQQG0FdKocw-JZADdT5prkWS_Zese-vQLC6w1XNulASwYI_r_RfMy1jhfoOad4KZNGzvVhQ2OfcDwu10sPtaCny4vjjrFnyKlylMjkWM8orw-A0LHEp0prn8g0U50TdL-RbZrGjxPl1xAnM2RNmD-t1WCl6DeGFCPbFqFyyNn0grnf_ZxBMlsAFkdWo-jGkg85VY0TTAS9rmHmCti3_IhSRvDETN" alt="Avatar Cliente">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Ricardo Santos</p>
                                <p class="text-xs text-slate-500">rsantos@mail.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="inline-flex items-center gap-2 text-slate-700">
                            <span class="material-symbols-outlined text-amber-700">redeem</span>
                            Resgate
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-slate-700">15 Out, 2023</div>
                        <div class="text-xs text-slate-500">14:15</div>
                    </td>
                    <td class="px-6 py-4 text-right font-semibold text-slate-900">-150 pts</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Concluído</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-600 transition hover:bg-slate-100">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-medium text-slate-900">#TX-89236</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img class="h-10 w-10 rounded-full border border-slate-200 object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB5BomgrHRLUE0jr02ZwS3OXU19MCXPE93tUavBEhbKlC3LCftY8p7cbRlw9LO3WcizN8yHMorKT_GWtGN-fGjd7DRGfoBU3hXo_lVB5Cagc3U5XKJPF8IK0cQbGzcHAvIsq9UAK_KTjXurU6zQynq2oMQJXFJTOPFFd7-uiaJNMX3I8knxOVFeovOQPr3duOUhfqTfdhmLpwTVXBhwFgtJvDTIhNK6aoHvqRNZbEdfakKmgqvF4Nyax2J-lx5RhDfLe-Khsq73CPGj" alt="Avatar Cliente">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">André Costa</p>
                                <p class="text-xs text-slate-500">andre.costa@provider.br</p>
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
                        <div class="text-slate-700">15 Out, 2023</div>
                        <div class="text-xs text-slate-500">13:58</div>
                    </td>
                    <td class="px-6 py-4 text-right font-semibold text-slate-900">R$ 12,50</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">Pendente</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-600 transition hover:bg-slate-100">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-medium text-slate-900">#TX-89237</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img class="h-10 w-10 rounded-full border border-slate-200 object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB4vV_5rQ5VH4CfEWA9_5ipZASsftoLr4v3U4g9WSwkhTazpI_qyHKZNaIwdpiVQ65dBgcnNQwXj6klyQKmffsDv-VId3HimmpvmbrD-6CpSvYQ1ldHT5QloPkf3AXz_s8NjZwJ4yG1NT8SyFXOxuwOq8n7JCSfJ6ESQOhROnl3-Mi16bnzn2cTTgez_TvtYAMfLifR6DUsBN2dux-0nLnt62so_vO5YbUSgLBGfG4KOfNdq_VVKY0Q3qfsm8CVfhHQ1ZP8eSXGZ4pT" alt="Avatar Cliente">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Lucia Ferreira</p>
                                <p class="text-xs text-slate-500">lferreira@email.com</p>
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
                        <div class="text-slate-700">15 Out, 2023</div>
                        <div class="text-xs text-slate-500">12:44</div>
                    </td>
                    <td class="px-6 py-4 text-right font-semibold text-slate-900">R$ 89,90</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">Cancelado</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 text-slate-600 transition hover:bg-slate-100">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex flex-col gap-4 border-t border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm text-slate-600">Mostrando 1 a 10 de 1.450 transações</p>
        <div class="flex flex-wrap items-center gap-2">
            <button class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100" disabled>
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-950 text-white">1</button>
            <button class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100">2</button>
            <button class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100">3</button>
            <span class="px-2 text-sm text-slate-500">...</span>
            <button class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100">145</button>
            <button class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
    </div>
</div>
