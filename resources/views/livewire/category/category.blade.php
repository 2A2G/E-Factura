<div>
    <x-app-layout>

        <div class="flex-1 p-6 ml-4">
            <div class="max-w-7xl mx-auto space-y-6">
                <!-- Título del Panel -->
                <h1 class="text-3xl font-semibold text-gray-900">Panel Administrativo del Supermercado</h1>

                <!-- Tarjetas de información general -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Card 1: Total de Productos -->
                    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-700">Total de Productos</h2>
                        <p class="mt-4 text-3xl font-bold text-blue-600">1,250</p>
                        <p class="mt-2 text-gray-500">Total de productos disponibles en el inventario.</p>
                    </div>

                    <!-- Card 2: Total de Categorías -->
                    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-700">Total de Categorías</h2>
                        <p class="mt-4 text-3xl font-bold text-green-600">12</p>
                        <p class="mt-2 text-gray-500">Número total de categorías de productos.</p>
                    </div>

                    <!-- Card 3: Productos más vendidos -->
                    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-700">Productos Más Vendidos</h2>
                        <p class="mt-4 text-3xl font-bold text-orange-600">250</p>
                        <p class="mt-2 text-gray-500">Productos con mayores ventas en la última semana.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

</div>
