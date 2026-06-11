@props([
    'title',
    'description',
    'points',
    'image',
    'badge' => null,
    'category' => null,
    'buttonLabel' => 'Resgatar',
    'disabled' => false,
])

<article
    {{ $attributes->merge(['class' => 'group relative flex h-full flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition-transform duration-200 hover:-translate-y-1 min-h-[260px]']) }}
    @if($category) data-category="{{ $category }}" @endif
>
    @if($disabled)
        <div class="absolute inset-0 z-20 flex items-center justify-center bg-slate-50/90 px-4 text-center">
            <span class="inline-flex items-center gap-2 rounded-full bg-rose-100 px-4 py-2 text-sm font-semibold text-rose-700 shadow-sm">
                <span class="material-symbols-outlined text-base">lock</span>
                Faltam pontos
            </span>
        </div>
    @endif

    <div class="h-52 bg-slate-100 p-4">
        <div class="mb-3 flex flex-wrap gap-2">
            @if($badge)
                <span class="inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                    <span class="material-symbols-outlined text-base">verified</span>
                    {{ $badge }}
                </span>
            @endif
            @if($category)
                <span class="inline-flex items-center rounded-full bg-slate-200 px-3 py-1 text-xs font-semibold text-slate-700">
                    {{ ucwords(str_replace('_', ' ', $category)) }}
                </span>
            @endif
        </div>

        <div class="flex h-full items-center justify-center overflow-hidden rounded-3xl bg-white">
            <img src="{{ $image }}" alt="{{ $title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
        </div>
    </div>

    <div class="flex flex-1 flex-col justify-between gap-4 p-6 relative z-10">
        <div class="space-y-2">
            <h3 class="text-lg font-semibold text-slate-900">{{ $title }}</h3>
            <p class="text-sm leading-6 text-slate-600">{{ $description }}</p>
        </div>
        <div class="mt-auto pt-md border-t border-outline-variant/20">
            <div class="flex items-center justify-between pt-md">
                <div class="flex items-baseline gap-xs text-primary font-bold">
                    <span class="material-symbols-outlined text-[18px]">local_activity</span>
                    <span class="font-headline-md text-headline-md">{{ $points }}</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant font-normal">pts</span>
                </div>

                <button class="bg-secondary-fixed text-on-secondary-fixed px-5 py-2 rounded-full font-label-md text-label-md hover:bg-secondary-fixed-dim transition-colors shadow-sm active:scale-95 flex items-center gap-xs" @disabled($disabled)>
                    {{ $disabled ? 'Saldo Insuficiente' : $buttonLabel }}
                </button>
            </div>
        </div>
    </div>
</article>
