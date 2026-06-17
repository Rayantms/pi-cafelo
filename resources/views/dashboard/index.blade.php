<x-app-layout titulo="Dashboard">

    <div class="space-y-8">

        <h1 class="text-3xl font-bold">
            Dashboard
        </h1>

        <div class="grid grid-cols-4 gap-6">

            <x-stat-card
                titulo="Vendas Hoje"
                :valor="'R$ '.number_format($vendasHoje,2,',','.')"
                icone="payments"
            />

            <x-stat-card
                titulo="Pontos Distribuídos"
                :valor="$pontosDistribuidos"
                icone="stars"
            />

            <x-stat-card
                titulo="Resgates"
                :valor="$resgatesHoje"
                icone="redeem"
                :href="route('resgates')"
            />

            <x-stat-card
                titulo="Novos Clientes"
                :valor="$novosClientes"
                icone="person_add"
            />

        </div>

        <div class="mt-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Últimas Transações</h2>
                    <p class="text-sm text-slate-500">Confira o status das transações mais recentes.</p>
                </div>
                <a href="#" class="text-sm font-semibold text-sky-600 transition-colors hover:text-sky-700">Ver todas</a>
            </div>

            <ul class="mt-6 space-y-3">
                @foreach ($transacoesRecentes as $transacao)
                    <x-transaction-item
                        :cliente="$transacao['cliente']"
                        :tipo="$transacao['tipo']"
                        :valor="$transacao['valor']"
                        :status="$transacao['status']"
                        :icone="$transacao['icone']"
                    />
                @endforeach
            </ul>
        </div>
    </div>

</x-app-layout>
