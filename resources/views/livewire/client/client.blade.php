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
                            <th class="px-6 py-4 font-medium text-gray-900">Tipo de Identidad</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Número de Identidad</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Email</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Nombre</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Teléfono</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Total Compras</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $client->type_indentity }}</td>
                                <td class="px-6 py-4">{{ $client->number_identity }}</td>
                                <td class="px-6 py-4">{{ $client->email_client }}</td>
                                <td class="px-6 py-4">{{ $client->name_client }}</td>
                                <td class="px-6 py-4">{{ $client->phone_client }}</td>
                                <td class="px-6 py-4">{{ $client->purchases_count }}</td>
                                <td class="px-6 py-4">
                                    <button class="text-blue-500 hover:underline">Ver Detalles</button>
                                    <button class="ml-2 text-red-500 hover:underline">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-app-layout>
</div>
