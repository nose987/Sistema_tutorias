<x-layouts.app :title="__('Historial de canalizaciones')">
    {{-- CAMBIO: Fondo de página más claro --}}
    <div class="bg-slate-50 dark:bg-neutral-800">

        <div class="max-w-7xl mx-auto p-6 md:p-8">

            <header class="mb-6">
                {{-- Link para volver (ajusta la ruta si tienes un perfil de alumno) --}}
                <a href="{{ url()->previous() }}"
                    class="flex items-center space-x-1 text-sm font-medium text-gray-600 dark:text-neutral-400 hover:text-gray-900 dark:hover:text-neutral-100 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Volver</span>
                </a>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-neutral-100">
                    Historial de Canalizaciones
                </h1>
                {{-- DATOS DINÁMICOS --}}
                <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">{{ $alumno->nombre_completo }} - {{ $alumno->pk_alumno }}</p>
            </header>

            {{-- STATS DINÁMICAS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- CAMBIO: Tarjetas más oscuras --}}
                <div
                    class="bg-white dark:bg-neutral-900 p-5 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Total de Canalizaciones</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-neutral-100 mt-1">{{ $totalCanalizaciones }}</p>
                </div>
                {{-- CAMBIO: Tarjetas más oscuras --}}
                <div
                    class="bg-white dark:bg-neutral-900 p-5 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">En Proceso</p>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-500 mt-1">{{ $totalActivas }}</p>
                </div>
                {{-- CAMBIO: Tarjetas más oscuras --}}
                <div
                    class="bg-white dark:bg-neutral-900 p-5 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Cerradas</p>
                    <p class="text-3xl font-bold text-gray-700 dark:text-neutral-300 mt-1">{{ $totalCerradas }}</p>
                </div>
                {{-- CAMBIO: Tarjetas más oscuras --}}
                <div
                    class="bg-white dark:bg-neutral-900 p-5 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Motivo Más Frecuente</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-neutral-100 mt-2">{{ $motivoComun }}</p>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-neutral-100">Línea de Tiempo</h2>
                <p class="text-sm text-gray-500 dark:text-neutral-400">Historial completo de canalizaciones del alumno
                </p>

                {{-- INICIO DEL BUCLE DE CANALIZACIONES --}}
                <div class="mt-6 space-y-6">
                    @forelse ($canalizaciones as $canalizacion)
                        @php
                            $formato = $canalizacion->formato; 
                        @endphp
                        {{-- CAMBIO: Tarjeta más oscura --}}
                        <div
                            class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-neutral-100">
                                        <a href="{{ route('canalizaciones.show', $canalizacion) }}" class="hover:text-teal-600">
                                            Canalización #{{ $canalizacion->pk_canalizacion }}
                                        </a>
                                    </h3>
                                    {{-- Estatus dinámico --}}
                                    @if ($canalizacion->estatus == 'Activa')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                            En Proceso
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-neutral-700 text-gray-800 dark:text-neutral-200">
                                            Cerrada
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center space-x-3">
                                    {{-- Botones (puedes añadir la funcionalidad de descarga si la tienes) --}}
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-neutral-400 mb-4">
                                {{ \Carbon\Carbon::parse($canalizacion->fecha_inicio)->format('d \de F \de Y') }}
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="md:col-span-2 space-y-4">
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Motivo</label>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                            {{ $canalizacion->motivo->nombre ?? 'Sin motivo' }}
                                        </span>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Tutor (del formato más reciente)</label>
                                        <p class="text-sm font-semibold text-gray-800 dark:text-neutral-100">
                                            {{ $formato?->tutor_nombre ?? 'No registrado' }}
                                        </p>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Observaciones (del formato más reciente)</label>
                                        <p class="text-sm text-gray-800 dark:text-neutral-100">
                                            {{ $formato?->observaciones_tutor ?? 'Sin observaciones' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="md:col-span-1">
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Área de Canalización</label>
                                        <p class="text-sm font-semibold text-gray-800 dark:text-neutral-100">
                                            {{ $canalizacion->motivo->nombre ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SECCIÓN DE SEGUIMIENTOS (SI EXISTE EL FORMATO Y TIENE SEGUIMIENTOS) --}}
                            @if ($formato && $formato->seguimientos->count() > 0)
                                <div class="mt-6 pt-4 border-t border-gray-200 dark:border-neutral-700">
                                    <details>
                                        <summary
                                            class="text-sm font-medium text-teal-600 dark:text-teal-400 hover:text-teal-800 dark:hover:text-teal-300 cursor-pointer">
                                            Mostrar seguimientos ({{ $formato->seguimientos->count() }})
                                        </summary>
                                        <div class="mt-4 pl-4 border-l-2 border-gray-200 dark:border-neutral-600 space-y-4">
                                            @foreach ($formato->seguimientos as $seguimiento)
                                                <div class="relative">
                                                    <span
                                                        class="absolute -left-[5px] top-1 h-2 w-2 rounded-full bg-gray-300 dark:bg-neutral-500"></span>
                                                    <p class="text-xs text-gray-500 dark:text-neutral-400">
                                                        {{ \Carbon\Carbon::parse($seguimiento->fecha_seguimiento)->format('d \de M \de Y') }}
                                                        - <span class="font-semibold text-gray-800 dark:text-neutral-100">{{ $seguimiento->modalidad_seguimiento }}</span>
                                                    </p>
                                                    <p class="text-sm text-gray-700 dark:text-neutral-200 mt-1">
                                                        {{ $seguimiento->diagnostico_otorgado ?? 'Sin diagnóstico' }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 dark:text-neutral-400 mt-1">Responsable: {{ $seguimiento->responsable_atencion }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </details>
                                </div>
                            @endif
                        </div>
                    @empty
                        {{-- Mensaje si no hay canalizaciones --}}
                        {{-- CAMBIO: Tarjeta más oscura --}}
                        <div
                            class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                            <p class="text-center text-gray-500 dark:text-neutral-400">Este alumno no tiene
                                canalizaciones en su historial.</p>
                        </div>
                    @endforelse
                </div>
                {{-- FIN DEL BUCLE --}}
            </div>

        </div>
    </div>
</x-layouts.app>