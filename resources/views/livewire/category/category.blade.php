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
                            class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700">Agregar
                            Categoría</>
                    </div>

                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="px-4 py-2 text-gray-600">Nombre de la Categoría</th>
                                <th class="px-4 py-2 text-gray-600">Estado</th>
                                <th class="px-4 py-2 text-gray-600">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($typeProducts as $typeProduct)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $typeProduct->product_type_name }}</td>

                                    <!-- Columna Estado -->
                                    <td class="px-4 py-2 text-center">
                                        <span
                                            class="inline-block px-3 py-1 rounded-full
                                            {{ $typeProduct->deleted_at ? 'bg-red-500 text-white' : 'bg-blue-500 text-white' }}">
                                            {{ $typeProduct->deleted_at ? 'Eliminado' : 'Activo' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-2 text-center">
                                        <button type="button"
                                            wire:click="openModalUpdateCategory({{ $typeProduct->id }})"
                                            class="flex items-center text-blue-600 hover:text-blue-800 mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 3l4 4m0 0l-4 4m4-4H7a4 4 0 00-4 4v4a4 4 0 004 4h10a4 4 0 004-4v-4a4 4 0 00-4-4z" />
                                            </svg>
                                            Ver/Editar
                                        </button>

                                        @if (!$typeProduct->deleted_at)
                                            <button type="button"
                                                wire:click="openModalDeleteCategory({{ $typeProduct->id }})"
                                                class="flex items-center text-red-600 hover:text-red-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Eliminar
                                            </button>
                                        @else
                                            <button type="button"
                                                class="flex items-center text-gray-400 cursor-not-allowed">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Eliminado
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <x-dialog-modal wire:model="openCategory" class="fixed inset-0 flex items-center justify-center z-50">
            <x-slot name="title">
                <h1 class="text-lg text-center font-medium">Registrar Categoria</h1>
            </x-slot>
            <x-slot name="content" class="w-full max-w-md p-4 bg-white rounded-lg shadow-lg">
                <div class="mb-4">
                    <label for="product_type_name"
                        class="block text-left text-gray-700 font-semibold mb-2">Nombre</label>
                    <input id="product_type_name" type="text" wire:model.live="product_type_name"
                        class="border border-gray-300 rounded px-3 py-2 w-full mb-3" required>
                    @error('product_type_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button wire:click="store" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Guardar Categoria
                </button>
            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal wire:model="openUpdateCategory" class="fixed inset-0 flex items-center justify-center z-50">
            <x-slot name="title">
                <h1 class="text-lg text-center font-medium">Actualizar Categoria</h1>
            </x-slot>
            <x-slot name="content" class="w-full max-w-md p-4 bg-white rounded-lg shadow-lg">
                <div class="mb-4">
                    <label for="product_type_name"
                        class="block text-left text-gray-700 font-semibold mb-2">Nombre</label>
                    <input id="product_type_name" type="text" wire:model.live="product_type_name"
                        class="border border-gray-300 rounded px-3 py-2 w-full mb-3" required>
                    @error('product_type_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <select name="" id="">
                    <option value="" disabled>Seleccione una opcion</option>
                    <option value="activar">Activar</option>
                    <option value="eliminar">Eliminar</option>
                </select>
                <br>

                <button wire:click="store"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Actualizar Categoria
                </button>
            </x-slot>
        </x-dialog-modal>


        <x-dialog-modal wire:model="openDeleteCategory">
            <x-slot name="title">
                <h1 class="text-lg font-semibold text-gray-900 dark:text-gray-100">

                </h1>
            </x-slot>
            <x-slot name="content">
                <div class="flex flex-col items-center text-center">
                    <div class="mb-4">
                        <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z">
                            </path>
                        </svg>
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                        ¿Está seguro de eliminar esta Categoria?
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Esta acción no se puede deshacer. Todos los datos asociados con este estudiante se perderán de
                        forma permanente.
                    </p>
                </div>

                <div class="mt-6 flex justify-center gap-4">
                    <button wire:click="$set('openDeleteCategory', false)"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition-all">
                        Cancelar
                    </button>
                    <button wire:click="delete"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-lg transition-all transform hover:scale-105">
                        Eliminar
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </x-app-layout>
</div>
