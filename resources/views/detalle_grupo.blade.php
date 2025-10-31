<x-layouts.app :title="__('Detalle del Grupo')">
    <div class="flex h-screen overflow-hidden">
        <main class="flex-1 p-6 md:p-8 bg-slate-50 dark:bg-[#262626] overflow-y-auto">

            {{-- Back --}}
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('grupo') }}"
                   class="flex items-center space-x-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-neutral-300 hover:text-gray-900 dark:hover:text-neutral-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Volver</span>
                </a>
            </div>
            

            {{-- Header --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-neutral-100">
                            {{ $grupo->nombre_grupo }}
                        </h1>

                        @if(($grupo->estatus ?? '') === 'Activo')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900">
                                Actual
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-gray-200 dark:bg-neutral-700 text-gray-900 dark:text-neutral-100">
                                Anterior
                            </span>
                        @endif
                    </div>

                    <p class="text-sm text-gray-500 dark:text-neutral-400">
                        {{ $grupo->cuatrimestre ?? '—' }}
                    </p>
                </div>

                <div class="flex items-center space-x-3 mt-4 md:mt-0">
                    
                    {{-- ===== BOTÓN MODIFICADO ===== --}}
                    {{-- Ahora es "Exportar Grupo" y apunta a la nueva ruta --}}
                    <a href="{{ route('grupos.exportAlumnos', $grupo->pk_grupo) }}"
                        class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-white bg-[#2B8A7F] border border-transparent rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        {{-- Icono de Descarga --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span>Exportar Grupo</span>
                    </a>
                    {{-- ===== FIN DEL CAMBIO ===== --}}


                    {{-- Editar grupo (secondary) --}}
                    <a href="{{ route('editar_grupo', $grupo->pk_grupo) }}"
                        class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Editar grupo</span>
                    </a>
                </div>


            </div>

            {{-- ... (El resto de tu código de stats y la tabla de alumnos sigue igual) ... --}}
            @php
                $total = $grupo->alumnos->count();
                $activos = $grupo->alumnos->where('estatus', 'Activo')->count();
                $bajas = $grupo->alumnos->where('estatus', 'Baja')->count();
            @endphp

            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Total Alumnos</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-neutral-100 mt-2">{{ $total }}</p>
                    <p class="text-sm text-gray-400 dark:text-neutral-500 mt-1">Registrados en el grupo</p>
                </div>
                <div class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Alumnos Activos</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-neutral-100 mt-2">{{ $activos }}</p>
                    <p class="text-sm text-gray-400 dark:text-neutral-500 mt-1">Sin baja registrada</p>
                </div>
                <div class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Bajas</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-neutral-100 mt-2">{{ $bajas }}</p>
                    <p class="text-sm text-gray-400 dark:text-neutral-500 mt-1">Marcados como baja</p>
                </div>
            </div>

            {{-- Students --}}
            <div class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Alumnos del Grupo</h3>
                        <p class="text-sm text-gray-500 dark:text-neutral-400">Lista completa de tutorados</p>
                    </div>
                    <button type="button"
                        onclick="window.location.href='{{ route('alumnos.create', ['grupo' => $grupo->pk_grupo]) }}'"
                        class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-white
                                bg-[#2B8A7F] border border-transparent rounded-lg shadow-sm
                                hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-teal-500 mt-3 md:mt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Agregar Alumno</span>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 dark:text-neutral-300">
                        <thead class="bg-[#2B8A7F] text-xs text-white uppercase">
                            <tr>
                                <th class="px-6 py-3">Nombre</th>
                                <th class="px-6 py-3">Correo</th>
                                <th class="px-6 py-3">Estatus</th>
                                <th class="px-6 py-3 text-right">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($grupo->alumnos as $a)
                                <tr class="bg-white dark:bg-neutral-900 border-b dark:border-neutral-700 hover:bg-gray-50 dark:hover:bg-neutral-800">
                                <th class="px-6 py-4 font-medium text-gray-900 dark:text-neutral-100 whitespace-nowrap">
                                    {{ trim(($a->nombre ?? '').' '.($a->apellido_paterno ?? '').' '.($a->apellido_materno ?? '')) ?: 'Sin nombre' }}
                                </th>
                                <td class="px-6 py-4">{{ $a->correo ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    @if(($a->estatus ?? '') === 'Activo')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">Activo</span>
                                    @elseif(($a->estatus ?? '') === 'Baja')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">Baja</span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">{{ $a->estatus ?? '—' }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('detalle_alumno', $a->pk_alumno) }}"
                                    class="text-gray-700 dark:text-neutral-300 hover:text-gray-900 dark:hover:text-neutral-100 text-sm font-medium transition-colors">
                                    Ver Perfil
                                    </a>
                                </td>
                                </tr>
                            @empty
                                <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-gray-500 dark:text-neutral-400">
                                    No hay alumnos en este grupo.
                                </td>
                                </tr>
                            @endforelse
                    </tbody>

                    </table>
                </div>
            </div>
        </main>
    </div>
</x-layouts.app>