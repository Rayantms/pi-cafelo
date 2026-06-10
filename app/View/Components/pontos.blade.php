<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Programa de Fidelidade</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white">
            <h3>☕ Programa de Fidelidade</h3>
        </div>

        <div class="card-body text-center">

            <h2>{{ $cliente->nome }}</h2>

            <div class="display-1 text-success fw-bold">
                {{ $cliente->pontos }}
            </div>

            <h4>Pontos Acumulados</h4>

            <hr>

            <div class="progress" style="height:30px;">
                <div
                    class="progress-bar bg-success"
                    role="progressbar"
                    style="width: {{ min(($cliente->pontos / 100) * 100, 100) }}%">
                    {{ $cliente->pontos }}/100
                </div>
            </div>

            <p class="mt-3 text-muted">
                Ao atingir 100 pontos você ganha um café grátis.
            </p>

        </div>
    </div>

</div>

</body>
</html>