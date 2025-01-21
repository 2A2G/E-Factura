<div>
    <x-app-layout>
        <!-- Barra superior con métricas de productos y categorías -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Tarjeta de Productos Totales -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Productos Totales</h3>
                {{-- <p class="text-3xl font-bold text-gray-800">{{ $totalProducts }}</p> --}}
            </div>

            <!-- Tarjeta de Categorías Totales -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Categorías Totales</h3>
                {{-- <p class="text-3xl font-bold text-gray-800">{{ $totalCategories }}</p> --}}
            </div>

            <!-- Tarjeta de Productos por Categoría -->
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Productos por Categoría</h3>
                {{-- <p class="text-3xl font-bold text-gray-800">{{ $productsInCategories }}</p> --}}
            </div>
        </div>

        <!-- Barra de acción para agregar nueva categoría -->
        <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-md border border-gray-200 mt-6">
            <h2 class="text-2xl font-semibold text-gray-700">Productos</h2>
            <div>
                <button
                    class="px-4 py-2 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600 focus:outline-none"
                    wire:click="openCreateCategoryModal">Agregar Productos</button>
            </div>
        </div>

        <!-- Filtro de búsqueda de categorías -->
        <div class="bg-white p-4 rounded-lg shadow-lg border border-gray-200 mt-4">
            <input type="text" class="w-full p-2 border border-gray-300 rounded-lg"
                placeholder="Buscar por nombre de categoría..." wire:model="search">
        </div>

        <!-- Tabla de Categorías -->
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 mt-6">
            <table class="min-w-full text-sm text-left text-gray-500">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-medium text-gray-900">Categoría</th>
                        <th class="px-6 py-4 font-medium text-gray-900">Productos</th>
                        <th class="px-6 py-4 font-medium text-gray-900">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($categories as $category)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $category->name }}</td>
                            <td class="px-6 py-4">{{ $category->products_count }} productos</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-500 hover:underline"
                                    wire:click="viewCategoryDetails({{ $category->id }})">Ver Detalles</button>
                                <button class="ml-2 text-yellow-500 hover:underline"
                                    wire:click="openEditCategoryModal({{ $category->id }})">Editar</button>
                                <button class="ml-2 text-red-500 hover:underline"
                                    wire:click="confirmDeleteCategory({{ $category->id }})">Eliminar</button>
                                <button class="ml-2 text-green-500 hover:underline"
                                    wire:click="addProduct({{ $category->id }})">Agregar Producto</button>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>

        <!-- Modal para Agregar/Editar Categoría o Producto -->
        <x-modal wire:model="isModalOpen">
            <div class="p-6">
                {{-- <h3 class="text-2xl font-semibold text-gray-700">{{ $modalTitle }}</h3> --}}
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
