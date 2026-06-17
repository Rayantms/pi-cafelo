@props([
    'title',
    'description',
    'points',
    'image',
    'category',
    'badge' => null,
    'productId' => null,
    'disabled' => false,
])

<article data-category="{{ $category }}" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col group relative transition-all duration-300 {{ $disabled ? 'opacity-75' : 'hover:-translate-y-1 hover:shadow-md' }}">
    
    <!-- Feedback visual flutuante se faltar pontos -->
    @if($disabled)
        <div class="absolute inset-0 bg-slate-50/40 z-20 pointer-events-none flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
            <span class="bg-white border border-red-200 px-4 py-2 rounded-full font-semibold text-red-600 shadow-md flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">lock</span>
                Saldo Insuficiente
            </span>
        </div>
    @endif

    <!-- Container da Imagem -->
    <div class="relative h-48 bg-slate-50 p-3">
        @if($badge)
            <div class="absolute top-3 right-3 z-10 bg-amber-100 text-amber-900 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                {{ $badge }}
            </div>
        @endif
        <div class="w-full h-full rounded-lg overflow-hidden bg-white flex items-center justify-center">
            <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover">
        </div>
    </div>

    <!-- Informações do Produto -->
    <div class="p-5 flex flex-col flex-1">
        <h4 class="text-lg font-bold text-slate-950 mb-1">{{ $title }}</h4>
        <p class="text-sm text-slate-600 line-clamp-2 mb-5 flex-1">{{ $description }}</p>
        
        <!-- Rodapé do Card -->
        <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-auto">
            <div class="flex items-baseline gap-0.5 font-bold text-slate-900">
                <span class="text-xl font-bold">{{ $points }}</span>
                <span class="text-xs font-normal text-slate-500">pts</span>
            </div>

            <!-- Botão Dinâmico -->
            @if($disabled)
                <button type="button" class="bg-slate-100 text-slate-400 border border-slate-200 px-5 py-2 rounded-full text-sm font-semibold cursor-not-allowed" disabled>
                    Saldo Insuficiente
                </button>
            @else
                <form method="POST" action="{{ route('resgates.store') }}">
                    @csrf
                    <input type="hidden" name="produto_id" value="{{ $productId }}">
                    <button type="submit" class="bg-amber-600 text-white hover:bg-amber-700 px-5 py-2 rounded-full text-sm font-semibold transition-colors shadow-sm active:scale-95">
                        Resgatar
                    </button>
                </form>
            @endif
        </div>
    </div>
</article>