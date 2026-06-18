<x-app-layout titulo="Perfil do Cliente">

    <div class="space-y-8">

        <div class="flex flex-col gap-6 lg:flex-row">

            <section class="rounded-3xl bg-white p-6 shadow-lg lg:w-1/3">
                <div class="flex items-center gap-4">
                    <div class="grid h-16 w-16 place-items-center rounded-3xl bg-[#d4a373] text-white">
                        <span class="material-symbols-outlined text-3xl">person</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">{{ $cliente->nome ?: 'Cliente' }}</h1>
                        <p class="text-sm text-slate-500">Acesse e personalize suas informações.</p>
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <div class="rounded-3xl bg-slate-50 p-5">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Saldo de pontos</p>
                        <p class="mt-3 text-4xl font-semibold text-slate-900">{{ $cliente->saldo_pontos ?? 0 }}</p>
                    </div>

                    <div class="rounded-3xl bg-slate-50 p-5">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Informações</p>
                        <dl class="mt-4 space-y-3 text-sm text-slate-600">
                            <div class="flex items-center justify-between">
                                <dt>Nome</dt>
                                <dd class="font-semibold text-slate-900">{{ $cliente->nome ?: '-' }}</dd>
                            </div>
                            <div class="flex items-center justify-between">
                                <dt>Email</dt>
                                <dd class="font-semibold text-slate-900">{{ $cliente->email ?: '-' }}</dd>
                            </div>
                            <div class="flex items-center justify-between">
                                <dt>Telefone</dt>
                                <dd class="font-semibold text-slate-900">{{ $cliente->telefone ?: '-' }}</dd>
                            </div>
                            @if($cliente->exists)
                                <div class="flex items-center justify-between">
                                    <dt>Criado em</dt>
                                    <dd class="font-semibold text-slate-900">{{ $cliente->created_at?->format('d/m/Y') ?? '-' }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </section>

            <section class="rounded-3xl bg-white p-6 shadow-lg flex-1">
                <div class="flex flex-col gap-2">
                    <h2 class="text-2xl font-bold">Configuração do perfil</h2>
                    <p class="text-sm text-slate-500">Atualize seus dados de contato e mantenha seu perfil sempre em dia.</p>
                </div>

                <div class="mt-4 flex gap-2">
                    <select id="clienteSelector" class="flex-1 rounded-3xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-900 outline-none transition focus:border-[#d4a373]">
                        <option value="">-- Selecione um cliente --</option>
                        @foreach($clientes as $c)
                            <option value="{{ $c->id }}" @if($cliente->id === $c->id) selected @endif>{{ $c->nome ?: 'Cliente' }} ({{ $c->email }})</option>
                        @endforeach
                    </select>
                    <button type="button" id="btnAlterar" class="inline-flex items-center justify-center rounded-3xl bg-[#d4a373] px-6 py-2 text-sm font-semibold text-white transition hover:bg-[#c29563]">Alterar cliente</button>
                </div>

                @if (session('status'))
                    <div class="mt-6 rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('perfil.update') }}" method="post" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-700">Nome</label>
                            <input
                                type="text"
                                name="nome"
                                value="{{ old('nome', $cliente->nome) }}"
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#d4a373]"
                                required
                            />
                            @error('nome')<p class="text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-700">Email</label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $cliente->email) }}"
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#d4a373]"
                            />
                            @error('email')<p class="text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700">Telefone</label>
                            <input
                                type="tel"
                                name="telefone"
                                value="{{ old('telefone', $cliente->telefone) }}"
                                inputmode="numeric"
                                autocomplete="tel"
                                maxlength="15"
                                class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#d4a373]"
                            />
                            @error('telefone')<p class="text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-slate-500">Os campos podem ser atualizados a qualquer momento.</p>
                        <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-[#2a1b17] px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-900">
                            Salvar mudanças
                        </button>
                    </div>
                </form>
            </section>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const select = document.getElementById('clienteSelector');
            const btn = document.getElementById('btnAlterar');
            const csrf = '{{ csrf_token() }}';

            if (!btn || !select) return;

            btn.addEventListener('click', function () {
                const clienteId = select.value;
                if (!clienteId) {
                    alert('Selecione um cliente');
                    return;
                }

                fetch('/perfil/selecionar-cliente', {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ cliente_id: clienteId })
                })
                .then(r => {
                    if (r.status === 401 || r.status === 403) {
                        window.location.href = '/login';
                        return Promise.reject('Não autenticado');
                    }
                    return r.json();
                })
                .then(json => {
                    if (json.success) {
                        location.reload();
                    } else {
                        alert(json.message || 'Erro ao alterar cliente');
                    }
                })
                .catch(err => alert('Erro: ' + err));
            });
        });
    </script>

    </x-app-layout>
