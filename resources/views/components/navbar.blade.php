@props([
    'titulo' => 'Dashboard',
])

<header class="sticky top-0 z-40 flex h-16 items-center justify-between border-b border-slate-200 bg-white/90 px-6 backdrop-blur">

    <h2 class="text-xl font-bold">
        {{ $titulo }}
    </h2>

    <div class="flex gap-4">

        <button>
            <span class="material-symbols-outlined">
                notifications
            </span>
        </button>

        <button>
            <span class="material-symbols-outlined">
                help
            </span>
        </button>

    </div>

</header>