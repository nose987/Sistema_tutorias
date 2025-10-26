{{-- Ruta: /encuestas (ej. encuestas.blade.php) --}}
<x-layouts.app :title="__('Encuestas')">

    {{-- Se usa 'h-screen' y se resta el alto del header para un scroll independiente del contenido --}}
    <div class="flex">

        {{-- @livewire('sidebar') --}} {{-- Asumiendo que tienes un componente Livewire para el sidebar --}}

        <main class="flex-1 p-6 md:p-8 bg-slate-50 dark:bg-[#262626] overflow-y-auto">

            {{-- Encabezado de la Sección --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-neutral-100">Encuestas</h1>
                    <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">Gestiona encuestas para tus tutorados</p>
                </div>
            </div>

            {{-- Stats Cards (Relacionadas a Encuestas) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Alumnos faltantes</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-neutral-100 mt-2">5</p>
                    <p class="text-sm text-gray-400 dark:text-neutral-500 mt-1">por responder</p>
                </div>
                <div class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Respuestas Recibidas</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-neutral-100 mt-2">15</p>
                    <p class="text-sm text-gray-400 dark:text-neutral-500 mt-1">Total de encuestas</p>
                </div>
                {{-- Se omite el card "Actividades Realizadas" --}}
            </div>

            {{-- Contenido de Encuestas (Sin pestañas) --}}
            <div>
                <div class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                   <div class="p-6 border-b border-gray-200 dark:border-neutral-700 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Gestión de Encuestas</h3>
                            <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">Copia el link para compartir con tus tutorados</p>
                        </div>
                        <a href="{{-- ruta para nueva encuesta --}}"
                           class="mt-3 sm:mt-0 flex items-center space-x-2 px-4 py-2 text-sm font-medium text-white bg-[#2B8A7F] border border-transparent rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            
                            <flux:icon.clipboard variant="micro"/>  
                            <span>Copiar link de encuesta</span>
                        </a>
                   </div>
                   <div class="p-6">
                        <div class="mt-4 space-y-4">
                            <h4 class="text-md font-semibold text-gray-700 dark:text-neutral-300">Últimas Respuestas Recibidas</h4>

                            {{-- Lista de alumnos (datos de ejemplo) --}}
                            <ul class="space-y-3">
                                {{-- Alumno 1 --}}
                                <li class="flex items-center justify-between p-3 bg-gray-50 dark:bg-neutral-800 rounded-lg border border-gray-200 dark:border-neutral-700">
                                    <div class="flex items-center space-x-3">
                                        {{-- Placeholder para avatar o iniciales si lo tienes --}}
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-teal-100 dark:bg-teal-700 flex items-center justify-center">
                                            <span class="text-sm font-medium text-teal-800 dark:text-teal-100">JP</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-800 dark:text-neutral-100">Juan Pérez García</span>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-neutral-400">Hace 2 horas</span>
                                </li>
                                {{-- Alumno 2 --}}
                                <li class="flex items-center justify-between p-3 bg-gray-50 dark:bg-neutral-800 rounded-lg border border-gray-200 dark:border-neutral-700">
                                     <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-700 flex items-center justify-center">
                                            <span class="text-sm font-medium text-indigo-800 dark:text-indigo-100">ML</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-800 dark:text-neutral-100">María López Hernández</span>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-neutral-400">Hace 5 horas</span>
                                </li>
                                {{-- Alumno 3 --}}
                                <li class="flex items-center justify-between p-3 bg-gray-50 dark:bg-neutral-800 rounded-lg border border-gray-200 dark:border-neutral-700">
                                     <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-pink-100 dark:bg-pink-700 flex items-center justify-center">
                                            <span class="text-sm font-medium text-pink-800 dark:text-pink-100">AM</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-800 dark:text-neutral-100">Ana Martínez Sánchez</span>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-neutral-400">Hace 1 día</span>
                                </li>
                                {{-- Ejemplo Alumno 4 --}}
                                 <li class="flex items-center justify-between p-3 bg-gray-50 dark:bg-neutral-800 rounded-lg border border-gray-200 dark:border-neutral-700">
                                     <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-700 flex items-center justify-center">
                                            <span class="text-sm font-medium text-amber-800 dark:text-amber-100">LG</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-800 dark:text-neutral-100">Luis González Ruiz</span>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-neutral-400">Hace 2 días</span>
                                </li>
                            </ul>

                            {{-- Botón Ver Más --}}
                            <div class="mt-4 text-center">
                                <a href="{{-- ruta para ver todas las respuestas --}}"
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-teal-600 dark:text-teal-400 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-colors">
                                    Ver Todas las Respuestas
                                </a>
                            </div>
                        </div>
                   </div>
                </div>
            </div>

        </main>
    </div>
</x-layouts.app>