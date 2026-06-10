@props([
    'titulo',
    'valor',
    'icone',
    'badge' => null,
    'badgeIcon' => 'trending_up',
    'badgeTone' => 'success',
])

@php
    $badgeStyles = [
        'success' => 'bg-emerald-50 text-emerald-700',
        'warning' => 'bg-amber-50 text-amber-700',
        'neutral' => 'bg-slate-100 text-slate-600',
    ];
@endphp

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

    <div class="mb-6 flex items-start justify-between gap-4">

        <span class="material-symbols-outlined rounded-xl bg-slate-100 p-3 text-slate-700">
            {{ $icone }}
        </span>

        @if ($badge)
            <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-semibold {{ $badgeStyles[$badgeTone] ?? $badgeStyles['neutral'] }}">
                <span class="material-symbols-outlined text-[14px]">{{ $badgeIcon }}</span>
                {{ $badge }}
            </span>
        @endif

    </div>

    <div class="mt-4">

        <p class="text-sm text-slate-500">
            {{ $titulo }}
        </p>

        <h3 class="text-2xl font-bold text-slate-900">
            {{ $valor }}
        </h3>

    </div>

</div>