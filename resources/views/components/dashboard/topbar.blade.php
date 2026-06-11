<header class="sticky top-0 z-40 bg-surface-container-lowest dark:bg-surface-dim flex justify-between items-center h-16 px-md shadow-sm border-b border-outline-variant/30">
    <div class="flex items-center gap-4">
        <span class="font-headline-md text-headline-md font-bold text-primary">@yield('page-title', 'Histórico')</span>
    </div>
    <div class="flex items-center gap-6">
        <div class="relative hidden lg:flex items-center">
            <span class="material-symbols-outlined absolute left-3 text-outline" data-icon="search">search</span>
            <input class="pl-10 pr-4 py-2 bg-surface-container rounded-full border-none focus:ring-2 focus:ring-secondary text-body-sm w-64" placeholder="Buscar transação..." type="text" />
        </div>
        <div class="flex items-center gap-3">
            <button class="p-2 hover:bg-surface-container rounded-full transition-all text-on-surface-variant">
                <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
            </button>
            <button class="p-2 hover:bg-surface-container rounded-full transition-all text-on-surface-variant">
                <span class="material-symbols-outlined" data-icon="help">help</span>
            </button>
            <div class="h-8 w-8 rounded-full overflow-hidden border border-outline-variant">
                <img alt="Foto de Perfil do Administrador" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBePPFK9uX28LmcF6QdnzS55B_8fqjKGisn3KZt72EbFprWgXHCvJPb0ba9tfGufGELxfHMnIuFYiyipG1ZARaVC0HpGZCzuZOLgefMSJnumJY4RF3AZEsvV013cCEk0of_kSkt-kzr24WArdmHP12ojNyNhZROenxKO6ymurSzeig5tI-yS7nTIkJeaDX4ncU84CIxZ0czp2d0yH1HVpMY5__dNGNBDcRQkGhGK3hcJfoXhovpUYzB_UbSAv9sGWC2_QhycvGUm5dN" />
            </div>
        </div>
    </div>
</header>
