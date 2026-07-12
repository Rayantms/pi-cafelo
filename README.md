# Sistema de Fidelidade para Cafeteria

## Sobre o Projeto

Este projeto consiste em um **MVP (Minimum Viable Product)** de um sistema de fidelidade para uma cafeteria, desenvolvido com o objetivo de incentivar a fidelização dos clientes por meio de um programa de pontos.

No sistema, o cliente pode realizar seu cadastro, acumular pontos a cada compra e posteriormente trocar esses pontos por recompensas disponibilizadas pela cafeteria.

## Funcionalidades

- Cadastro de clientes;
- Acúmulo de pontos de fidelidade;
- Consulta do saldo de pontos;
- Resgate de recompensas.

## Tecnologias Utilizadas

- PHP
- Laravel
- HTML5
- CSS3
- Bootstrap
- MySQL

## Como Executar o Projeto

1. Clone este repositório:

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
```

2. Acesse a pasta do projeto:

```bash
cd nome-do-projeto
```

3. Instale as dependências:

```bash
composer install
```

4. Configure o arquivo `.env`:

```bash
cp .env.example .env
```

5. Gere a chave da aplicação:

```bash
php artisan key:generate
```

6. Configure as informações do banco de dados no arquivo `.env`.

7. Execute as migrations:

```bash
php artisan migrate
```

8. Inicie o servidor:

```bash
php artisan serve
```

A aplicação estará disponível em:

```
http://localhost:8000
```

##  Objetivo

O principal objetivo deste MVP é demonstrar o funcionamento básico de um sistema de fidelidade, permitindo o cadastro de clientes e o gerenciamento de pontos para troca por recompensas.

## Desenvolvedores

Projeto desenvolvido pelos alunos do **SENAC Casa do Comércio**, durante o curso de **Programador Full Stack**.

## Licença

Este projeto foi desenvolvido para fins educacionais.
