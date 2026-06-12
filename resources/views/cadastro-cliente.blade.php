<x-app-layout titulo="Cadastro de Cliente">
    <div class="space-y-8">
        <section class="overflow-hidden rounded-3xl bg-gradient-to-br from-[#2a1b17] via-[#4e342e] to-[#7d562d] p-8 text-white shadow-[0_24px_80px_rgba(42,27,23,0.18)]">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs uppercase tracking-[0.35em] text-[#f2ddcf]">Cadastro de Clientes</p>
                    <h1 class="mt-3 text-3xl font-bold lg:text-4xl">Bem-vindo ao Cafélo</h1>
                    <p class="mt-3 text-sm leading-6 text-white/75">Preencha os dados abaixo para criar um novo cliente no programa de fidelidade.</p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('cadastro-cliente') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-semibold text-[#2a1b17] transition-transform hover:-translate-y-0.5">
                        <span class="material-symbols-outlined text-[18px]">person_add</span>
                        Novo Cliente
                    </a>

                    <a href="{{ route('registro-de-vendas') }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-5 py-3 text-sm font-semibold text-white transition-colors hover:bg-white/10">
                        <span class="material-symbols-outlined text-[18px]">payments</span>
                        Registrar Venda
                    </a>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-slate-900">Cadastro de Cliente</h2>
                <p class="mt-2 text-sm text-slate-500">Complete as informações para liberar o cliente no sistema de pontos.</p>
            </div>

            @if(session('success'))
                <div class="mb-4 rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 rounded-3xl border border-rose-200 bg-rose-50 p-4 text-rose-800">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid gap-4 rounded-3xl border border-slate-100 bg-slate-50 p-6">
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div class="rounded-3xl bg-[#2a1b17]/90 p-4 text-white">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#f2ddcf]">Saldo Inicial</p>
                        <p class="mt-3 text-xl font-semibold">0 pts</p>
                    </div>
                    <div class="rounded-3xl bg-[#4e342e]/90 p-4 text-white">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#f2ddcf]">Nível</p>
                        <p class="mt-3 text-xl font-semibold">Bronze</p>
                    </div>
                    <div class="rounded-3xl bg-[#7d562d]/90 p-4 text-white">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#f2ddcf]">Status</p>
                        <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-2 text-sm font-semibold text-white">
                            <span class="h-2.5 w-2.5 rounded-full bg-[#f0bd8b]"></span>
                            Ativo
                        </div>
                    </div>
                </div>
            </div>

            <form class="space-y-6 mt-6" action="{{ route('cadastro-cliente.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700" for="nome">Nome Completo</label>
                        <input id="nome" name="nome" type="text" required placeholder="Seu nome completo" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#dec1b3] focus:ring-2 focus:ring-[#dec1b3]/20" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700" for="telefone">Telefone Celular</label>
                        <input id="telefone" name="telefone" type="tel" required placeholder="(00) 00000-0000" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#dec1b3] focus:ring-2 focus:ring-[#dec1b3]/20" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700" for="email">E-mail</label>
                        <input id="email" name="email" type="email" required placeholder="seu@email.com" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#dec1b3] focus:ring-2 focus:ring-[#dec1b3]/20" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700" for="foto">Foto (opcional)</label>
                        <input id="foto" name="foto" type="file" accept="image/jpeg,image/png,image/jpg,image/gif" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#dec1b3] focus:ring-2 focus:ring-[#dec1b3]/20" />
                        <p class="text-xs text-slate-500">Formatos: JPEG, PNG, JPG, GIF. Máximo: 2MB</p>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full rounded-full bg-[#7d562d] px-6 py-4 text-sm font-semibold text-white transition hover:bg-[#a16a41] focus:outline-none focus:ring-2 focus:ring-[#dec1b3]/40">
                        Finalizar Cadastro
                    </button>
                </div>
            </form>
        </section>
    </div>
</x-app-layout>
