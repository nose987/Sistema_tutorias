<x-layouts.app :title="__('Encuestas y Actividades')">

    {{-- Se usa 'h-screen' y se resta el alto del header para un scroll independiente del contenido --}}
    <div class="flex">

        {{-- @livewire('sidebar') --}} {{-- Asumiendo que tienes un componente Livewire para el sidebar --}}

        <main class="flex-1 p-6 md:p-8 bg-slate-50 dark:bg-[#262626] overflow-y-auto">

            {{-- Encabezado de la Sección --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-neutral-100">Encuestas y Actividades</h1>
                    <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">Gestiona encuestas, pláticas y actividades</p>
                </div>
                {{-- Los botones de "Nueva Encuesta" y "Nueva Actividad" están dentro de las pestañas más abajo --}}
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Alumnos faltantes</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-neutral-100 mt-2">5</p>
                    <p class="text-sm text-gray-400 dark:text-neutral-500 mt-1">por responder</p>
                </div>
                <div class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Actividades Realizadas</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-neutral-100 mt-2">12</p>
                    <p class="text-sm text-gray-400 dark:text-neutral-500 mt-1">Este cuatrimestre</p>
                </div>
                <div class="bg-white dark:bg-neutral-900 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Respuestas Recibidas</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-neutral-100 mt-2">15</p>
                    <p class="text-sm text-gray-400 dark:text-neutral-500 mt-1">Total de encuestas</p>
                </div>
            </div>

            {{-- Sistema de Pestañas con Alpine.js --}}
            <div x-data="{ activeTab: 'encuestas' }">
                {{-- Navegación de Pestañas --}}
                <div class="mb-6">
                    <div class="border-b border-gray-200 dark:border-neutral-700">
                        <nav class="-mb-px flex space-x-4">
                            <a href="#" @click.prevent="activeTab = 'encuestas'"
                                :class="{
                                    'border-teal-500 text-teal-600 dark:border-teal-400 dark:text-teal-400': activeTab === 'encuestas',
                                    'border-transparent text-gray-500 dark:text-neutral-400 hover:text-gray-700 dark:hover:text-neutral-200 hover:border-gray-300 dark:hover:border-neutral-600': activeTab !== 'encuestas'
                                }"
                                class="px-3 py-2 font-semibold border-b-2 transition-colors">
                                Encuestas
                            </a>
                            <a href="#" @click.prevent="activeTab = 'actividades'"
                                :class="{
                                    'border-teal-500 text-teal-600 dark:border-teal-400 dark:text-teal-400': activeTab === 'actividades',
                                    'border-transparent text-gray-500 dark:text-neutral-400 hover:text-gray-700 dark:hover:text-neutral-200 hover:border-gray-300 dark:hover:border-neutral-600': activeTab !== 'actividades'
                                }"
                                class="px-3 py-2 font-semibold border-b-2 transition-colors">
                                Actividades y Pláticas
                            </a>
                        </nav>
                    </div>
                </div>

                {{-- Contenido de las Pestañas --}}
                <div>
                    {{-- Pestaña Encuestas --}}
                    <div x-show="activeTab === 'encuestas'" x-transition>
                        <div class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                           <div class="p-6 border-b border-gray-200 dark:border-neutral-700 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Encuestas</h3>
                                    <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">Crea y gestiona encuestas para tus tutorados</p>
                                </div>
                                <a href="{{-- ruta para nueva encuesta --}}"
                                   class="mt-3 sm:mt-0 flex items-center space-x-2 px-4 py-2 text-sm font-medium text-white bg-[#2B8A7F] border border-transparent rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                    
                                    <flux:icon.plus />  
                                    <span>Copiar link de encuesta</span>
                                </a>
                           </div>
                           <div class="p-6">
                                {{-- Aquí va tu tabla de encuestas (Livewire o Blade) --}}
                                {{-- @livewire('encuestas-table') --}}
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
        {{-- ... Añadir hasta 10 alumnos si tienes los datos ... --}}
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

                    {{-- Pestaña Actividades y Pláticas --}}
                     <div x-cloak x-show="activeTab === 'actividades'" x-transition>
                        <div class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                           <div class="p-6 border-b border-gray-200 dark:border-neutral-700 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Actividades y Pláticas</h3>
                                    <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">Registra pláticas y actividades realizadas</p>
                                </div>
                                 <a href="{{-- ruta para nueva actividad --}}"
                                   class="mt-3 sm:mt-0 flex items-center space-x-2 px-4 py-2 text-sm font-medium text-white bg-[#2B8A7F] border border-transparent rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                    <flux:icon.plus />  
                                    <span>Nueva Actividad</span>
                                </a>
                           </div>
                           <div class="p-6">
                               {{-- Aquí va tu tabla de actividades (Livewire o Blade) --}}
                               {{-- @livewire('actividades-table') --}}
                               {{-- Este div reemplaza el placeholder dentro de la pestaña "Actividades y Pláticas" --}}
<div class="overflow-x-auto mt-4">
    <table class="w-full text-sm text-left text-gray-600 dark:text-neutral-300">
        <thead class="bg-[#2B8A7F] text-xs text-white uppercase rounded-t-lg">
            {{-- Encabezados de la tabla --}}
            <tr>
                <th scope="col" class="px-6 py-3 font-semibold">Nombre</th>
                <th scope="col" class="px-6 py-3 font-semibold">Tipo</th>
                <th scope="col" class="px-6 py-3 font-semibold">Fecha y Hora</th>
                <th scope="col" class="px-6 py-3 font-semibold text-center">Asistentes</th>
                <th scope="col" class="px-6 py-3 font-semibold text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- Fila 1: Plática sobre Salud Mental --}}
            <tr class="bg-white dark:bg-neutral-900 border-b dark:border-neutral-700 hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-neutral-100 whitespace-nowrap">
                    Plática sobre Salud Mental
                </th>
                <td class="px-6 py-4">
                    {{-- Badge Outline --}}
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-md border border-gray-300 dark:border-neutral-600 text-gray-700 dark:text-neutral-300">
                        Plática
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center space-x-2 text-gray-700 dark:text-neutral-300">
                        {{-- Icono Calendario (Lucide) --}}
                        <flux:icon.calendar variant="micro" />
                        <span>
                            {{-- Formatear fecha: \Carbon\Carbon::parse('2025-01-20')->translatedFormat('j M Y') --}}
                            20 ene 2025 - 10:00
                        </span>
                    </div>
                </td>
                <td class="px-6 py-4 text-center">
                   <div class="flex items-center justify-center space-x-2 text-gray-700 dark:text-neutral-300">
                       {{-- Icono Usuarios (Lucide) --}}
                       <flux:icon.users variant="micro" />  
                       <span>45</span>
                   </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-end items-center space-x-3">
                        {{-- Botón Ver Detalles (Lucide Eye) --}}
                        <a href="{{-- route('actividades.show', 1) --}}" class="text-gray-500 dark:text-neutral-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors" title="Ver detalles">
                            <flux:icon.eye variant="micro" />                        
                        </a>
                        {{-- Botón Editar (Lucide Pencil) --}}
                        <button class="text-gray-500 dark:text-neutral-400 hover:text-green-600 dark:hover:text-green-400 transition-colors" title="Editar">
                           <flux:icon.pencil-square variant="micro" />
                        </button>
                    </div>
                </td>
            </tr>

            {{-- Fila 2: Taller de Técnicas de Estudio --}}
            <tr class="bg-white dark:bg-neutral-900 border-b dark:border-neutral-700 hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-neutral-100 whitespace-nowrap">
                    Taller de Técnicas de Estudio
                </th>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-md border border-gray-300 dark:border-neutral-600 text-gray-700 dark:text-neutral-300">
                        Actividad
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                   <div class="flex items-center space-x-2 text-gray-700 dark:text-neutral-300">
                        <flux:icon.calendar variant="micro" />
                        <span>18 ene 2025 - 14:00</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center space-x-2 text-gray-700 dark:text-neutral-300">
                       <flux:icon.users variant="micro" />  
                       <span>32</span>
                   </div>
                </td>
                <td class="px-6 py-4">
                     <div class="flex justify-end items-center space-x-3">
                        <a href="{{-- route('actividades.show', 2) --}}" class="text-gray-500 dark:text-neutral-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors" title="Ver detalles">
                            <flux:icon.eye variant="micro" />                        
                        </a>
                        <button class="text-gray-500 dark:text-neutral-400 hover:text-green-600 dark:hover:text-green-400 transition-colors" title="Editar">
                           <flux:icon.pencil-square variant="micro" />
                        </button>
                    </div>
                </td>
            </tr>

            {{-- Fila 3: Conferencia sobre Empleabilidad --}}
            <tr class="bg-white dark:bg-neutral-900 border-b dark:border-neutral-700 hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-neutral-100 whitespace-nowrap">
                    Conferencia sobre Empleabilidad
                </th>
                <td class="px-6 py-4">
                     <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-md border border-gray-300 dark:border-neutral-600 text-gray-700 dark:text-neutral-300">
                        Plática
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center space-x-2 text-gray-700 dark:text-neutral-300">
                        <flux:icon.calendar variant="micro" />
                        <span>15 ene 2025 - 11:00</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center space-x-2 text-gray-700 dark:text-neutral-300">
                       <flux:icon.users variant="micro" />  
                       <span>67</span>
                   </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-end items-center space-x-3">
                        <a href="{{-- route('actividades.show', 3) --}}" class="text-gray-500 dark:text-neutral-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors" title="Ver detalles">
                           <flux:icon.eye variant="micro" />
                        </a>
                        <button class="text-gray-500 dark:text-neutral-400 hover:text-green-600 dark:hover:text-green-400 transition-colors" title="Editar">
                            <flux:icon.pencil-square variant="micro" />
                    </div>
                </td>
            </tr>

            {{-- Añadir más filas con @foreach si es necesario --}}

        </tbody>
    </table>
</div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</x-layouts.app>