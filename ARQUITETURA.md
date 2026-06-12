# 🏗️ Arquitetura Completa do Cafélo - Sistema de Fidelidade

## 📋 Índice
1. [Visão Geral](#visão-geral)
2. [Arquitetura do Sistema](#arquitetura-do-sistema)
3. [Banco de Dados](#banco-de-dados)
4. [Fluxos Principais](#fluxos-principais)
5. [Módulos e Funcionalidades](#módulos-e-funcionalidades)
6. [Como Rodar](#como-rodar)

---

## 🎯 Visão Geral

**Cafélo** é um **sistema de gestão e fidelidade para cafeterias** desenvolvido em **Laravel + Blade + Tailwind + JavaScript puro**.

**Principais características:**
- ✅ PDV (Ponto de Venda) integrado
- ✅ Sistema de pontos de cliente
- ✅ Histórico de transações em tempo real
- ✅ Cadastro de clientes com fotos
- ✅ Gestão de catálogo de produtos com imagens
- ✅ Dashboard com métricas do negócio
- ✅ Filtros de período (Hoje/7 dias/30 dias)

---

## 🏛️ Arquitetura do Sistema

### Stack Tecnológico
```
┌─────────────────────────────────────┐
│         Frontend (Blade)            │
│  HTML + Tailwind + JavaScript Puro  │
└──────────────────┬──────────────────┘
                   │
         ┌─────────▼──────────┐
         │  Laravel Router    │
         │  (routes/web.php)  │
         └─────────┬──────────┘
                   │
         ┌─────────▼──────────────────────────┐
         │   HTTP Controllers                 │
         │  - DashboardController             │
         │  - ProdutosController              │
         │  - ClientePerfilController         │
         │  - ConfiguracoesController         │
         └─────────┬──────────────────────────┘
                   │
         ┌─────────▼──────────────────────────┐
         │  Eloquent ORM + Models             │
         │  - User (Admin)                    │
         │  - Cliente (Clientes)              │
         │  - Produto (Produtos)              │
         │  - Venda (Vendas)                  │
         │  - ItemVenda (Itens de vendas)     │
         │  - MovimentacaoPontos (Pontos)     │
         │  - Resgate (Resgates)              │
         └─────────┬──────────────────────────┘
                   │
         ┌─────────▼──────────────────────────┐
         │   MySQL Database                   │
         │  - 7 Tabelas principais            │
         │  - Relacionamentos Eloquent        │
         │  - Migrations para versionamento   │
         └────────────────────────────────────┘
```

---

## 🗄️ Banco de Dados

### Tabelas Principais

#### 1. **users** (Administradores)
```sql
CREATE TABLE users (
  id BIGINT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  password VARCHAR(255),
  foto VARCHAR(255) NULLABLE,
  email_verified_at TIMESTAMP NULLABLE,
  remember_token VARCHAR(100) NULLABLE,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```
- **Função:** Armazena administradores do sistema
- **Relações:** Pode ter múltiplas vendas associadas (1:N)

#### 2. **clientes** (Clientes/Clientes)
```sql
CREATE TABLE clientes (
  id BIGINT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  email VARCHAR(255) NULLABLE,
  telefone VARCHAR(50) NULLABLE,
  saldo_pontos INT DEFAULT 0,
  foto VARCHAR(255) NULLABLE,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```
- **Função:** Cadastro de clientes com dados de fidelidade
- **Relações:** 
  - 1:N com `vendas` (um cliente pode ter múltiplas vendas)
  - 1:N com `movimentacoes_pontos` (histórico de pontos)
  - 1:N com `resgates` (histórico de resgates)

#### 3. **produtos** (Catálogo)
```sql
CREATE TABLE produtos (
  id BIGINT PRIMARY KEY,
  nome VARCHAR(255),
  descricao TEXT NULLABLE,
  preco DECIMAL(10,2),
  pontos_compra INT DEFAULT 0,
  pontos_resgate INT DEFAULT 0,
  imagem VARCHAR(255) NULLABLE,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```
- **Função:** Catálogo de produtos vendáveis
- **Campos especiais:**
  - `pontos_compra`: Pontos ganhos ao comprar este produto
  - `pontos_resgate`: Pontos necessários para resgatar como prêmio
  - `imagem`: URL relativa armazenada em `storage/app/public/produtos/`
- **Relações:** 1:N com `item_vendas` (um produto em múltiplas vendas)

#### 4. **vendas** (Transações de vendas)
```sql
CREATE TABLE vendas (
  id BIGINT PRIMARY KEY,
  cliente_id BIGINT FOREIGN KEY,
  valor_total DECIMAL(10,2),
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```
- **Função:** Registro de cada venda realizada
- **Fluxo:** 
  1. Criada quando cliente finaliza carrinho no PDV
  2. Cria múltiplos `ItemVenda` (um por produto)
  3. Dispara criação de `MovimentacaoPontos` (credita pontos)
- **Relações:**
  - N:1 com `clientes` (FK)
  - 1:N com `item_vendas`

#### 5. **item_vendas** (Itens da venda)
```sql
CREATE TABLE item_vendas (
  id BIGINT PRIMARY KEY,
  venda_id BIGINT FOREIGN KEY,
  produto_id BIGINT FOREIGN KEY,
  quantidade INT,
  valor_unitario DECIMAL(10,2),
  subtotal DECIMAL(10,2),
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```
- **Função:** Detalhe de cada item em uma venda (1 venda → N itens)
- **Exemplo:** Venda #1 = [Café 2x, Bolo 1x] → 2 registros de item_vendas

#### 6. **movimentacoes_pontos** (Histórico de pontos)
```sql
CREATE TABLE movimentacoes_pontos (
  id BIGINT PRIMARY KEY,
  cliente_id BIGINT FOREIGN KEY,
  tipo ENUM('credito', 'debito'),
  pontos INT,
  descricao VARCHAR(255),
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```
- **Função:** Auditoria completa de movimentação de pontos
- **Tipos:**
  - `credito`: +pontos (ao vender produto)
  - `debito`: -pontos (ao resgatar prêmio)
- **Exemplo:** "Pontos creditados pela venda #15"

#### 7. **resgates** (Histórico de resgates)
```sql
CREATE TABLE resgates (
  id BIGINT PRIMARY KEY,
  cliente_id BIGINT FOREIGN KEY,
  produto_id BIGINT FOREIGN KEY,
  pontos_utilizados INT,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```
- **Função:** Registro de quando cliente resgate um prêmio com pontos
- **Fluxo:**
  1. Cliente tem saldo de pontos
  2. Escolhe produto com `pontos_resgate = 150`
  3. Sistema cria `Resgate` e decrementa `cliente.saldo_pontos`

---

## 🔄 Fluxos Principais

### 1️⃣ Fluxo de Venda (PDV)

```
CLIENTE → CADASTRA/SELECIONA → ADICIONA PRODUTOS → FINALIZA
  ↓          ↓                    ↓                   ↓
[Form]   [DB Clientes]        [Carrinho JS]      [POST Request]
                                                      ↓
                                    ┌─────────────────▼──────────────────┐
                                    │ DashboardController::storeVenda()  │
                                    └─────────┬──────────────────────────┘
                                              │
                                    ┌─────────▼──────────────────┐
                                    │ DB::transaction() {        │
                                    │  1. Create Venda           │
                                    │  2. Create ItemVendas (N)  │
                                    │  3. Sum valor_total        │
                                    │  4. Create MovimentacaoPts │
                                    │  5. Increment saldo_pontos │
                                    │ }                          │
                                    └─────────┬──────────────────┘
                                              │
                        ┌─────────────────────┼──────────────────────┐
                        ↓                     ↓                      ↓
                    [vendas]            [item_vendas]     [movimentacoes_pontos]
                    Nova venda           Itens da venda    +Pontos creditados
                    com cliente_id       com preços        em historico
```

### 2️⃣ Fluxo de Dashboard (Métricas)

```
ACESSO À PÁGINA / (dashboard)
  ↓
DashboardController::index()
  ├─ Venda::where('created_at', >= today)->sum('valor_total')
  ├─ MovimentacaoPontos::where('tipo','credito')->where('created_at', >= today)->sum('pontos')
  ├─ Resgate::where('created_at', >= today)->count()
  ├─ Cliente::where('created_at', >= today)->count()
  └─ Venda + Resgate (últimos 6 cada) → merge → últimas 4 transações
                                    ↓
                        Renderiza view/dashboard/index
                        com 4 cartões + transações recentes
```

### 3️⃣ Fluxo de Histórico com Filtros

```
GET /historico-vendas?period=today (ou 7, 30, all)
  ↓
DashboardController::historicoVendas(Request $request)
  ├─ switch ($period) {
  │   case 'today':   $from = startOfDay()
  │   case '7':       $from = subDays(6)->startOfDay()
  │   case '30':      $from = subDays(29)->startOfDay()
  │   default:        $from = null (all time)
  │ }
  ├─ Se $from:
  │   Venda::where('created_at', '>=', $from)->sum('valor_total')
  │ Senão:
  │   Venda::sum('valor_total')
  └─ Retorna view com ($totalVendas, $pontosCreditados, $resgatesRealizados, $period)
                                    ↓
                    Botões destacam período selecionado
                    Tabela abaixo exibe últimas 50 vendas
                    com cliente, data e total
```

---

## 📦 Módulos e Funcionalidades

### 📱 Módulo 1: Dashboard (Home)
**Arquivo:** `resources/views/dashboard/index.blade.php`

**O que mostra:**
- 4 cartões com métricas do dia:
  - Vendas (R$)
  - Pontos distribuídos
  - Resgates
  - Novos clientes
- Últimas 4 transações (vendas + resgates mescladas)
- Link para "Ver todas"

**Controller:** `DashboardController::index()`

---

### 💰 Módulo 2: PDV (Registro de Vendas)
**Arquivo:** `resources/views/dashboard/registro-de-vendas.blade.php`

**Componentes:**
1. **Header Informativo** (hero section)
2. **Catálogo de Produtos** (grid de 3 colunas, responsivo)
   - Mostra imagem (ou placeholder)
   - Nome, descrição, preço, pontos
   - Botão "+" para adicionar ao carrinho
3. **Sidebar com Carrinho**
   - Seletor de cliente (com dados de saldo e telefone visíveis)
   - Lista de itens no carrinho (quantidade +/-)
   - Cálculos em tempo real (subtotal, pontos, total)
   - Botão "Finalizar Venda" (valida: cliente + itens)

**JavaScript Puro:**
- Estado `carrinho = {}` (productId → item)
- Funções: `adicionarProduto()`, `removerProduto()`, `calcularTotal()`, `atualizarCarrinho()`, `resetVenda()`
- Form dinâmico: inputs ocultos `items[n][produto_id]` e `items[n][quantidade]`

**Controller:** `DashboardController::registroVendas()` (GET) / `storeVenda()` (POST)

---

### 📋 Módulo 3: Histórico de Vendas
**Arquivo:** `resources/views/dashboard/historico-vendas.blade.php`

**Seções:**
1. **Filtros de Período** (botões: Hoje, 7 dias, 30 dias, Personalizado)
   - Query string: `?period=today|7|30` (ou vazio = all time)
   - Botão ativo destacado em preto
2. **3 Cartões com Métricas** (filtradas por período)
   - Total de Vendas
   - Pontos Creditados
   - Resgates Realizados
3. **Tabela de Transações** (últimas 50)
   - ID, Cliente, Tipo (Venda/Resgate), Data/Hora, Valor, Status, Ações

**Controller:** `DashboardController::historicoVendas(Request $request)`

---

### 👥 Módulo 4: Cadastro de Cliente
**Arquivo:** `resources/views/cadastro-cliente.blade.php`

**Form com Campos:**
- Nome Completo (obrigatório)
- Telefone (opcional)
- Email (opcional)
- Foto (opcional, JPEG/PNG/GIF, máx 2MB)
- Botão "Finalizar Cadastro"

**Dados Iniciais:**
- `saldo_pontos = 0`
- `status = ativo`
- `nivel = Bronze`

**Controller:** `DashboardController::storeCliente(Request $request)`

---

### 🛍️ Módulo 5: Gestão de Produtos
**Arquivos:**
- `resources/views/dashboard/produtos.blade.php` (listagem)
- `resources/views/dashboard/produtos-create.blade.php` (criar)
- `resources/views/dashboard/produtos-edit.blade.php` (editar)

**Campos:**
- Nome
- Descrição
- Preço
- Pontos de compra
- Pontos de resgate
- Imagem (opcional, JPEG/PNG/GIF, máx 2MB)

**Controllers:** `ProdutosController::index()`, `create()`, `store()`, `edit()`, `update()`

**Storage:** Imagens armazenadas em `storage/app/public/produtos/` (acessível via `/storage/produtos/...`)

---

## 📊 Models Eloquent

### User (Admin)
```php
// app/Models/User.php
#[Fillable(['name', 'email', 'password', 'foto'])]
```

### Cliente
```php
// app/Models/Cliente.php
$fillable = ['nome', 'email', 'telefone', 'saldo_pontos', 'foto'];

// Relações
public function vendas() { return $this->hasMany(Venda::class); }
public function movimentacoes() { return $this->hasMany(MovimentacaoPontos::class); }
public function resgates() { return $this->hasMany(Resgate::class); }
```

### Produto
```php
// app/Models/Produto.php
$fillable = ['nome', 'descricao', 'preco', 'pontos_compra', 'pontos_resgate', 'imagem'];

// Relações
public function itens() { return $this->hasMany(ItemVenda::class); }
```

### Venda
```php
// app/Models/Venda.php
$fillable = ['cliente_id', 'valor_total'];

// Relações
public function cliente() { return $this->belongsTo(Cliente::class); }
public function itens() { return $this->hasMany(ItemVenda::class); }
```

### ItemVenda
```php
// app/Models/ItemVenda.php
$fillable = ['venda_id', 'produto_id', 'quantidade', 'valor_unitario', 'subtotal'];
```

### MovimentacaoPontos
```php
// app/Models/MovimentacaoPontos.php
$fillable = ['cliente_id', 'tipo', 'pontos', 'descricao'];
// tipo: 'credito' | 'debito'
```

### Resgate
```php
// app/Models/Resgate.php
$fillable = ['cliente_id', 'produto_id', 'pontos_utilizados'];
```

---

## 🌐 Rotas Principais

```php
// routes/web.php

GET  /                          → DashboardController@index (dashboard)
GET  /historico-vendas          → DashboardController@historicoVendas
GET  /cadastro-cliente          → DashboardController@cadastroCliente
POST /cadastro-cliente          → DashboardController@storeCliente
GET  /registro-de-vendas        → DashboardController@registroVendas
POST /registro-de-vendas        → DashboardController@storeVenda

GET  /produtos                  → ProdutosController@index
GET  /produtos/criar            → ProdutosController@create
POST /produtos                  → ProdutosController@store
GET  /produtos/{id}             → ProdutosController@show
GET  /produtos/{id}/editar      → ProdutosController@edit
PUT  /produtos/{id}             → ProdutosController@update
```

---

## 💾 Storage

### Estrutura de Diretórios
```
storage/app/public/
├── clientes/          (Fotos de clientes)
│   └── {uuid}.jpg
├── produtos/          (Fotos de produtos)
│   └── {uuid}.jpg
└── users/             (Fotos de admins, se implementado)
    └── {uuid}.jpg

public/storage        → Symlink para storage/app/public/
                       (criado via: php artisan storage:link)
```

### URLs Públicas
- Foto cliente: `/storage/clientes/filename.jpg`
- Foto produto: `/storage/produtos/filename.jpg`

---

## 🚀 Como Rodar

### Pré-requisitos
- PHP 8.1+
- MySQL 8.0+
- Composer
- Node.js (para assets, se usar npm)

### Setup Inicial
```bash
# 1. Clone e instale dependências
git clone <repo>
cd pi-cafelo
composer install

# 2. Configure .env
cp .env.example .env
php artisan key:generate

# 3. Banco de dados
php artisan migrate

# 4. Storage Link (para imagens públicas)
php artisan storage:link

# 5. Rode o servidor
php artisan serve
# Acesso: http://localhost:8000
```

### Comandos Úteis
```bash
php artisan migrate              # Roda todas as migrations
php artisan migrate:fresh        # Reset do DB + roda migrations
php artisan tinker               # REPL interativo (teste models)
php artisan view:clear           # Limpa cache de Blade
php artisan cache:clear          # Limpa cache geral
php artisan make:migration name  # Cria nova migration
php artisan make:model Name      # Cria novo model
```

---

## 📈 Fluxo de Dados: Exemplo Prático

### Cenário: Maria compra 1 Café + 1 Bolo

**Passo 1:** Maria acessa `/registro-de-vendas`
- View renderiza com:
  - `$produtos` = [Café (R$5, +10pts), Bolo (R$8, +5pts), ...]
  - `$clientes` = [Maria, João, ...]

**Passo 2:** Maria seleciona café e bolo no carrinho
- JavaScript atualiza estado `carrinho`:
  ```js
  {
    "1": { id: 1, nome: "Café", preco: 5, pontos: 10, quantidade: 1 },
    "2": { id: 2, nome: "Bolo", preco: 8, pontos: 5, quantidade: 1 }
  }
  ```
- JS calcula: Total = R$13, Pontos = 15

**Passo 3:** Maria seleciona ela mesma no dropdown e clica "Finalizar Venda"
- Form submit POST `/registro-de-vendas` com:
  ```
  cliente_id: 1
  items[0][produto_id]: 1
  items[0][quantidade]: 1
  items[1][produto_id]: 2
  items[1][quantidade]: 1
  ```

**Passo 4:** `DashboardController::storeVenda()` processa
- Valida request
- Inicia `DB::transaction()`:
  1. Cria `Venda` com `cliente_id=1, valor_total=0`
  2. Cria 2 `ItemVenda` (Café e Bolo)
  3. Atualiza `Venda.valor_total = 13`
  4. Cria `MovimentacaoPontos` com `tipo='credito', pontos=15`
  5. `Cliente.saldo_pontos += 15`
- Redireciona com mensagem de sucesso

**Passo 5:** Dashboard reflete mudança
- Próximo acesso a `/` mostra:
  - "Vendas Hoje: R$ 13"
  - "Pontos Distribuídos: +15"
  - Transação recente: "Maria - Venda - R$ 13 - Concluído"

---

## 🔐 Segurança

- ✅ **Validação de Input:** Todos os formulários validam no controller
- ✅ **CSRF Protection:** `@csrf` em todas as forms
- ✅ **SQL Injection:** Eloquent ORM previne via parameterized queries
- ✅ **File Upload:** Validação de tipo/tamanho antes de store
- ✅ **Transactions:** Vendas usam `DB::transaction()` para atomicidade

---

## 📝 Próximas Features (Roadmap)

- [ ] Autenticação de admin (login/logout)
- [ ] Permissões por role (admin, gerente, operador)
- [ ] Crop de imagem com preview
- [ ] Relatórios PDF (vendas, clientes)
- [ ] Integração com payment gateway
- [ ] API REST para mobile app
- [ ] Notificações por email/SMS
- [ ] Backup automático do DB

---

## 📞 Contato/Suporte

Para dúvidas, abra uma issue no repositório ou entre em contato.

---

**Última atualização:** 12/06/2026
**Versão:** 1.0.0
