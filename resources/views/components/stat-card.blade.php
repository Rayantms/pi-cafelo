@props([
    'titulo',
    'valor',
    'icone'
])

<div class="bg-white rounded-xl shadow p-6">

    <div class="flex justify-between">

        <span class="material-symbols-outlined">
            {{ $icone }}
        </span>

    </div>

    <div class="mt-4">

        <p class="text-sm text-gray-500">
            {{ $titulo }}
        </p>

        <h3 class="text-2xl font-bold">
            {{ $valor }}
        </h3>

    </div>

</div>