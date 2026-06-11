<x-app-layout titulo="Resgates">
    <div class="space-y-10">
        <div class="flex flex-col gap-6 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Perfil do Cliente</h1>
                <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600">
                    Gerencie os pontos e resgates de <strong class="font-semibold text-slate-900">Mariana Silva</strong>.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-3 rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4">
                <span class="text-xs uppercase tracking-[0.2em] text-slate-500">ID do Cliente</span>
                <span class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white">#GF-8492</span>
            </div>
        </div>

        <section class="rounded-[2rem] bg-amber-50 px-8 py-8 shadow-sm">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-xl">
                    <div class="inline-flex items-center gap-3 rounded-full bg-amber-100 px-4 py-2 text-sm font-semibold text-amber-800">
                        <span class="material-symbols-outlined text-xl">stars</span>
                        Saldo Atual
                    </div>
                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <span class="text-sm font-medium text-slate-700">Você possui</span>
                        <span class="text-5xl font-bold text-amber-700">450</span>
                        <span class="text-lg font-semibold text-amber-700">pontos</span>
                    </div>

                    <div class="mt-8 max-w-md space-y-3">
                        <div class="flex items-center justify-between text-sm text-slate-600">
                            <span>Status: Ouro</span>
                            <span>Faltam 50 para Platina</span>
                        </div>
                        <div class="overflow-hidden rounded-full bg-amber-100">
                            <div class="h-2 w-[90%] rounded-full bg-amber-600"></div>
                        </div>
                    </div>
                </div>

                <div class="rounded-[1.75rem] border border-white/80 bg-white p-6 text-center shadow-sm">
                    <span class="block text-xs uppercase tracking-[0.24em] text-slate-500">Próxima Expiração</span>
                    <span class="mt-4 block text-3xl font-semibold text-slate-900">120 pts</span>
                    <span class="mt-1 block text-sm text-slate-500">em 30 Nov 2023</span>
                </div>
            </div>
        </section>

        <section class="space-y-6">
            <div class="flex flex-col gap-4 border-b border-slate-200 pb-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3 text-slate-900">
                    <span class="material-symbols-outlined text-2xl text-amber-600">local_mall</span>
                    <h2 class="text-xl font-semibold">Disponível para Resgate</h2>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                <span class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Filtrar por categoria</span>
                <button type="button" data-filter="all" class="redeem-filter-button rounded-full border border-slate-300 bg-white px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-50">Todos</button>
                <button type="button" data-filter="cafe" class="redeem-filter-button rounded-full border border-slate-300 bg-white px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-50">Cafés</button>
                <button type="button" data-filter="acessorio" class="redeem-filter-button rounded-full border border-slate-300 bg-white px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-50">Acessórios</button>
            </div>
        </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <x-redeem-card
                    title="Café Especial Cerrado Mineiro 250g"
                    description="Notas de chocolate ao leite, caramelo e nozes para espresso ou coado."
                    points="300"
                    image="https://lh3.googleusercontent.com/aida-public/AB6AXuBWnVf5Bf-nhZd6qKwixka8dSbjXZzN7xGZ4BEZR4whohJ2krNXIIj0nVRG9FunuGJHEPfAtGAww54rM70uASfGqYLi3fh8MIshlIrMDux9Gwm4KAD9_mPaiz0CYGpf381VKUvb9tJmlVS2JR5sXvm4uhkEk_ph8pk6jiAxUiaGCxFQhrhs-B_FphiaUbbXMisTTxLv4zjQJEVvS0NGS7C2RbQ_kBrjTqxuV3M8X77mBSGVwztdXit7kBVirNjT-9dCOH9KWr8xKqaz"
                    badge="Popular"
                    category="cafe"
                />

                <x-redeem-card
                    title="Caneca Artesanal Grão"
                    description="Caneca de cerâmica feita à mão com design exclusivo para manter a temperatura do café."
                    points="400"
                    image="https://lh3.googleusercontent.com/aida-public/AB6AXuAzlde3qSew17Hplv9CrRtiIlj9zBde_zxs2n8MW8VI6nJyWFIjp0zQ2DoRwZSYWmjrRdFNKWugK4jAVhcEdv1NknYrXzSPFFmN-OL-zskWqRrKij3eRPhY3SFJ2jusXH0VznyF7tfDiMohJWVvBjW8h28uAqSTypdZ4xyUJzYw_8xdTAL1UQPSeX2Z9okSgXJizd_vJlYkSOpv0mOCO0o4wR2mlqmMxnXGkTuJLu52USAo4Kd-hm-BJCsQocEwzFV4XvWE63bRCfEZ"
                    category="acessorio"
                />

                <x-redeem-card
                    title="Kit Barista Profissional"
                    description="Kit completo com tamper, balança de precisão e pitcher para elevar a prática do café."
                    points="600"
                    image="https://lh3.googleusercontent.com/aida-public/AB6AXuBHKLqW_K-nFPD0fBxMtWGaw-AEctC2NKaBGYdZfBfJVn4zxowQQ9DWDA0gQUpoPV2HHnEE8QpZvfHrXFcIPWr0AJQlFEMx1et_LTn88mUw1bcQywbOqY0v-_iBdv86XonRsu8m2YvGkoMB9U56Cnbcfny3iQ8Xfw4fj_m0Z1bmjI33SQfIjkadKhU2cltwvFfGltG-nKsg-AyY_Q5JbdkaHjuzzZJd0_YXxppeU9rJZ-TXjYpTedKFXsAdjDQ8gt5juVhdjNOZINzv"
                    disabled
                    category="acessorio"
                />

                <x-redeem-card
                    title="Filtros de Papel V60 - 100 un"
                    description="Filtros japoneses para Hario V60 tamanho 02, garantindo extração limpa."
                    points="150"
                    image="https://lh3.googleusercontent.com/aida-public/AB6AXuAcgqOIuzAmYmbElqPJdbsV5VGSltHSkgGg_XI9ivw0hE4jNLJy-W191BKsxLbiDdSkUF3Ts0sosd3FJiI91961nDV_Oecvy2OeWNyAVqFK4NX9vetqLMW1PD_9BifhQ5XmV8B_NJM_PmP25y-xI9emVNdO2dHujU6KB3ThF6cTGuQoBgnVYtxGOhq51vNNiMyLTBadAbN8xZUQ3cxwPJOuan9arEgmKoqMOmJ8egliDsePwMO9-TpKyem-ZOZDRJhj7T93eDonhHLC"
                    category="acessorio"
                />
            </div>
        </section>
    </div>

    <script>
        (function(){
            try {
                const buttons = document.querySelectorAll('.redeem-filter-button');
                const cards = document.querySelectorAll('[data-category]');
                if (!buttons.length || !cards.length) return;

                function setActive(btn) {
                    buttons.forEach(b => {
                        b.classList.remove('bg-amber-600','text-white');
                        b.classList.add('bg-white','border-slate-300');
                    });
                    btn.classList.remove('bg-white','border-slate-300');
                    btn.classList.add('bg-amber-600','text-white');
                }

                function applyCategory(category) {
                    cards.forEach(card => {
                        const cardCategory = card.dataset.category;
                        const matches = category === 'all' || cardCategory === category;
                        card.style.display = matches ? '' : 'none';
                    });
                }

                buttons.forEach(button => {
                    button.addEventListener('click', () => {
                        const filter = button.dataset.filter || 'all';
                        setActive(button);
                        applyCategory(filter);
                    });
                });

                const defaultBtn = document.querySelector('.redeem-filter-button[data-filter="all"]');
                if (defaultBtn) {
                    setActive(defaultBtn);
                    applyCategory('all');
                }
            } catch (e) {
                console.warn('Redeem filter fallback failed', e);
            }
        })();
    </script>

</x-app-layout>
