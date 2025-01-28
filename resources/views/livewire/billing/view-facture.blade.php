<div>
    <x-app-layout>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Datos de las facturas generadas</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 mt-6">
            @if (empty($dataFactures))
                <div class="text-center text-gray-500 py-6">
                    <p>No hay datos disponibles para mostrar.</p>
                </div>
            @else
                <table class="min-w-full text-sm text-left text-gray-500 border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Id</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Numero de Factura</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Numero Identidad</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Nombre</th>
                            <th class="px-4 py-3 text-right text-sm font-medium text-gray-600">Valor de la compra</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Estado</th>
                            <th class="px-4 py-3 text-center text-sm font-medium text-gray-600">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($dataFactures as $facture)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $facture['id'] }}</td>
                                <td class="px-4 py-3">{{ $facture['number'] }}</td>
                                <td class="px-4 py-3">{{ $facture['identification'] }}</td>
                                <td class="px-4 py-3">{{ $facture['names'] }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($facture['total'], 2) }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span
                                        class="px-3 py-1 text-white rounded-full
                                        @if ($facture['status'] == 1) bg-green-500
                                        @elseif($facture['status'] == 0) bg-red-600 @endif">
                                        @if ($facture['status'] == 1)
                                            Enviado
                                        @elseif($facture['status'] == 0)
                                            No Enviado
                                        @endif
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center space-x-2">
                                    @if ($facture['status'] == 0)
                                        <a href="{{ route('facture', $facture['number']) }}"
                                            class="text-blue-600 hover:text-blue-800 cursor-not-allowed opacity-50"
                                            title="Factura no enviada, no se puede ver">
                                            Ver Factura
                                        </a>
                                    @else
                                        <a href="{{ route('facture', $facture['number']) }}"
                                            class="text-blue-600 hover:text-blue-800"
                                            title="Ver más detalles de la factura">
                                            Ver Factura
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            {{-- <div class="mt-6">
                @if ($pagination['total'] > 0)
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-4">
                            @if ($pagination['current_page'] > 1)
                                <a href="{{ route('getFacture', ['page' => $pagination['current_page'] - 1]) }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Página anterior
                                </a>
                            @endif
                            @if ($pagination['current_page'] < $pagination['last_page'])
                                <a href="{{ route('getFacture', ['page' => $pagination['current_page'] + 1]) }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Página siguiente
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div> --}}
        </div>
    </x-app-layout>
</div>
