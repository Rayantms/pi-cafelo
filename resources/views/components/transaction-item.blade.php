@props([
    'cliente',
    'tipo',
    'valor'
])

<li class="flex justify-between">

    <div>

        <p>{{ $cliente }}</p>

        <small>{{ $tipo }}</small>

    </div>

    <strong>{{ $valor }}</strong>

</li>