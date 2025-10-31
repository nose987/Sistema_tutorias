<div x-data="{ show: @entangle('showModal') }" x-show="show" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="show = false"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-lg p-8 my-8 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-neutral-800 shadow-xl rounded-2xl">
            <h3 class="text-lg font-bold leading-6 text-gray-900 dark:text-neutral-100" id="modal-title">
                Editar Actividad
            </h3>
            <div class="mt-4">
                <form wire:submit.prevent="actualizarActividad" class="space-y-6">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Nombre de la actividad</label>
                        <input type="text" wire:model="nombre" id="nombre" class="mt-1 block w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm dark:text-white">
                        @error('nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="fk_tipo_actividad" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Tipo de actividad</label>
                        <select wire:model="fk_tipo_actividad" id="fk_tipo_actividad" class="mt-1 block w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm dark:text-white">
                            <option value="">Seleccione un tipo</option>
                            @foreach ($tiposActividad as $tipo)
                                <option value="{{ $tipo->pk_tipo_actividad }}">{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                        @error('fk_tipo_actividad') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Fecha</label>
                        <input type="date" wire:model="fecha" id="fecha" class="mt-1 block w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm dark:text-white">
                        @error('fecha') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="asistencia" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Asistentes</label>
                        <input type="number" wire:model="asistencia" id="asistencia" min="0" class="mt-1 block w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm dark:text-white">
                        @error('asistencia') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="estatus" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Estatus</label>
                        <select wire:model="estatus" id="estatus" class="mt-1 block w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm dark:text-white">
                            <option value="Pendiente">Pendiente</option>
                            <option value="Realizada">Realizada</option>
                        </select>
                        @error('estatus') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="button" @click="show = false" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-md text-sm font-medium hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">Actualizar Actividad</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
