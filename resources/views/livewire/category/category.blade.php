<div>
    <x-app-layout>
        <div class="flex-1 p-6 ml-4">
            <div class="max-w-7xl mx-auto space-y-6">
                <h1 class="text-3xl font-semibold text-gray-900">Panel Administrativo del Supermercado</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-700">Total de Productos</h2>
                        <p class="mt-4 text-3xl font-bold text-blue-600">{{ count($totalProduct) }}</p>
                        <p class="mt-2 text-gray-500">Total de productos disponibles en el inventario.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-700">Total de Categorías Activas</h2>
                        <p class="mt-4 text-3xl font-bold text-green-600">
                            {{ \App\Models\TypeProduct::whereNull('deleted_at')->count() }}</p>
                        <p class="mt-2 text-gray-500">Número total de categorías activas.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-700">Total de Categorías</h2>
                        <p class="mt-4 text-3xl font-bold text-blue-600">{{ count($typeProducts) }}</p>
                        <p class="mt-2 text-gray-500">Número total de categorías.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Listado de Categorías</h2>
                        <button type="button" wire:click="openModalCategory"
                            class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700">
                            Agregar Categoría
                        </button>
                    </div>

                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="text-left bg-gray-100 border-b border-gray-300">
                                <th class="px-4 py-2 text-gray-600">Nombre de la Categoría</th>
                                <th class="px-4 py-2 text-gray-600 text-center">Estado</th>
                                <th class="px-4 py-2 text-gray-600 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($typeProducts as $typeProduct)
                                <tr class="border-b border-gray-300 hover:bg-gray-50">
                                    <td class="px-4 py-2 align-middle">{{ $typeProduct->product_type_name }}</td>
                                    <td class="px-4 py-2 text-center align-middle">
                                        <span
                                            class="inline-block px-3 py-1 rounded-full {{ $typeProduct->deleted_at ? 'bg-red-500 text-white' : 'bg-blue-500 text-white' }}">
                                            {{ $typeProduct->deleted_at ? 'Eliminado' : 'Activo' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-center align-middle">
                                        <button wire:click="openModalUpdateCategory({{ $typeProduct->id }})"
                                            class="text-blue-600 hover:text-blue-800 mr-4">
                                            Ver Detalles
                                        </button>
                                        @if (!$typeProduct->deleted_at)
                                            <button wire:click="openModalDeleteCategory({{ $typeProduct->id }})"
                                                class="text-red-600 hover:text-red-800">
                                                Eliminar
                                            </button>
                                        @else
                                            <span class="text-gray-400 cursor-not-allowed">Eliminado</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <x-dialog-modal wire:model="openCategory" class="fixed inset-0 flex items-center justify-center">
            <x-slot name="title">
                <h1 class="text-lg font-medium">Registrar Categoría</h1>
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <label for="product_type_name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
                    <input id="product_type_name" type="text" wire:model="product_type_name"
                        class="border border-gray-300 rounded px-3 py-2 w-full">
                    @error('product_type_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button wire:click="store" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Guardar Categoría
                </button>
            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal wire:model="openUpdateCategory" class="fixed inset-0 flex items-center justify-center">
            <x-slot name="title">
                <h1 class="text-lg font-medium">Actualizar Categoría</h1>
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <label for="product_type_name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
                    <input id="product_type_name" type="text" wire:model="product_type_name"
                        class="border border-gray-300 rounded px-3 py-2 w-full">
                    @error('product_type_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="action" class="block text-gray-700 font-semibold mb-2">Estado</label>
                    <select id="action" wire:model="estado" class="border border-gray-300 rounded px-3 py-2 w-full">
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="Activo">Activo</option>
                        <option value="Eliminado">Eliminado</option>
                    </select>
                </div>
                <button wire:click="update"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Actualizar Categoría
                </button>
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
