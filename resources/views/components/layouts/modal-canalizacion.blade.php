@props(['motivos' => []])

<div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-transparent bg-opacity-50 flex items-center justify-center p-4 z-50" style="display: none;">

    <div @click.away="showModal = false" x-show="showModal" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">

        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Nueva Canalización</h2>
                <p class="text-sm text-gray-600 mt-1">Busca al alumno y especifica el motivo de la canalización</p>
            </div>

            <button @click="showModal = false" type="button"
                class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="space-y-4">
            <div>
                <label for="search-student" class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre completo del alumno
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" id="search-student"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                        placeholder="Buscar por nombre o matrícula...">
                </div>
            </div>

            <div>
                <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">
                    Motivo de la canalización
                </label>
                <div class="relative">
                    <select id="reason"
                        class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-md bg-white text-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent appearance-none">
                        <option value="" disabled selected>Selecciona el motivo principal...</option>
                        @foreach ($motivos as $motivo)
                            <option value="{{ $motivo->pk_motivo_canalizacion }}" class="text-gray-900">
                                {{ $motivo->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-1">
                    Selecciona la categoría principal. Podrás especificar los detalles en el siguiente paso.
                </p>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-6">
            <button @click="showModal = false" type="button"
                class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Cancelar
            </button>

            <button type="button"
                class="px-4 py-2 bg-teal-600 text-white rounded-md text-sm font-medium hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                Continuar con el Formato
            </button>
        </div>

    </div>
</div>
