<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'UK Churches') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('head')  {{-- para estilos especificos do component --}}
</head>
<body class="">
    <div id="app">
        @include('components.partials.navbar') <!-- Ajuste o caminho conforme a estrutura -->
        <main class="">
            @yield('content') <!-- Conteúdo específico da página -->
        </main>
    </div>
    <x-partials.footer/>
    @stack('scripts') {{-- Para scripts específicos do componente --}}
</body>
</html>
