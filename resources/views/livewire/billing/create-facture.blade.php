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
                    <p class="text-2xl font-bold text-green-600">${{ number_format($totalAmount, 3) }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-gray-600 text-lg font-medium">Promedio por Compra</h2>
                    <p class="text-2xl font-bold text-purple-600">${{ number_format($averagePurchase, 3) }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Panel de Compras</h1>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    wire:click="openCreatePurchase">
                    Registrar Compra
                </button>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 mt-6">
                <table class="min-w-full text-sm text-left text-gray-500 border-collapse">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left">Cliente</th>
                            <th class="px-4 py-2 text-left">Fecha</th>
                            <th class="px-4 py-2 text-right">Valor de la compra</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($purchases as $purchase)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $purchase->client->name_client }}</td>
                                <td class="px-4 py-2">{{ $purchase->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-2 text-right">
                                    ${{ number_format($purchase->orders->sum('total_price'), 3) }}</td>
                                </td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <a href="{{ route('viewFacture', $purchase->id) }}"
                                        class="text-blue-600 hover:text-blue-800" title="Ver más detalles de la compra">
                                        Ver Detalles
                                    </a>
                                    <button class="text-green-600 hover:text-green-800"
                                        wire:click="viewInvoice({{ $purchase->id }})"
                                        title="Ver la factura electrónica">
                                        Ver Factura
                                    </button>

                                    {{-- <button class="text-red-600 hover:text-red-800"
                                        wire:click="deletePurchase({{ $purchase->id }})">
                                        Eliminar
                                    </button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $purchases->links() }}
                </div>
            </div>
        </div>

        <x-dialog-modal wire:model="openPurchase" class="fixed inset-0 flex items-center justify-center z-50">
            <x-slot name="title">
                @if ($currentStep === 1)
                    <h1 class="text-lg font-medium">Datos del Cliente</h1>
                @elseif ($currentStep === 2)
                    <h1 class="text-lg font-medium">Datos del Producto</h1>
                @else
                    <h1 class="text-lg font-medium">Datos de pago</h1>
                @endif
            </x-slot>

            <x-slot name="content">
                @if ($currentStep === 1)
                    <div class="mb-4">
                        <label for="type_identity" class="block text-gray-600 font-semibold mb-2 text-left">Tipo de
                            Identidad</label>
                        <select id="type_identity" wire:model="type_identity"
                            class="border border-gray-300 rounded px-3 py-2 w-full">
                            <option selected disabled value="">Seleccione el tipo de Identidad</option>
                            <option value="1">Registro civil</option>
                            <option value="2">Tarjeta de identidad</option>
                            <option value="3">Cédula ciudadanía</option>
                            <option value="4">Tarjeta de extranjería</option>
                            <option value="5">Cédula de extranjería</option>
                            <option value="6">NIT</option>
                            <option value="7">Pasaporte</option>
                            <option value="8">Documento de identificación extranjero</option>
                            <option value="9">PEP</option>
                            <option value="10">NIT otro país</option>
                            <option value="11">NUIP *</option>
                        </select>
                        @error('type_identity')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="number_identity" class="block text-gray-600 font-semibold mb-2 text-left">Número de
                            Identidad</label>
                        <input id="number_identity" type="text" wire:model="number_identity"
                            class="border border-gray-300 rounded px-3 py-2 w-full">
                        @error('number_identity')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email_client" class="block text-gray-600 font-semibold mb-2 text-left">Correo
                            Electrónico</label>
                        <input id="email_client" type="email" wire:model="email_client"
                            class="border border-gray-300 rounded px-3 py-2 w-full">
                        @error('email_client')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="name_client" class="block text-gray-600 font-semibold mb-2 text-left">Nombre del
                            Cliente</label>
                        <input id="name_client" type="text" wire:model="name_client"
                            class="border border-gray-300 rounded px-3 py-2 w-full">
                        @error('name_client')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone_client"
                            class="block text-gray-600 font-semibold mb-2 text-left">Teléfono</label>
                        <input id="phone_client" type="text" wire:model="phone_client"
                            class="border border-gray-300 rounded px-3 py-2 w-full">
                        @error('phone_client')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address_client"
                            class="block text-gray-600 font-semibold mb-2 text-left">Dirección</label>
                        <input id="address_client" type="text" wire:model="address_client"
                            class="border border-gray-300 rounded px-3 py-2 w-full">
                        @error('address_client')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                @elseif($currentStep === 2)
                    <div>
                        <div class="mb-4">
                            <label for="searchProduct" class="block text-gray-600 font-semibold mb-2 text-left">Buscar
                                Producto</label>
                            <input type="text" id="searchProduct" wire:model.defer="searchQuery"
                                class="border border-gray-300 rounded px-3 py-2 w-full"
                                placeholder="Buscar por código o nombre">
                            <button type="button" wire:click="searchProduct"
                                class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Buscar
                            </button>
                        </div>

                        @if ($searchResults && count($searchResults) > 0)
                            <div class="mb-4 overflow-x-auto">
                                <table class="w-full border border-gray-300 rounded">
                                    <thead class="bg-gray-100 text-left">
                                        <tr>
                                            <th class="px-4 py-2">Código</th>
                                            <th class="px-4 py-2">Nombre</th>
                                            <th class="px-4 py-2">Precio Unitario</th>
                                            <th class="px-4 py-2">Cantidad</th>
                                            <th class="px-4 py-2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($searchResults as $result)
                                            <tr>
                                                <td class="px-4 py-2">{{ $result['code_product'] }}</td>
                                                <td class="px-4 py-2">{{ $result['name_product'] }}</td>
                                                <td class="px-4 py-2">
                                                    ${{ number_format($result['price_product'], 3) }}</td>

                                                <td class="px-4 py-2">
                                                    <input type="number" min="1"
                                                        max="{{ $result['quantity_products'] }}"
                                                        wire:model="quantities"
                                                        class="border border-gray-300 rounded px-2 py-1 w-20">

                                                <td class="px-4 py-2">
                                                    <button type="button"
                                                        wire:click="addProduct('{{ $result['id'] }}')"
                                                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                                        Agregar
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @error('cart')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if ($selectedProduct)
                            <div class="mb-4">
                                <p><strong>Precio Unitario:</strong> ${{ $selectedProduct->price_product }}</p>
                                <label for="quantity" class="block text-gray-600 font-semibold mb-2">Cantidad</label>
                                <input type="number" id="quantity" wire:model="quantity"
                                    class="border border-gray-300 rounded px-3 py-2 w-full" min="1">
                                <button wire:click="addToCart"
                                    class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Agregar</button>
                            </div>
                        @endif

                        <table class="w-full border-collapse border border-gray-300 mt-4">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2">Código</th>
                                    <th class="border border-gray-300 px-4 py-2">Nombre</th>
                                    <th class="border border-gray-300 px-4 py-2">Cantidad</th>
                                    <th class="border border-gray-300 px-4 py-2">Valor Unitario</th>
                                    <th class="border border-gray-300 px-4 py-2">Total</th>
                                    <th class="border border-gray-300 px-4 py-2">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $item)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $item['code_product'] }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $item['name_product'] }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $item['quantity'] }}</td>
                                        <td class="border border-gray-300 px-4 py-2">${{ $item['price_product'] }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">${{ $item['total'] }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <button wire:click="removeFromCart({{ $item['id'] }})"
                                                class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4 text-right">
                            <span class="font-bold text-lg">Total de la compra: ${{ $totalCartAmount }}</span>
                        </div>
                    </div>
                @else
                    <div>
                        <div class="mb-4">
                            <label for="payment_method"
                                class="block text-gray-600 font-semibold mb-2 text-left">Selecciona el Método de
                                Pago</label>
                            <select id="payment_method" wire:model.lazy="payment_method"
                                class="border border-gray-300 rounded px-3 py-2 w-full">
                                <option value="">Selecciona un método de pago</option>
                                <option value="10">Efectivo</option>
                                <option value="tarjeta">Tarjeta</option>
                                <option value="47">Transferencia</option>
                            </select>
                        </div>

                        @if ($payment_method == 'tarjeta')
                            <div class="mb-4">
                                <label for="credit_card_type"
                                    class="block text-gray-600 font-semibold mb-2 text-left">Tipo de Tarjeta</label>
                                <select id="credit_card_type" wire:model="credit_card_type"
                                    class="border border-gray-300 rounded px-3 py-2 w-full">
                                    <option value="">Selecciona el tipo de tarjeta</option>
                                    <option value="48">Crédito</option>
                                    <option value="debito">Débito</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="bank_type"
                                    class="block text-gray-600 font-semibold mb-2 text-left">Selecciona
                                    el Banco</label>
                                <select id="bank_type" wire:model="bank_type"
                                    class="border border-gray-300 rounded px-3 py-2 w-full">
                                    <option disabledselected value="">Selecciona un banco</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank }}">{{ $bank }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                    </div>
                @endif
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-end space-x-2">
                    @if ($currentStep > 1)
                        <button wire:click="previousStep"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                            Atrás
                        </button>
                    @endif

                    @if ($currentStep === 1 || $currentStep === 2)
                        <button wire:click="nextStep"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Siguiente
                        </button>
                    @elseif ($currentStep === 3)
                        <button wire:click="store"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Guardar Producto
                        </button>
                    @endif
                </div>

            </x-slot>
        </x-dialog-modal>

    </x-app-layout>
</div>
