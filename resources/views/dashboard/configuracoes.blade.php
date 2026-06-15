<x-app-layout titulo="Configurações do Usuário">

    <div class="space-y-8">

        <div class="flex flex-col gap-6 lg:flex-row">

            <section class="rounded-3xl bg-white p-6 shadow-lg lg:w-1/3">
                <div class="flex items-center gap-4">
                    <div class="grid h-16 w-16 place-items-center rounded-3xl bg-[#d4a373] text-white">
                        <span class="material-symbols-outlined text-3xl">settings</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Configurações</h1>
                        <p class="text-sm text-slate-500">Gerencie o seu perfil e atualize seus dados de contato.</p>
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <div class="rounded-3xl bg-slate-50 p-5">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Status</p>
                        <p class="mt-3 text-base font-semibold text-slate-900">{{ $type === 'user' ? 'Usuário autenticado' : 'Perfil de cliente' }}</p>
                    </div>

                    @if($type === 'cliente')
                        <div class="rounded-3xl bg-slate-50 p-5">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Pontos disponíveis</p>
                            <p class="mt-3 text-4xl font-semibold text-slate-900">{{ $model->saldo_pontos ?? 0 }}</p>
                        </div>
                    @endif
                </div>
            </section>

            <section class="rounded-3xl bg-white p-6 shadow-lg flex-1">
                <div class="flex flex-col gap-2">
                    <h2 class="text-2xl font-bold">Ajustes do perfil</h2>
                    <p class="text-sm text-slate-500">Atualize suas informações de forma segura e prática.</p>
                </div>

                @if (session('status'))
                    <div class="mt-6 rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('configuracoes.update') }}" method="post" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-700">{{ $type === 'user' ? 'Nome' : 'Nome do cliente' }}</label>
                            <input
                                type="text"
                                name="{{ $type === 'user' ? 'name' : 'nome' }}"
                                value="{{ old($type === 'user' ? 'name' : 'nome', $type === 'user' ? $model->name : $model->nome) }}"
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#d4a373]"
                                required
                            />
                            @error($type === 'user' ? 'name' : 'nome')<p class="text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-700">Email</label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $model->email) }}"
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#d4a373]"
                                required
                            />
                            @error('email')<p class="text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>

                        @if($type === 'cliente')
                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700">Telefone</label>
                                <input
                                    type="tel"
                                    name="telefone"
                                    value="{{ old('telefone', $model->telefone) }}"
                                    inputmode="numeric"
                                    autocomplete="tel"
                                    maxlength="15"
                                    class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#d4a373]"
                                />
                                @error('telefone')<p class="text-xs text-rose-600">{{ $message }}</p>@enderror
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-slate-500">As alterações serão aplicadas imediatamente após salvar.</p>
                        <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-[#2a1b17] px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-900">
                            Salvar configurações
                        </button>
                    </div>
                </form>
            </section>

        </div>

    </div>

</x-app-layout>
