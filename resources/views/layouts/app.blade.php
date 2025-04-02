<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    </head>
    <body class="font-sans antialiased">
        <div class="d-flex">
            {{-- Sidebar --}}
            <nav class="sidebar bg-dark text-white p-3" style="width: 220px; min-height: 100vh;">
                <h5 class="mb-4 text-white">🍽 Restaurante FL</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ route('dashboard') }}" class="nav-link text-white">📊 Dashboard</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('categorias.index') }}" class="nav-link text-white">📂 Categoría</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('clientes.index') }}" class="nav-link text-white">👤 Cliente</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('compras.index') }}" class="nav-link text-white">🛒 Compra</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('facturas.index') }}" class="nav-link text-white">🧾 Factura</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('ingredientes.index') }}" class="nav-link text-white">🧂 Ingrediente</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('productos.index') }}" class="nav-link text-white">🍽 Producto</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('proveedores.index') }}" class="nav-link text-white">🏢 Proveedor</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('recetas.index') }}" class="nav-link text-white">🧪 Receta</a>
                    </li>
                </ul>
            </nav>

            {{-- Contenido principal --}}
            <div class="flex-grow-1">
                <x-banner />
                <main class="p-4">
                    @yield('content')
                </main>
            </div>
        </div>

        @livewireScripts

    <!-- jQuery y Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('scripts') {{-- Para scripts adicionales --}}

    </body>

</html>
