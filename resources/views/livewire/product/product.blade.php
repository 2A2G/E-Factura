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
                    wire:click="openCreateCategoryModal">Agregar Productos</button>
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


        <x-modal wire:model="isModalOpen">
            <div class="p-6">
                <form wire:submit.prevent="saveCategory">
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Nombre de la Categoría</label>
                        <input type="text" class="mt-2 w-full p-3 border border-gray-300 rounded-lg"
                            wire:model="categoryName" required>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="button"
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600"
                            wire:click="closeModal">Cancelar</button>
                        <button type="submit"
                            class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600">Guardar</button>
                    </div>
                </form>
            </div>
        </x-modal>

    </x-app-layout>
</div>
