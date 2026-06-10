<x-app-layout>

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
            />

            <x-stat-card
                titulo="Novos Clientes"
                :valor="$novosClientes"
                icone="person_add"
            />

        </div>

    </div>

</x-app-layout>