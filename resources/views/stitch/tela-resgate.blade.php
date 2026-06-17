<x-app-layout titulo="Resgates">
    <div class="space-y-10">
        <!-- Perfil do Cliente -->
        <div class="flex flex-col gap-6 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Perfil do Cliente</h1>
                <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600">
                    Gerencie os pontos e resgates de <strong class="font-semibold text-slate-900">{{ $cliente['nome'] }}</strong>.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-3 rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4">
                <span class="text-xs uppercase tracking-[0.2em] text-slate-500">ID do Cliente</span>
                <span class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white">{{ $cliente['id'] }}</span>
            </div>
        </div>

        <!-- Seção de Saldo e Fidelidade -->
        <section class="rounded-[2rem] bg-amber-50 px-8 py-8 shadow-sm">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-xl">
                    <div class="inline-flex items-center gap-3 rounded-full bg-amber-100 px-4 py-2 text-sm font-semibold text-amber-800">
                        <span class="material-symbols-outlined text-xl">stars</span>
                        Saldo Atual
                    </div>
                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <span class="text-sm font-medium text-slate-700">Você possui</span>
                        <span class="text-5xl font-bold text-amber-700">{{ $cliente['saldo'] }}</span>
                        <span class="text-lg font-semibold text-amber-700">pontos</span>
                    </div>

                    <div class="mt-8 max-w-md space-y-3">
                        <div class="flex items-center justify-between text-sm text-slate-600">
                            <span>Status: {{ $cliente['status'] }}</span>
                            <span>Faltam {{ $cliente['faltam_proximo_status'] }} para {{ $cliente['proximo_status'] }}</span>
                        </div>
                        <div class="overflow-hidden rounded-full bg-amber-100">
                            <div class="h-2 rounded-full bg-amber-600" style="width: {{ $cliente['progresso_barra'] }}%;"></div>
                        </div>
                    </div>
                </div>

                <div class="rounded-[1.75rem] border border-white/80 bg-white p-6 text-center shadow-sm">
                    <span class="block text-xs uppercase tracking-[0.24em] text-slate-500">Próxima Expiração</span>
                    <span class="mt-4 block text-3xl font-semibold text-slate-900">{{ $cliente['proxima_expiracao_pts'] }} pts</span>
                    <span class="mt-1 block text-sm text-slate-500">em {{ $cliente['proxima_expiracao_data'] }}</span>
                </div>
            </div>
        </section>

        <!-- Seção de Produtos Disponíveis -->
        <section class="space-y-6">
            <div class="flex flex-col gap-4 border-b border-slate-200 pb-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3 text-slate-900">
                    <span class="material-symbols-outlined text-2xl text-amber-600">local_mall</span>
                    <h2 class="text-xl font-semibold">Disponível para Resgate</h2>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <span class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Filtrar por categoria</span>
                    <button type="button" data-filter="all" class="redeem-filter-button rounded-full border border-slate-300 bg-white px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-50">Todos</button>
                    <button type="button" data-filter="cafe" class="redeem-filter-button rounded-full border border-slate-300 bg-white px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-50">Cafés</button>
                    <button type="button" data-filter="acessorio" class="redeem-filter-button rounded-full border border-slate-300 bg-white px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-50">Acessórios</button>
                </div>
            </div>

            <!-- Grid Dinâmico alimentado pelo Banco de Dados -->
            <div class="grid gap-6 lg:grid-cols-3">
                @forelse($produtos as $produto)
                    <x-redeem-card
                        :title="$produto->title"
                        :description="$produto->description"
                        :points="$produto->points"
                        :image="$produto->image"
                        :badge="$produto->badge" 
                        :category="$produto->category"
                        :disabled="$cliente['saldo'] < $produto->points"
                    />
                @empty
                    <div class="col-span-full py-12 text-center text-slate-500">
                        Nenhum produto cadastrado para resgate no momento.
                    </div>
                @endforelse
            </div>
        </section>
    </div>

    <!-- Script de Filtro por Categoria -->
    <script>
        (function(){
            try {
                const buttons = document.querySelectorAll('.redeem-filter-button');
                const cards = document.querySelectorAll('[data-category]');
                if (!buttons.length || !cards.length) return;

                function setActive(btn) {
                    buttons.forEach(b => {
                        b.classList.remove('bg-amber-600','text-white');
                        b.classList.add('bg-white','border-slate-300');
                    });
                    btn.classList.remove('bg-white','border-slate-300');
                    btn.classList.add('bg-amber-600','text-white');
                }

                function applyCategory(category) {
                    cards.forEach(card => {
                        const cardCategory = card.dataset.category;
                        const matches = category === 'all' || cardCategory === category;
                        card.style.display = matches ? '' : 'none';
                    });
                }

                buttons.forEach(button => {
                    button.addEventListener('click', () => {
                        const filter = button.dataset.filter || 'all';
                        setActive(button);
                        applyCategory(filter);
                    });
                });

                const defaultBtn = document.querySelector('.redeem-filter-button[data-filter="all"]');
                if (defaultBtn) {
                    setActive(defaultBtn);
                    applyCategory('all');
                }
            } catch (e) {
                console.warn('Redeem filter fallback failed', e);
            }
        })();
    </script>
</x-app-layout>

use Illuminate\Http\Request;
use App\Models\Produto; // Certifique-se de que o Model Produto existe
use Illuminate\Support\Facades\Auth;

class ResgateController extends Controller
{
    public function index()
    {
        // 1. Dados dinâmicos do cliente (pode ser adaptado para pegar do Auth::user())
        // Substitua pelos campos reais da sua tabela de usuários/clientes
        $cliente = [
            'id' => '#GF-8492',
            'nome' => 'Mariana Silva',
            'saldo' => 450,
            'status' => 'Ouro',
            'faltam_proximo_status' => 50,
            'proximo_status' => 'Platina',
            'progresso_barra' => 90, // porcentagem (ex: 90)
            'proxima_expiracao_pts' => 120,
            'proxima_expiracao_data' => '30 Nov 2023'
        ];

        // 2. Busca apenas os produtos ativos cadastrados no banco de dados
        $produtos = Produto::all(); 

        // 3. Retorna a view enviando as variáveis
        return view('tela-resgate', compact('cliente', 'produtos'));
    }
}