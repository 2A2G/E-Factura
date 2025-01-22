<div>
    <x-app-layout>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Productos Totales</h3>
                <p class="mt-4 text-3xl font-bold text-blue-600">{{ count($products) }}</p>
                <p class="mt-2 text-gray-500">Total de productos.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Productos Activos</h3>
                <p class="mt-4 text-3xl font-bold text-green-600">
                    {{ \App\Models\Product::whereNull('deleted_at')->count() }}</p>
                <p class="mt-2 text-gray-500">Total de productos disponibles en el inventario.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h3 class="text-xl font-semibold text-red-700 mb-4">Productos Agotados</h3>
                <p class="mt-4 text-3xl font-bold text-red-600">{{ $productExhausted }}</p>
                <p class="mt-2 text-gray-500">Total de productos agotados en el inventario.</p>
            </div>

        </div>

        <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-md border border-gray-200 mt-6">
            <h2 class="text-2xl font-semibold text-gray-700">Productos</h2>
            <div>
                <button
                    class="px-4 py-2 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600 focus:outline-none"
                    wire:click="openCreateProduct">Agregar Productos</button>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200 mt-4">
            <input type="text" class="w-full p-2 border border-gray-300 rounded-lg"
                placeholder="Buscar por nombre de categoría..." wire:model="search">
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 mt-6">
            <table class="min-w-full text-sm text-left text-gray-500 border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 text-center">Categoría</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 text-center">Código</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 text-center">Producto</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 text-center">Cantidad</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 text-center">Estado</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3 text-center font-medium text-gray-900">
                                {{ $product->typeProduct->product_type_name }}
                            </td>
                            <td class="px-4 py-3 text-center">{{ $product->code_product }}</td>
                            <td class="px-4 py-3 text-center">{{ $product->name_product }}</td>
                            <td class="px-4 py-3 text-center">
                                {{ $product->quantity_products > 0 ? $product->quantity_products : 'Agotado' }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $product->deleted_at ? 'bg-red-500 text-white' : 'bg-blue-500 text-white' }}">
                                    {{ $product->deleted_at ? 'Eliminado' : 'Activo' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if (!$product->deleted_at)
                                    <button wire:click="openModalUpdateCategory({{ $product->id }})"
                                        class="px-2 py-1 text-sm font-medium text-blue-600 hover:text-blue-800">
                                        Ver Detalles
                                    </button>
                                    <button wire:click="openModalDeleteCategory({{ $product->id }})"
                                        class="px-2 py-1 text-sm font-medium text-red-600 hover:text-red-800">
                                        Eliminar
                                    </button>
                                @else
                                    <span class="text-gray-400 text-sm cursor-not-allowed">Eliminado</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <x-dialog-modal wire:model="openProduct" class="fixed inset-0 flex items-center justify-center z-50">
            <x-slot name="title">
                <h1 class="text-lg font-medium">Registrar Producto</h1>
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <label for="type_products_id" class="block text-gray-600 font-semibold mb-2 text-left">Tipo de
                        Producto</label>
                    <select id="type_products_id" wire:model="type_products_id"
                        class="border border-gray-300 rounded px-3 py-2 w-full">
                        <option value="">Selecciona un tipo</option>
                        @foreach ($typeProducts as $typeProduct)
                            <option value="{{ $typeProduct->id }}">{{ $typeProduct->product_type_name }}</option>
                        @endforeach
                    </select>
                    @error('type_products_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="code_product" class="block text-gray-600 font-semibold mb-2 text-left">Código del
                        Producto</label>
                    <input id="code_product" type="text" wire:model="code_product"
                        class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Ejemplo: DVU-8896"
                        maxlength="8" oninput="formatCodeProduct(this)" pattern="^[A-Z0-9-]+$"
                        title="El código no puede contener espacios ni caracteres especiales">
                    @error('code_product')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <script>
                    function formatCodeProduct(input) {
                        let value = input.value.toUpperCase();

                        value = value.replace(/[^A-Z0-9]/g, '');

                        if (value.length > 3) {
                            value = value.slice(0, 3) + '-' + value.slice(3, 8);
                        }
                        if (value.length > 8) {
                            value = value.slice(0, 8);
                        }
                        input.value = value;
                    }
                </script>

                <div class="mb-4">
                    <label for="name_product" class="block text-gray-600 font-semibold mb-2 text-left">Nombre del
                        Producto</label>
                    <input id="name_product" type="text" wire:model="name_product"
                        class="border border-gray-300 rounded px-3 py-2 w-full">
                    @error('name_product')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price_product" class="block text-gray-600 font-semibold mb-2 text-left">Precio del
                        Producto</label>
                    <input id="price_product" type="number" wire:model="price_product"
                        class="border border-gray-300 rounded px-3 py-2 w-full">
                    @error('price_product')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="quantity_products" class="block text-gray-600 font-semibold mb-2 text-left">Cantidad del
                        Producto</label>
                    <input id="quantity_products" type="number" wire:model="quantity_products"
                        class="border border-gray-300 rounded px-3 py-2 w-full">
                    @error('quantity_products')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-end">
                    <button wire:click="store"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Guardar Producto
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>



        <x-dialog-modal wire:model="openDeleteCategory" class="fixed inset-0 flex items-center justify-center">
            <x-slot name="title">
                <h1 class="text-lg font-semibold">¿Eliminar Categoría?</h1>
            </x-slot>
            <x-slot name="content">
                <p class="text-gray-700 text-center mb-4">Esta acción no se puede deshacer.</p>
                <div class="flex justify-center gap-4">
                    <button wire:click="$set('openDeleteCategory', false)"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Cancelar</button>
                    <button wire:click="delete" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Eliminar
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>

    </x-app-layout>
</div>
