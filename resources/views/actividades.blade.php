{{-- Ruta: /actividades (ej. actividades.blade.php) --}}
<x-layouts.app :title="__('Actividades y Pláticas')">

    {{-- Se usa 'h-screen' y se resta el alto del header para un scroll independiente del contenido --}}
    <div class="flex">

        {{-- @livewire('sidebar') --}} {{-- Asumiendo que tienes un componente Livewire para el sidebar --}}

        <main class="flex-1 p-6 md:p-8 bg-slate-50 dark:bg-[#262626] overflow-y-auto">

            {{-- Encabezado de la Sección --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-neutral-100">Actividades y Pláticas</h1>
                    <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">Registra pláticas y actividades realizadas</p>
                </div>
            </div>

            {{-- Stats Cards (Relacionadas a Actividades) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Actividades Realizadas</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-neutral-100 mt-2">{{ $total_actividades }}</p>
                    <p class="text-sm text-gray-400 dark:text-neutral-500 mt-1">Este cuatrimestre</p>
                </div>
                {{-- Se omiten los cards "Alumnos faltantes" y "Respuestas Recibidas" --}}
            </div>

            {{-- Contenido de Actividades (Sin pestañas) --}}
            <div>
                <div class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                   <div class="p-6 border-b border-gray-200 dark:border-neutral-700 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Registro de Actividades</h3>
                            <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">Lista de pláticas y actividades completadas</p>
                        </div>
                         <a href="{{ route('actividades.create') }}"
                           class="mt-3 sm:mt-0 flex items-center space-x-2 px-4 py-2 text-sm font-medium text-white bg-[#2B8A7F] border border-transparent rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <flux:icon.plus />  
                            <span>Nueva Actividad</span>
                        </a>
                   </div>
                   <div class="p-6">
                       <div class="overflow-x-auto mt-4">
                            <table class="w-full text-sm text-left text-gray-600 dark:text-neutral-300">
                                <thead class="bg-[#2B8A7F] text-xs text-white uppercase rounded-t-lg">
                                    {{-- Encabezados de la tabla --}}
                                    <tr>
                                        <th scope="col" class="px-6 py-3 font-semibold rounded-tl">Nombre</th>
                                        <th scope="col" class="px-6 py-3 font-semibold">Tipo</th>
                                        <th scope="col" class="px-6 py-3 font-semibold">Fecha y Hora</th>
                                        <th scope="col" class="px-6 py-3 font-semibold text-center">Asistentes</th>
                                        <th scope="col" class="px-6 py-3 font-semibold text-right rounded-tr">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($actividades as $actividad)
                                    <tr class="bg-white dark:bg-neutral-900 border-b dark:border-neutral-700 hover:bg-gray-50 dark:hover:bg-neutral-800">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-neutral-100 whitespace-nowrap">
                                            {{ $actividad->nombre }}
                                        </th>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-md border border-gray-300 dark:border-neutral-600 text-gray-700 dark:text-neutral-300">
                                                {{ $actividad->tipoActividad->nombre ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center space-x-2 text-gray-700 dark:text-neutral-300">
                                                <flux:icon.calendar variant="micro" />
                                                <span>
                                                    {{ \Carbon\Carbon::parse($actividad->fecha)->translatedFormat('j M Y') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                           <div class="flex items-center justify-center space-x-2 text-gray-700 dark:text-neutral-300">
                                               <flux:icon.users variant="micro" />  
                                               <span>{{ $actividad->asistencia }}</span>
                                           </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-end items-center space-x-3">
                                                <a href="{{ route('actividades.show', $actividad) }}" class="text-gray-500 dark:text-neutral-400 hover:text-blue-600 dark:hover:text-blue-400" title="Ver detalles">
                                                    <flux:icon.eye variant="micro" />                        
                                                </a>
                                                <a href="{{ route('actividades.edit', $actividad) }}" class="text-gray-500 dark:text-neutral-400 hover:text-green-600 dark:hover:text-green-400" title="Editar">
                                                   <flux:icon.pencil-square variant="micro" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="bg-white dark:bg-neutral-900 border-b dark:border-neutral-700">
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-neutral-400">
                                            No hay actividades registradas por el momento.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                   </div>
                </div>
            </div>
    </div>
</x-layouts.app>