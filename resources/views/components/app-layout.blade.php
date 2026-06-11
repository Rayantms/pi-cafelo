@props([
    'titulo' => 'Cafélo',
])

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titulo }} | {{ config('app.name') }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>
<body class="bg-slate-50 text-slate-900 font-sans">

    <x-sidebar />

    <main class="ml-[280px] min-h-screen">

        <x-navbar :titulo="$titulo" />

        <div class="p-8">
            {{ $slot }}
        </div>

    </main>

</body>
</html>