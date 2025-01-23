<div>
    <x-app-layout>
        <div class="container mx-auto py-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-gray-600 text-lg font-medium">Total de Compras</h2>
                    <p class="text-2xl font-bold text-blue-600">{{ count($purchases) }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-gray-600 text-lg font-medium">Monto Total</h2>
                    <p class="text-2xl font-bold text-green-600">${{ number_format($totalAmount, 2) }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-gray-600 text-lg font-medium">Promedio por Compra</h2>
                    <p class="text-2xl font-bold text-purple-600">${{ number_format($averagePurchase, 2) }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Panel de Compras</h1>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    wire:click="openCreatePurchaseModal">
                    Registrar Compra
                </button>
            </div>


            <!-- Tabla de Compras -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Cliente</th>
                            <th class="px-4 py-2 text-left">Fecha</th>
                            <th class="px-4 py-2 text-right">Total a Pagar</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($purchases as $purchase)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $purchase->client->name_client }}</td>
                                <td class="px-4 py-2">{{ $purchase->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-2 text-right">${{ number_format($purchase->total, 2) }}</td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <button class="text-blue-600 hover:text-blue-800"
                                        wire:click="viewDetails({{ $purchase->id }})">
                                        Ver Detalles
                                    </button>
                                    <button class="text-green-600 hover:text-green-800"
                                        wire:click="viewInvoice({{ $purchase->id }})">
                                        Ver Factura
                                    </button>
                                    <button class="text-red-600 hover:text-red-800"
                                        wire:click="deletePurchase({{ $purchase->id }})">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{-- {{ $purchases->links() }} --}}
            </div>
        </div>
    </x-app-layout>
</div>
