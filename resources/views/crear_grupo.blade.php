<x-layouts.app :title="__('Nuevo Grupo')">

    {{-- Se usa 'h-screen' y se resta el alto del header para un scroll independiente del contenido --}}
    <div class="flex h-screen overflow-hidden">

        <main class="flex-1 p-6 md:p-8 bg-slate-50 dark:bg-[#262626] overflow-y-auto">

            <!-- Header -->
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ url('grupo') }}" 
                    class="flex items-center space-x-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-neutral-300 hover:text-gray-900 dark:hover:text-neutral-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Volver</span>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-neutral-100">Nuevo Grupo</h1>
                    <p class="text-sm text-gray-500 dark:text-neutral-400">Registra un nuevo grupo de tutorados</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                <div class="p-6 border-b border-gray-200 dark:border-neutral-700">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Información del Grupo</h3>
                    <p class="text-sm text-gray-500 dark:text-neutral-400">Completa los datos del grupo y sus alumnos</p>
                </div>
                <div class="p-6">
                    <form class="space-y-6">
                        <!-- Información del Grupo -->
                        <div>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-neutral-100 mb-4">Datos del Grupo</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="nombreGrupo" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Nombre del Grupo *
                                    </label>
                                    <input type="text" id="nombreGrupo" name="nombreGrupo" required 
                                        placeholder="Ej: Ingeniería en Software 5A"
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>

                                <div>
                                    <label for="cuatrimestre" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Cuatrimestre *
                                    </label>
                                    <select id="cuatrimestre" name="cuatrimestre" required
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                        <option value="">Seleccionar...</option>
                                        <option value="ene-abr-2025">Enero-Abril 2025</option>
                                        <option value="may-ago-2025">Mayo-Agosto 2025</option>
                                        <option value="sep-dic-2025">Septiembre-Diciembre 2025</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="carrera" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Carrera *
                                    </label>
                                    <select id="carrera" name="carrera" required
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                        <option value="">Seleccionar...</option>
                                        <option value="software">Ingeniería en Software</option>
                                        <option value="datos">Ingeniería en Datos</option>
                                        <option value="redes">Ingeniería en Redes</option>
                                        <option value="ciberseguridad">Ingeniería en Ciberseguridad</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="semestre" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Semestre *
                                    </label>
                                    <input type="number" id="semestre" name="semestre" required min="1" max="12" 
                                        placeholder="Ej: 5"
                                        class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>
                            </div>
                        </div>

                        <!-- Alumnos -->
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-base font-semibold text-gray-800 dark:text-neutral-100">Alumnos del Grupo</h3>
                                <button type="button" 
                                    class="flex items-center space-x-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>Agregar Alumno</span>
                                </button>
                            </div>

                            <div class="space-y-3">
                                <!-- Alumno Template -->
                                <div class="bg-gray-50 dark:bg-neutral-800 p-4 rounded-lg border border-gray-200 dark:border-neutral-700">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                                Nombre Completo *
                                            </label>
                                            <input type="text" name="alumnoNombre[]" required 
                                                placeholder="Nombre del alumno"
                                                class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-900 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                                Matrícula *
                                            </label>
                                            <input type="text" name="alumnoMatricula[]" required 
                                                placeholder="2021001"
                                                class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-900 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                                Correo Electrónico
                                            </label>
                                            <input type="email" name="alumnoEmail[]" 
                                                placeholder="alumno@universidad.edu"
                                                class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-900 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                            <a href="{{ url('/grupos') }}" 
                                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-colors">
                                Cancelar
                            </a>
                            <button type="submit" 
                                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-[#2B8A7F] border border-transparent rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors">
                                Guardar Grupo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-layouts.app>