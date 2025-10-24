<div>
    {{-- Este es el <div> raíz que Livewire necesita SÍ O SÍ --}}


        <div 
            wire:click.self="closeModal"
            class="fixed inset-0 bg-transparent flex items-center justify-center p-4 z-50"
            x-data="{ show: @entangle('showModal') }"
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            style="display: none;" {{-- 2. AÑADE ESTO --}}
            wire:ignore.self
        >
            <div 
                class="bg-white rounded-lg shadow-xl max-w-md w-full p-6"
                x-show="show"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                wire:ignore.self
            >

                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Nueva Canalización</h2>
                        <p class="text-sm text-gray-600 mt-1">Busca al alumno y especifica el motivo de la canalización
                        </p>
                    </div>

                    <button wire:click="closeModal" type="button"
                        class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-4">

                    <div class="relative">
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
                            
                            <input type="text" 
                                wire:model.live.debounce.300ms="search"
                                id="search-student"
                                wire:key="search-student-input"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                placeholder="Buscar por nombre de alumno..." 
                                autocomplete="off"
                            >
                        </div>

                        {{-- LA LISTA DE RESULTADOS --}}
                        @if (count($alumnosResult) > 0)
                            <div
                                class="absolute z-10 w-full bg-white border border-gray-200 rounded-b-lg shadow-lg mt-1 max-h-60 overflow-y-auto">
                                <ul>
                                    @foreach ($alumnosResult as $alumno)
                                        <li 
                                            wire:click="selectAlumno({{ $alumno->pk_alumno }})"
                                            class="flex items-center p-3 hover:bg-gray-100 cursor-pointer border-b border-gray-100"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                            
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">
                                                    {{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    <span>{{ $alumno->pk_alumno }}</span>
                                                    <span class="mx-1.5">•</span>
                                                    <span>{{ $alumno->nombre_grupo }}</span>
                                                    <span class="mx-1.5">•</span>
                                                    <span>{{ $alumno->edad }} años</span>
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif (strlen($search) >= 2 && !$selectedAlumno)
                            <div
                                class="absolute z-10 w-full bg-white border border-gray-200 rounded-b-lg shadow-lg mt-1 p-3">
                                <p class="text-sm text-gray-500">No se encontraron alumnos.</p>
                            </div>
                        @endif
                    </div>


                    {{-- --- BLOQUE NUEVO: ALUMNO SELECCIONADO --- --}}
                    @if ($selectedAlumno)
                        <div class="bg-teal-50 border border-teal-200 text-teal-900 rounded-lg p-4">
                            <h3 class="text-sm font-semibold text-teal-800 mb-3">Alumno seleccionado:</h3>
                            <div class="grid grid-cols-2 gap-y-3 gap-x-4">

                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600 mr-2"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="text-xs font-medium text-teal-700">Nombre</p>
                                        <p class="text-sm font-semibold">
                                            {{ $selectedAlumno->nombre }} {{ $selectedAlumno->apellido_paterno }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600 mr-2"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0118 15v3h-2zM4 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 016 15v3H4z" />
                                    </svg>
                                    <div>
                                        <p class="text-xs font-medium text-teal-700">Grupo</p>
                                        <p class="text-sm font-semibold">{{ $selectedAlumno->nombre_grupo }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600 mr-2"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002 2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="text-xs font-medium text-teal-700">Edad</p>
                                        <p class="text-sm font-semibold">{{ $selectedAlumno->edad }} años</p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                    </svg>
                                    <div>
                                        <p class="text-xs font-medium text-teal-700">Matrícula</p>
                                        <p class="text-sm font-semibold">{{ $selectedAlumno->pk_alumno }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif
                    @error('selectedAlumnoId')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">
                            Motivo de la canalización
                        </label>
                        <div class="relative">
                            <select 
                                wire:model="selectedMotivoId"
                                id="reason"
                                class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-md bg-white text-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent appearance-none">
                                <option value="" disabled selected>Selecciona el motivo principal...</option>
                                
                                @foreach ($motivos as $motivo)
                                    <option value="{{ $motivo->pk_motivo_canalizacion }}" class="text-gray-900">
                                        {{ $motivo->nombre }}
                                    </option>
                                @endforeach

                            </select>
                            <div
                                class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            Selecciona la categoría principal. Podrás especificar los detalles en el siguiente paso.
                        </p>
                        @error('selectedMotivoId')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button wire:click="closeModal" type="button"
                        class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancelar
                    </button>
                    <button 
                        type="button"
                        wire:click="guardarCanalizacion"
                        wire:loading.attr="disabled" {{-- Deshabilita el botón mientras guarda --}}
                        wire:target="guardarCanalizacion" {{-- Muestra el 'loading' solo para esta acción --}}
                        class="px-4 py-2 bg-teal-600 text-white rounded-md text-sm font-medium hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 disabled:opacity-50"
                    >
                        {{-- Añadimos un spinner de carga --}}
                        <span wire:loading.remove wire:target="guardarCanalizacion">
                            Continuar con el Formato
                        </span>
                        <span wire:loading wire:target="guardarCanalizacion">
                            Guardando...
                        </span>
                    </button>
                </div>

            </div>
        </div>

</div>