<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard') - Grão & Fidelidade</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        h1, h2, h3, .brand-font { font-family: 'Montserrat', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(212, 195, 191, 0.3); }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d4c3bf; border-radius: 10px; }
    </style>
    @stack('head')
</head>
<body class="flex min-h-screen text-on-surface">
    <x-dashboard.sidebar />
    <main class="ml-[280px] w-[calc(100%-280px)] min-h-screen flex flex-col bg-background">
        <x-dashboard.topbar />

        <div class="p-md lg:p-lg space-y-lg">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
