{{-- resources/views/canalizaciones-detalle.blade.php --}}
<x-layouts.app :title="__('Detalle Canalización #' . $canalizacion->pk_canalizacion)">

    {{-- Main container for the page content --}}
    <div class="bg-slate-50 dark:bg-neutral-900 p-6 md:p-8" x-data="{ modalBaja: false }">

        {{-- Max width container --}}
        <div class="max-w-7xl mx-auto">

            {{-- ============================================= --}}
            {{-- SECCIÓN 1: ENCABEZADO Y DATOS DE CANALIZACIÓN --}}
            {{-- ============================================= --}}
            <header class="mb-6">
                {{-- Link de Volver --}}
                <a href="{{ route('canalizaciones') }}"
                    class="flex items-center space-x-1 text-sm font-medium text-gray-600 dark:text-neutral-400 hover:text-gray-900 dark:hover:text-neutral-100 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Volver</span>
                </a>

                {{-- Header content: Title and Action Buttons --}}
                <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
                    {{-- Títulos --}}
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-neutral-100">
                            Canalización <span class="text-teal-600">#{{ $canalizacion->pk_canalizacion }}</span>
                        </h1>
                        <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">
                            {{ $canalizacion->alumno->nombre_completo }} - {{ $canalizacion->alumno->pk_alumno }}
                        </p>
                    </div>
                    {{-- Botones del encabezado 
                    <div class="flex items-center space-x-3">
                        <button
                            class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Ver Formato</span>
                        </button>
                        <button
                            class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span>Descargar PDF</span>
                        </button>
                    </div>--}}
                </div>
            </header>

            {{-- Grid Principal (Info Izquierda | Acciones Derecha) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                {{-- Columna Izquierda: Información --}}
                <div
                    class="lg:col-span-2 bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-100 mb-6">Información de la
                        Canalización</h2>

                    {{-- Formato (Static data) --}}
                    <p class="text-sm text-gray-500 dark:text-neutral-400 mb-4">
                        Formato TUTOR-TUR-IA-04-00-150-2024
                    </p>

                    {{-- Grid de Detalles (Fecha, Estatus, Carrera, Grupo) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Fecha</label>
                            <p class="text-sm font-semibold text-gray-800 dark:text-neutral-100">
                                {{ \Carbon\Carbon::parse($canalizacion->fecha_inicio)->format('d-m-Y') }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Estatus</label>
                            <span
                                class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium {{ $canalizacion->estatus == 'Activa' ? 'bg-teal-100 dark:bg-teal-900 text-teal-800 dark:text-teal-200' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200' }}">
                                {{ $canalizacion->estatus }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Carrera</label>
                            {{-- Usamos $formato?->carrera. El '?->' evita errores si $formato es null --}}
                            <p class="text-sm font-semibold text-gray-800 dark:text-neutral-100">
                                {{ $formato?->carrera ?? 'No especificada' }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Grado/Grupo</label>
                            <p class="text-sm font-semibold text-gray-800 dark:text-neutral-100">
                                {{ $canalizacion->alumno->grupo->nombre_grupo }}
                            </p>
                        </div>
                    </div>

                    {{-- Motivos --}}
                    <div class="mb-6">
                        <label class="block text-xs font-medium text-gray-500 dark:text-neutral-400 mb-2">Motivos de
                            Canalización</label>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-800 dark:bg-neutral-700 text-white dark:text-neutral-100">
                                {{ $canalizacion->motivo->nombre }}
                            </span>
                            {{-- NOTE: Your DB schema only links one main motivo. Displaying more would require schema changes. --}}
                        </div>
                    </div>

                    {{-- Observaciones y Acciones (Data from formato_canalizacion table) --}}
                    {{-- These are static for now, as they are not directly linked to the 'canalizacion' record --}}
                    <div class="mb-6">
                        <label class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Observaciones por
                            Tutor</label>
                        <p class="text-sm text-gray-800 dark:text-neutral-100 mt-1">
                            {{ $formato?->observaciones_tutor ?? 'Sin observaciones registradas' }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Acciones Aplicadas
                            por el Tutor</label>
                        <p class="text-sm text-gray-800 dark:text-neutral-100 mt-1">
                            {{ $formato?->acciones_tutor ?? 'Sin acciones registradas' }}
                        </p>
                    </div>
                </div> {{-- Fin Columna Izquierda --}}

                {{-- Columna Derecha: Acciones --}}
                <div classs="lg:col-span-1">
                    <div
                        class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700 p-6">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-100 mb-4">Acciones</h2>
                        <div class="space-y-3">
                            {{-- Action buttons (functionality not implemented yet) 
                            <button type="button"
                                class="w-full text-left px-4 py-3 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg text-sm font-medium text-gray-700 dark:text-neutral-200 hover:bg-gray-50 dark:hover:bg-neutral-700 transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500">
                                Editar Canalización
                            </button>
                            <button type="button"
                                class="w-full text-left px-4 py-3 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg text-sm font-medium text-gray-700 dark:text-neutral-200 hover:bg-gray-50 dark:hover:bg-neutral-700 transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500">
                                Agregar Seguimiento
                            </button>--}}
                            <a href="{{ route('alumnos.historial', $canalizacion->alumno) }}"
                                class="block w-full text-left px-4 py-3 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg text-sm font-medium text-gray-700 dark:text-neutral-200 hover:bg-gray-50 dark:hover:bg-neutral-700 transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500">
                                Ver Historial Completo
                            </a>
                            <button type="button"
                                class="w-full text-left px-4 py-3 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg text-sm font-medium text-gray-700 dark:text-neutral-200 hover:bg-gray-50 dark:hover:bg-neutral-700 transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500">
                                Ver Perfil del Alumno
                            </button>
                            <button type="button" @click="modalBaja = true "
                                class="w-full text-left px-4 py-3 bg-red-50 dark:bg-red-900/30 border border-red-300 dark:border-red-700 rounded-lg text-sm font-medium text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
                                Dar de Baja al Alumno
                            </button>
                        </div>
                    </div>
                </div> {{-- Fin Columna Derecha --}}

            </div> {{-- Fin del Grid Principal --}}


            {{-- ============================================= --}}
            {{-- SECCIÓN 2: FORMULARIO DE SEGUIMIENTO Y RESULTADO --}}
            {{-- ============================================= --}}
            <div
                class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
                {{-- Form Header --}}
                <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-100">Seguimiento y Resultado CAIE
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-neutral-400">Atención Integral Estudiantil</p>
                </div>

                {{-- Form Body --}}
                {{-- This form needs a route and controller method, e.g., 'canalizaciones.seguimiento.store' --}}
                <form action="{{ route('canalizaciones.seguimiento.store', $canalizacion) }}" method="POST"
                    class="p-6 md:p-8 space-y-6">
                    @csrf

                    {{-- 
                      IMPORTANT: The 'canalizacion_seguimiento' table links via 'fk_formato_canalizacion'.
                      You need to pass the ID of the associated 'formato_canalizacion' record.
                      Assuming you pass it as $formato_id from the controller. If no format exists yet,
                      you might need to create it first or adjust the logic/UI.
                    --}}
                    {{-- <input type="hidden" name="fk_formato_canalizacion" value="{{ $formato_id }}"> --}}
                    <input type="hidden" name="fk_formato_canalizacion" value="1"> {{-- Placeholder value --}}


                    {{-- Top Row: Date and Modality --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="fecha_seguimiento"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Fecha</label>
                            <input type="date" id="fecha_seguimiento" name="fecha_seguimiento"
                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        </div>
                        <div>
                            <label for="modalidad_seguimiento"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Modalidad</label>
                            <select id="modalidad_seguimiento" name="modalidad_seguimiento"
                                class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                                <option value="" disabled selected>Selecciona modalidad...</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Virtual">Virtual</option>
                                <option value="Telefónica">Telefónica</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>

                    {{-- Responsible Person(s) --}}
                    <div>
                        <label for="responsable_atencion"
                            class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Responsable(s) de la
                            Atención</label>
                        <input type="text" id="responsable_atencion" name="responsable_atencion"
                            placeholder="Nombre(s) del personal responsable"
                            class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    </div>

                    {{-- Diagnosis --}}
                    <div>
                        <label for="diagnostico_otorgado"
                            class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Diagnóstico
                            otorgado</label>
                        <textarea id="diagnostico_otorgado" name="diagnostico_otorgado" rows="3"
                            placeholder="Describe el diagnóstico..."
                            class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"></textarea>
                    </div>

                    {{-- Area Tracking Section --}}
                    <div
                        class="rounded-lg border border-gray-300 dark:border-neutral-700 divide-y divide-gray-300 dark:divide-neutral-700">
                        {{-- Section Header --}}
                        <div class="px-4 py-3 bg-gray-50 dark:bg-neutral-700 rounded-t-lg">
                            <h3 class="text-sm font-semibold text-gray-800 dark:text-neutral-100">Seguimiento de Áreas
                                de Atención</h3>
                        </div>
                        {{-- Textareas for each area --}}
                        <div class="p-4 space-y-4">
                            <div>
                                <label for="seguimiento_tutorias"
                                    class="block text-xs font-medium text-gray-500 dark:text-neutral-400">TUTORÍAS</label>
                                <textarea id="seguimiento_tutorias" name="seguimiento_tutorias" rows="2"
                                    placeholder="Seguimiento del área de tutorías..."
                                    class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"></textarea>
                            </div>
                            <div>
                                <label for="seguimiento_medico"
                                    class="block text-xs font-medium text-gray-500 dark:text-neutral-400">MÉDICO</label>
                                <textarea id="seguimiento_medico" name="seguimiento_medico" rows="2"
                                    placeholder="Seguimiento del área médica..."
                                    class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"></textarea>
                            </div>
                            <div>
                                <label for="seguimiento_psicologo"
                                    class="block text-xs font-medium text-gray-500 dark:text-neutral-400">PSICÓLOGO</label>
                                <textarea id="seguimiento_psicologo" name="seguimiento_psicologo" rows="2"
                                    placeholder="Seguimiento del área de psicología..."
                                    class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"></textarea>
                            </div>
                            <div>
                                <label for="seguimiento_trabajo_social"
                                    class="block text-xs font-medium text-gray-500 dark:text-neutral-400">TRABAJO
                                    SOCIAL</label>
                                <textarea id="seguimiento_trabajo_social" name="seguimiento_trabajo_social" rows="2"
                                    placeholder="Seguimiento del área de trabajo social..."
                                    class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Form Footer: Save/Cancel Buttons --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-neutral-700">
                        <button type="button"
                            class="px-4 py-2 bg-white dark:bg-neutral-700 border border-gray-300 dark:border-neutral-600 rounded-md text-sm font-medium text-gray-700 dark:text-neutral-200 hover:bg-gray-50 dark:hover:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-teal-600 text-white rounded-md text-sm font-medium hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            Guardar Seguimiento
                        </button>
                    </div>
                </form> {{-- Fin del Formulario de Seguimiento --}}
            </div> {{-- Fin del Card del Formulario --}}

        </div> {{-- Fin de max-w-7xl --}}
        {{-- ============================================= --}}
        {{-- MODAL DE CONFIRMACIÓN DE BAJA                 --}}
        {{-- ============================================= --}}
        <div x-show="modalBaja" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center p-4" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

            {{-- Fondo oscuro --}}
            <div x-show="modalBaja" @click="modalBaja = false"
                class="absolute inset-0 bg-gray-900/70 dark:bg-black/80" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
            </div>

            {{-- Panel del Modal --}}
            <div x-show="modalBaja" class="relative w-full max-w-md bg-white dark:bg-neutral-800 rounded-lg shadow-xl"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <div class="p-6">
                    <div class="flex items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/50 sm:mx-0 sm:h-10 sm:w-10">
                            {{-- Icono de Alerta --}}
                            <svg class="h-6 w-6 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-neutral-100">
                                Confirmar Baja de Alumno
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-neutral-400">
                                    ¿Estás seguro de que deseas dar de baja a <strong
                                        class="font-semibold">{{ $canalizacion->alumno->nombre_completo }}</strong>?
                                    Esta acción cambiará su estatus a "Baja".
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pie del Modal (con el formulario) --}}
                <div
                    class="bg-gray-50 dark:bg-neutral-800/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
                    {{-- Formulario que envía la petición --}}
                    <form action="{{ route('alumnos.baja', $canalizacion->alumno) }}" method="POST"
                        class="w-full sm:w-auto">
                        @csrf
                        <div class="mb-4">
                            <label for="motivo_baja"
                                class="block text-sm font-medium text-left text-gray-700 dark:text-neutral-200">
                                Motivo de la Baja (Requerido)
                            </label>
                            <select id="motivo_baja" name="motivo_baja" required
                                class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                                <option value="" disabled selected>Selecciona un motivo...</option>

                                {{-- Esto itera sobre la variable que pasamos desde el controlador --}}
                                @foreach ($motivos_baja as $motivo)
                                    <option value="{{ $motivo->pk_motivo_baja }}">{{ $motivo->nombre }}</option>
                                @endforeach

                            </select>
                        </div>
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Confirmar Baja
                        </button>
                    </form>

                    <button type="button" @click="modalBaja = false"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-neutral-600 shadow-sm px-4 py-2 bg-white dark:bg-neutral-700 text-base font-medium text-gray-700 dark:text-neutral-200 hover:bg-gray-50 dark:hover:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div> {{-- Fin de bg-slate-50 --}}


</x-layouts.app>
