# Sistema de Fidelidade para Cafeteria - Setup Laravel

## 1. Criar Projeto

```bash
composer create-project laravel/laravel cafeteria-fidelidade

cd cafeteria-fidelidade
```

---

## 2. Configurar Autenticação

```bash
composer require laravel/breeze --dev

php artisan breeze:install

npm install

npm run build

php artisan migrate
```

---

## 3. Criar Models e Migrations

### Cliente

```bash
php artisan make:model Cliente -m
```

### Produto

```bash
php artisan make:model Produto -m
```

### Venda

```bash
php artisan make:model Venda -m
```

### ItemVenda

```bash
php artisan make:model ItemVenda -m
```

### Resgate

```bash
php artisan make:model Resgate -m
```

### MovimentacaoPontos

```bash
php artisan make:model MovimentacaoPontos -m
```

---

## 4. Editar Migration de Clientes

Arquivo:

```text
database/migrations/xxxx_xx_xx_create_clientes_table.php
```

Conteúdo:

```php
Schema::create('clientes', function (Blueprint $table) {
    $table->id();

    $table->string('nome');

    $table->string('email')->nullable();

    $table->string('telefone')->nullable();

    $table->integer('saldo_pontos')
        ->default(0);

    $table->timestamps();
});
```

---

## 5. Editar Migration de Produtos

Arquivo:

```text
database/migrations/xxxx_xx_xx_create_produtos_table.php
```

Conteúdo:

```php
Schema::create('produtos', function (Blueprint $table) {
    $table->id();

    $table->string('nome');

    $table->text('descricao')
        ->nullable();

    $table->decimal('preco', 10, 2);

    $table->integer('pontos_compra')
        ->default(0);

    $table->integer('pontos_resgate')
        ->default(0);

    $table->timestamps();
});
```

---

## 6. Editar Migration de Vendas

Arquivo:

```text
database/migrations/xxxx_xx_xx_create_vendas_table.php
```

Conteúdo:

```php
Schema::create('vendas', function (Blueprint $table) {
    $table->id();

    $table->foreignId('cliente_id')
        ->constrained('clientes')
        ->cascadeOnDelete();

    $table->decimal('valor_total', 10, 2);

    $table->timestamps();
});
```

---

## 7. Editar Migration de Itens da Venda

Arquivo:

```text
database/migrations/xxxx_xx_xx_create_item_vendas_table.php
```

Conteúdo:

```php
Schema::create('itens_venda', function (Blueprint $table) {
    $table->id();

    $table->foreignId('venda_id')
        ->constrained('vendas')
        ->cascadeOnDelete();

    $table->foreignId('produto_id')
        ->constrained('produtos')
        ->cascadeOnDelete();

    $table->integer('quantidade')
        ->default(1);

    $table->decimal('valor_unitario', 10, 2);

    $table->decimal('subtotal', 10, 2);

    $table->timestamps();
});
```

---

## 8. Editar Migration de Resgates

Arquivo:

```text
database/migrations/xxxx_xx_xx_create_resgates_table.php
```

Conteúdo:

```php
Schema::create('resgates', function (Blueprint $table) {
    $table->id();

    $table->foreignId('cliente_id')
        ->constrained('clientes')
        ->cascadeOnDelete();

    $table->foreignId('produto_id')
        ->constrained('produtos')
        ->cascadeOnDelete();

    $table->integer('pontos_utilizados');

    $table->timestamps();
});
```

---

## 9. Editar Migration de Movimentações de Pontos

Arquivo:

```text
database/migrations/xxxx_xx_xx_create_movimentacao_pontos_table.php
```

Conteúdo:

```php
Schema::create('movimentacoes_pontos', function (Blueprint $table) {
    $table->id();

    $table->foreignId('cliente_id')
        ->constrained('clientes')
        ->cascadeOnDelete();

    $table->enum('tipo', [
        'credito',
        'debito'
    ]);

    $table->integer('pontos');

    $table->string('descricao');

    $table->timestamps();
});
```

---

## 10. Executar Migrations

```bash
php artisan migrate
```

---

## 11. Criar Controllers Resource

```bash
php artisan make:controller ClienteController --resource

php artisan make:controller ProdutoController --resource

php artisan make:controller VendaController --resource

php artisan make:controller ResgateController --resource

php artisan make:controller MovimentacaoPontosController --resource
```

---

## 12. Criar Seeders de Exemplo

```bash
php artisan make:seeder ProdutoSeeder

php artisan make:seeder ClienteSeeder
```

---

## 13. Executar Seeders

```bash
php artisan db:seed
```

---

## 14. Executar Sistema

```bash
php artisan serve
```

Acesso:

http://127.0.0.1:8000

```
```
