<div>
    <x-app-layout>
        <div class="flex flex-col space-y-6">

            <!-- Estadísticas del Panel -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2a gap-6">
                <!-- Total de Clientes -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold text-gray-800">Total de Clientes</h2>
                    <p class="text-3xl font-bold text-blue-600">{{ count($clients) }}</p>
                </div>

                <!-- Total de Compras -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold text-gray-800">Total de Compras</h2>
                    <p class="text-3xl font-bold text-green-600">{{ count($totalOrder) }}</p>
                </div>

            </div>

            <!-- Tabla de Clientes -->
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200 mt-6">
                <table class="min-w-full text-sm text-left text-gray-500">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-4 font-medium text-gray-900">Número de Identidad</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Email</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Nombre</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Teléfono</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Valor de la Compra</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $client->number_identity }}</td>
                                <td class="px-6 py-4">{{ $client->email_client }}</td>
                                <td class="px-6 py-4">{{ $client->name_client }}</td>
                                <td class="px-6 py-4">{{ $client->phone_client }}</td>
                                <td class="px-6 py-4">{{ number_format($client->total_purchase_value, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-app-layout>
</div>
