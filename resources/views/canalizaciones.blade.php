<x-layouts.app :title="__('Canalizaciones')">

    <div class="flex">

        <main class="flex-1 p-6 md:p-8 bg-slate-50 dark:bg-[#262626] overflow-y-auto" x-data="{ activeTab: 'canalizaciones' }">


            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-neutral-100">Canalizaciones</h1>
                    <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">Información de canalizaciones y bajas</p>
                </div>
                <div class="flex items-center space-x-3 mt-4 md:mt-0">
                    <a href="{{ route('canalizaciones.reporte.final') }}"
                        class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Generar Informe Final</span>
                    </a>
                    <button @click.prevent="$dispatch('open-modal')"
                        class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-white bg-[#2B8A7F] border border-transparent rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Nueva Canalización</span>
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div
                    class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Total Canalizaciones</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-neutral-100 mt-2">{{ $total_canalizaciones }}
                    </p>
                    <p class="text-sm text-gray-400 dark:text-neutral-500 mt-1">Este cuatrimestre</p>
                </div>
                <div
                    class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Bajas Registradas</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-neutral-100 mt-2">{{ $total_bajas }}</p>
                    <p class="text-sm text-gray-400 dark:text-neutral-500 mt-1">Alumnos dados de baja</p>
                </div>
                <div
                    class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Motivo Más Común</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-neutral-100 mt-2">
                        {{ $motivo_comun?->nombre ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-400 dark:text-neutral-500 mt-1">{{ $motivo_comun?->total ?? 0 }}
                        canalizaciones</p>
                </div>
            </div>

            <div x-data="{ activeTab: 'canalizaciones' }">
                <div class="mb-6">
                    <div class="border-b border-gray-200 dark:border-neutral-700">
                        <nav class="-mb-px flex space-x-4">
                            <a href="#" @click.prevent="activeTab = 'canalizaciones'"
                                :class="{
                                    'border-teal-500 text-teal-600 dark:border-teal-400 dark:text-teal-400': activeTab === 'canalizaciones',
                                    'border-transparent text-gray-500 dark:text-neutral-400 hover:text-gray-700 dark:hover:text-neutral-200 hover:border-gray-300 dark:hover:border-neutral-600': activeTab !== 'canalizaciones'
                                }"
                                class="px-3 py-2 font-semibold border-b-2 transition-colors">
                                Canalizaciones
                            </a>
                            <a href="#" @click.prevent="activeTab = 'bajas'"
                                :class="{
                                    'border-teal-500 text-teal-600 dark:border-teal-400 dark:text-teal-400': activeTab === 'bajas',
                                    'border-transparent text-gray-500 dark:text-neutral-400 hover:text-gray-700 dark:hover:text-neutral-200 hover:border-gray-300 dark:hover:border-neutral-600': activeTab !== 'bajas'
                                }"
                                class="px-3 py-2 font-semibold border-b-2 transition-colors">
                                Bajas
                            </a>
                        </nav>
                    </div>
                </div>

                <div>
                    <div x-show="activeTab === 'canalizaciones'"
                        class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Historial de
                                Canalizaciones</h3>
                            <p class="text-sm text-gray-500 dark:text-neutral-400">Registro completo de canalizaciones
                                realizadas</p>
                        </div>
                        <div class="overflow-x-auto mt-4">
                            <table class="w-full text-sm text-left text-gray-600 dark:text-neutral-300">
                                <thead class="bg-[#2B8A7F] text-xs text-white uppercase">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Alumno</th>
                                        <th scope="col" class="px-6 py-3">Grupo</th>
                                        <th scope="col" class="px-6 py-3">Motivo</th>
                                        <th scope="col" class="px-6 py-3">Fecha</th>
                                        <th scope="col" class="px-6 py-3 text-right">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($canalizaciones as $canalizacion)
                                        <tr
                                            class="bg-white dark:bg-neutral-900 border-b dark:border-neutral-700 hover:bg-gray-50 dark:hover:bg-neutral-800">

                                            {{-- 1. Alumno (Usando el Accessor 'nombre_completo') --}}
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 dark:text-neutral-100 whitespace-nowrap">
                                                {{ $canalizacion->alumno->nombre_completo }}
                                            </th>

                                            {{-- 2. Grupo (Desde la relación anidada) --}}
                                            <td class="px-6 py-4">
                                                {{ $canalizacion->alumno->grupo->nombre_grupo }}
                                            </td>

                                            {{-- 3. Motivo (Desde la relación) --}}
                                            <td class="px-6 py-4">
                                                {{ $canalizacion->motivo->nombre }}
                                            </td>

                                            {{-- 4. Fecha (Formateada con Carbon) --}}
                                            <td class="px-6 py-4">
                                                {{ \Carbon\Carbon::parse($canalizacion->fecha_inicio)->format('d-m-Y') }}
                                            </td>

                                            {{-- 5. Opciones (Estáticas por ahora) --}}
                                            <td class="px-6 py-4">
                                                <div class="flex justify-end items-center space-x-4">
                                                    <a href="{{ route('canalizaciones.show', $canalizacion) }}"
                                                        class="text-gray-500 dark:text-neutral-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                            <path fill-rule="evenodd"
                                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('canalizaciones.formato.pdf', $canalizacion) }}"
                                                        class="text-gray-500 dark:text-neutral-400 hover:text-green-600 dark:hover:text-green-400 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        {{-- Mensaje por si no hay canalizaciones --}}
                                        <tr class="bg-white dark:bg-neutral-900 border-b dark:border-neutral-700">
                                            <td colspan="5"
                                                class="px-6 py-4 text-center text-gray-500 dark:text-neutral-400">
                                                No hay canalizaciones registradas por el momento.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- 
  Busca el div de tu pestaña de Bajas, 
  probablemente se vea así:
--}}
                    <div x-show="activeTab === 'bajas'"
                        class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Historial de Bajas</h3>
                            <p class="text-sm text-gray-500 dark:text-neutral-400">Registro completo de alumnos dados
                                de
                                baja</p>
                        </div>
                        <div class="overflow-x-auto mt-4">
                            <table class="w-full text-sm text-left text-gray-600 dark:text-neutral-300">
                                <thead class="bg-[#2B8A7F] text-xs text-white uppercase">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Alumno</th>
                                        <th scope="col" class="px-6 py-3">Grupo</th>
                                        <th scope="col" class="px-6 py-3">Motivo de Baja</th>
                                        <th scope="col" class="px-6 py-3">Fecha de Baja</th>
                                        <th scope="col" class="px-6 py-3">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bajas as $baja)
                                        <tr
                                            class="bg-white dark:bg-neutral-900 border-b dark:border-neutral-700 hover:bg-gray-50 dark:hover:bg-neutral-800">

                                            {{-- 1. Alumno (de la relación) --}}
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 dark:text-neutral-100 whitespace-nowrap">
                                                {{ $baja->alumno->nombre_completo ?? 'Alumno no disponible' }}
                                            </th>

                                            {{-- 2. Grupo (de la relación anidada) --}}
                                            <td class="px-6 py-4">
                                                {{ $baja->alumno->grupo->nombre_grupo ?? 'N/A' }}
                                            </td>

                                            {{-- 3. Motivo (de la relación) --}}
                                            <td class="px-6 py-4">
                                                {{ $baja->motivoBaja->nombre ?? 'Motivo no disponible' }}
                                            </td>

                                            {{-- 4. Fecha (del registro de baja) --}}
                                            <td class="px-6 py-4">
                                                {{ \Carbon\Carbon::parse($baja->fecha)->format('d-m-Y') }}
                                            </td>

                                            {{-- 5. Estatus (del registro de baja) --}}
                                            <td class="px-6 py-4">
                                                <a href="{{ route('alumnos.historial', $canalizacion->alumno) }}"
                                                    class="text-gray-500 dark:text-neutral-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        <path fill-rule="evenodd"
                                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        {{-- Mensaje por si no hay bajas --}}
                                        <tr class="bg-white dark:bg-neutral-900 border-b dark:border-neutral-700">
                                            <td colspan="5"
                                                class="px-6 py-4 text-center text-gray-500 dark:text-neutral-400">
                                                No hay bajas registradas por el momento.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <livewire:crear-canalizacion-modal />
        </main>
    </div>
</x-layouts.app>