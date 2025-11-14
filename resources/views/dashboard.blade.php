<x-layouts.app :title="__('Dashboard')">

    <div class="bg-slate-50 dark:bg-[#262626]">

        <div class="p-6 md:p-8 max-w-7xl mx-auto">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-neutral-100">Dashboard</h1>
                <p class="text-sm text-gray-600 dark:text-neutral-400 mt-1">Bienvenido al Sistema de Gestión de Tutorías
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                <div
                    class="bg-white dark:bg-[#171717] rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700 flex flex-col justify-between">
                    <div class="p-6">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900/50 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 20h5v-2a3 3 0 00-5.356-2.121M12 6V5a3 3 0 013-3h2a3 3 0 013 3v1h-1.684A5.979 5.979 0 0012 11.155H5.823A5.979 5.979 0 000 17H1.316a3 3 0 005.356-2.121v-1.121zM12 6a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-100">Tutorados y Grupos
                            </h2>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-neutral-400">
                            Gestiona grupos, alumnos y observaciones por cuatrimestre.
                        </p>
                    </div>
                    <a href="{{ route ('grupo') }}"
                        class="block w-full bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium text-center p-3 rounded-b-lg transition-colors">
                        Acceder al Módulo
                    </a>
                </div>

                <div
                    class="bg-white dark:bg-[#171717] rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700 flex flex-col justify-between">
                    <div class="p-6">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="flex-shrink-0 bg-green-100 dark:bg-green-900/50 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-green-600 dark:text-green-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-100">Actividades</h2>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-neutral-400">
                            Registra pláticas, actividades y genera reportes.
                        </p>
                    </div>
                    <a href="{{ route ('actividades') }}"
                        class="block w-full bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium text-center p-3 rounded-b-lg transition-colors">
                        Acceder al Módulo
                    </a>
                </div>

                <div
                    class="bg-white dark:bg-[#171717] rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700 flex flex-col justify-between">
                    <div class="p-6">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="flex-shrink-0 bg-orange-100 dark:bg-orange-900/50 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-orange-600 dark:text-orange-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-100">Canalizaciones e
                                Informes</h2>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-neutral-400">
                            Genera canalizaciones e informes finales del cuatrimestre.
                        </p>
                    </div>
                    <a href="{{ route ('canalizaciones') }}"
                        class="block w-full bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium text-center p-3 rounded-b-lg transition-colors">
                        Acceder al Módulo
                    </a>
                </div>

                <div
                    class="bg-white dark:bg-[#171717] rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700 flex flex-col justify-between">
                    <div class="p-6">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="flex-shrink-0 bg-purple-100 dark:bg-purple-900/50 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-100">Estadías y Empresas
                            </h2>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-neutral-400">
                            Administra empresas y opciones de estadía de alumnos.
                        </p>
                    </div>
                    <a href="{{ route ('estadias') }}"
                        class="block w-full bg-teal-700 hover:bg-teal-800 text-white text-sm font-medium text-center p-3 rounded-b-lg transition-colors">
                        Acceder al Módulo
                    </a>
                </div>

            </div>
            <div
                class="bg-white dark:bg-[#171717] rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-100">Acceso Rápido</h2>
                    <p class="text-sm text-gray-600 dark:text-neutral-400 mb-5">Funciones más utilizadas del sistema</p>

                    <div class="flex flex-col md:flex-row md:space-x-4 space-y-3 md:space-y-0">

                        <a href="{{ route ('grupo') }}"
                            class="flex-1 flex items-center justify-center space-x-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-700 border border-gray-300 dark:border-neutral-600 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 dark:text-neutral-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>Ver Grupos Actuales</span>
                        </a>

                        <a href="{{ route ('encuestas') }}"
                            class="flex-1 flex items-center justify-center space-x-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-700 border border-gray-300 dark:border-neutral-600 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 dark:text-neutral-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>Información de Encuesta</span>
                        </a>

                        <a href="#"
                            class="flex-1 flex items-center justify-center space-x-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-700 border border-gray-300 dark:border-neutral-600 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 dark:text-neutral-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Generar Informe</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-layouts.app>
