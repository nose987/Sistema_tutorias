<x-layouts.app :title="__('Encuesta')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <!-- Encabezado -->
        <div class="flex items-start justify-between">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-neutral-100">Encuesta de Satisfacción - Enero 2025</h1>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#2B8A7F] text-white">
                        Activa
                    </span>
                </div>
                <p class="text-gray-600 dark:text-neutral-400">Evaluación de la experiencia de tutoría del primer mes</p>
            </div>
            <div class="flex gap-2">
                <button class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-50 dark:bg-neutral-900 border border-gray-300 dark:border-neutral-700 rounded-md hover:bg-gray-50 dark:hover:bg-neutral-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" x2="12" y1="15" y2="3"/>
                    </svg>
                    Exportar Resultados
                </button>
            </div>
        </div>

        <!-- Card de Enlace -->
        <div class="bg-gray-50 dark:bg-neutral-900 rounded-lg border border-gray-200 dark:border-neutral-700">
            <div class="p-6 border-b border-gray-200 dark:border-neutral-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-neutral-100">Enlace de la Encuesta</h3>
                <p class="text-sm text-gray-600 dark:text-neutral-400 mt-1">Comparte este enlace con tus tutorados</p>
            </div>
            <div class="p-6">
                <div class="flex gap-2">
                    <input 
                        type="text" 
                        value="https://sistema-tutorias.edu/encuesta/" 
                        readonly 
                        class="flex-1 px-3 py-2 text-sm font-mono bg-gray-50 dark:bg-neutral-700 border border-gray-300 dark:border-neutral-600 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2B8A7F]"
                    >
                    <button class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-md hover:bg-gray-50 dark:hover:bg-neutral-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                        </svg>
                        Copiar
                    </button>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-gray-50 dark:bg-neutral-900 rounded-lg border border-gray-200 dark:border-neutral-700">
                <div class="p-6 pb-3">
                    <p class="text-sm text-gray-600 dark:text-neutral-400">Respuestas Recibidas</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-neutral-100 mt-1">45</h3>
                </div>
                <div class="px-6 pb-6">
                    <p class="text-sm text-gray-600 dark:text-neutral-400">Total de participantes</p>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-neutral-900 rounded-lg border border-gray-200 dark:border-neutral-700">
                <div class="p-6 pb-3">
                    <p class="text-sm text-gray-600 dark:text-neutral-400">Tasa de Respuesta</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-neutral-100 mt-1">52%</h3>
                </div>
                <div class="px-6 pb-6">
                    <p class="text-sm text-gray-600 dark:text-neutral-400">De 87 tutorados</p>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-neutral-900 rounded-lg border border-gray-200 dark:border-neutral-700">
                <div class="p-6 pb-3">
                    <p class="text-sm text-gray-600 dark:text-neutral-400">Última Respuesta</p>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-neutral-100 mt-1">Hace 2 horas</h3>
                </div>
                <div class="px-6 pb-6">
                    <p class="text-sm text-gray-600 dark:text-neutral-400">15 de Enero, 2025</p>
                </div>
            </div>
        </div>

        <!-- Resumen de Resultados
        <div class="bg-gray-50 dark:bg-neutral-900 rounded-lg border border-gray-200 dark:border-neutral-700">
            <div class="p-6 border-b border-gray-200 dark:border-neutral-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-neutral-100">Resumen de Resultados</h3>
                <p class="text-sm text-gray-600 dark:text-neutral-400 mt-1">Vista previa de las respuestas</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="p-4 border border-gray-200 dark:border-neutral-700 rounded-lg">
                        <p class="font-medium mb-3 text-gray-900 dark:text-neutral-100">1. ¿Cómo calificarías tu experiencia con las tutorías?</p>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-[#2B8A7F]">Excelente</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-48 h-2 bg-gray-200 dark:bg-neutral-600 rounded-full overflow-hidden">
                                        <div class="h-full bg-[#2B8A7F]" style="width: 60%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-neutral-100">27</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-[#2B8A7F]">Bueno</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-48 h-2 bg-gray-200 dark:bg-neutral-600 rounded-full overflow-hidden">
                                        <div class="h-full bg-[#2B8A7F]" style="width: 30%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-neutral-100">13</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-[#2B8A7F]">Regular</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-48 h-2 bg-gray-200 dark:bg-neutral-600 rounded-full overflow-hidden">
                                        <div class="h-full bg-[#2B8A7F]" style="width: 10%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-neutral-100">5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

-->

        <!-- Últimas Respuestas -->
        <div class="bg-gray-50 dark:bg-neutral-900 rounded-lg border border-gray-200 dark:border-neutral-700">
            <div class="p-6 border-b border-gray-200 dark:border-neutral-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-neutral-100">Últimas Respuestas</h3>
                <p class="text-sm text-gray-600 dark:text-neutral-400 mt-1">Las 5 personas más recientes en completar la encuesta.</p>
            </div>
            <div class="p-6">
                <ul class="divide-y divide-gray-200 dark:divide-neutral-700">
                    <!-- Persona 1 -->
                    <li class="py-4 flex items-center justify-between">
                        <span class="text-gray-800 dark:text-neutral-200">Juan Pérez</span>
                        <a href="#" class="inline-flex items-center gap-2 px-3 py-1 text-sm font-medium text-[#2B8A7F] hover:text-[#1A534C] dark:text-[#55A99F] dark:hover:text-[#72BDB3]">
                            Detalle
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                    <!-- Persona 2 -->
                    <li class="py-4 flex items-center justify-between">
                        <span class="text-gray-800 dark:text-neutral-200">Maria García</span>
                        <a href="#" class="inline-flex items-center gap-2 px-3 py-1 text-sm font-medium text-[#2B8A7F] hover:text-[#1A534C] dark:text-[#55A99F] dark:hover:text-[#72BDB3]">
                            Detalle
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                    <!-- Persona 3 -->
                    <li class="py-4 flex items-center justify-between">
                        <span class="text-gray-800 dark:text-neutral-200">Carlos Rodriguez</span>
                        <a href="#" class="inline-flex items-center gap-2 px-3 py-1 text-sm font-medium text-[#2B8A7F] hover:text-[#1A534C] dark:text-[#55A99F] dark:hover:text-[#72BDB3]">
                            Detalle
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                    <!-- Persona 4 -->
                    <li class="py-4 flex items-center justify-between">
                        <span class="text-gray-800 dark:text-neutral-200">Ana Lopez</span>
                        <a href="#" class="inline-flex items-center gap-2 px-3 py-1 text-sm font-medium text-[#2B8A7F] hover:text-[#1A534C] dark:text-[#55A99F] dark:hover:text-[#72BDB3]">
                            Detalle
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                    <!-- Persona 5 -->
                    <li class="py-4 flex items-center justify-between">
                        <span class="text-gray-800 dark:text-neutral-200">Luis Martinez</span>
                        <a href="#" class="inline-flex items-center gap-2 px-3 py-1 text-sm font-medium text-[#2B8A7F] hover:text-[#1A534C] dark:text-[#55A99F] dark:hover:text-[#72BDB3]">
                            Detalle
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                </ul>
                <div class="mt-6 text-center">
                    <button class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-md hover:bg-gray-50 dark:hover:bg-neutral-700 transition-colors">
                        Mostrar más
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
