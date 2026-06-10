@props([
    'cliente',
    'tipo',
    'valor',
    'status' => null,
    'avatar' => null,
    'icone' => 'point_of_sale',
])

@php
    $statusStyles = [
        'Aprovado' => 'bg-emerald-50 text-emerald-700',
        'Concluído' => 'bg-emerald-50 text-emerald-700',
        'Pendente' => 'bg-amber-50 text-amber-700',
        'Cancelado' => 'bg-rose-50 text-rose-700',
    ];

    $avatar = $avatar ?: collect(explode(' ', trim($cliente)))
        ->filter()
        ->take(2)
        ->map(fn ($part) => mb_substr($part, 0, 1))
        ->implode('');
@endphp

<li class="flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm transition-colors hover:bg-slate-50">

    <div class="flex items-center gap-3">

        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-xs font-bold uppercase text-white">
            {{ $avatar }}
        </div>

        <div>

            <p class="font-medium text-slate-900">{{ $cliente }}</p>

            <small class="flex items-center gap-1 text-sm text-slate-500">
                <span class="material-symbols-outlined text-[14px]">{{ $icone }}</span>
                {{ $tipo }}
            </small>

        </div>

    </div>

    <div class="text-right">

        <strong class="block text-sm font-semibold text-slate-900">{{ $valor }}</strong>

        @if ($status)
            <span class="mt-1 inline-flex rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $statusStyles[$status] ?? 'bg-slate-100 text-slate-600' }}">
                {{ $status }}
            </span>
        @endif

    </div>

</li>