
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Factura</title>
    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Estilos / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-50 via-indigo-100 to-purple-50 min-h-screen flex items-center justify-center font-sans antialiased">
    <div class="bg-white shadow-lg rounded-lg max-w-md w-full border border-gray-200">
        <header class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center py-6 rounded-t-lg">
            <h1 class="text-4xl font-bold">E-Factura</h1>
            <p class="text-sm mt-2">Simplificando tu facturación electrónica</p>
        </header>
        <main class="px-8 py-6">
            <h2 class="text-xl font-semibold text-gray-800 text-center mb-4">Bienvenido</h2>
            @if (Route::has('login'))
                <div class="flex justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="inline-block w-full text-center px-4 py-2 bg-indigo-600 text-white rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Ir al Panel de Control
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-block w-full text-center px-4 py-2 bg-indigo-600 text-white rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Iniciar Sesión
                        </a>
                    @endauth
                </div>
            @endif
        </main>
        <footer class="bg-gray-100 text-gray-600 text-center py-4 rounded-b-lg text-sm">
            &copy; {{ date('Y') }} E-Factura. Todos los derechos reservados.
        </footer>
    </div>
</body>

</html>
