<aside class="fixed left-0 top-0 h-full w-[280px] bg-primary dark:bg-primary-container flex flex-col py-md shadow-[0px_4px_20px_rgba(78,52,46,0.08)] z-50">
    <div class="px-md mb-lg">
        <h1 class="font-headline-md text-headline-md font-bold text-secondary-fixed tracking-tight">Grão &amp; Fidelidade</h1>
        <p class="font-label-md text-label-md text-on-primary/60">Admin Terminal</p>
    </div>
    <nav class="flex-1 space-y-1 px-sm overflow-y-auto custom-scrollbar">
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary/70 hover:text-on-primary hover:bg-on-primary-container/5 transition-colors group" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
            <span class="font-label-md text-label-md">Dashboard</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary/70 hover:text-on-primary hover:bg-on-primary-container/5 transition-colors group" href="{{ route('produtos') }}">
            <span class="material-symbols-outlined" data-icon="inventory_2">inventory_2</span>
            <span class="font-label-md text-label-md">Produtos</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary/70 hover:text-on-primary hover:bg-on-primary-container/5 transition-colors group" href="{{ route('cadastro-cliente') }}">
            <span class="material-symbols-outlined" data-icon="group">group</span>
            <span class="font-label-md text-label-md">Clientes</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary/70 hover:text-on-primary hover:bg-on-primary-container/5 transition-colors group" href="{{ route('registro-de-vendas') }}">
            <span class="material-symbols-outlined" data-icon="point_of_sale">point_of_sale</span>
            <span class="font-label-md text-label-md">Vendas</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-primary/70 hover:text-on-primary hover:bg-on-primary-container/5 transition-colors group" href="{{ route('resgates') }}">
            <span class="material-symbols-outlined" data-icon="redeem">redeem</span>
            <span class="font-label-md text-label-md">Resgates</span>
        </a>
        <!-- Active Tab: Histórico -->
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-secondary-fixed font-bold border-l-4 border-secondary-fixed bg-on-primary-container/10 transition-all" href="{{ route('dashboard.historico-vendas') }}">
            <span class="material-symbols-outlined" data-icon="history">history</span>
            <span class="font-label-md text-label-md">Histórico</span>
        </a>
    </nav>
    <div class="px-md py-4 mt-auto border-t border-on-primary/10">
        <a href="{{ route('registro-de-vendas') }}" class="w-full py-3 bg-secondary-container text-on-secondary-container font-label-md text-label-md rounded-xl hover:brightness-110 active:scale-95 transition-all flex items-center justify-center gap-2 mb-lg">
            <span class="material-symbols-outlined" data-icon="add">add</span>
            Nova Venda
        </a>
        <div class="space-y-1">
            <a class="flex items-center gap-3 px-4 py-2 text-on-primary/70 hover:text-on-primary transition-colors" href="{{ route('configuracoes') }}">
                <span class="material-symbols-outlined" data-icon="settings">settings</span>
                <span class="font-label-md text-label-md">Configurações</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-2 text-on-primary/70 hover:text-on-primary transition-colors" href="#">
                <span class="material-symbols-outlined" data-icon="logout">logout</span>
                <span class="font-label-md text-label-md">Sair</span>
            </a>
        </div>
    </div>
</aside>
