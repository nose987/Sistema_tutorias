{{-- resources/views/canalizaciones-formato.blade.php --}}
<x-layouts.app :title="__('Llenar Formato de Canalización')">

    {{-- 
      Esta vista espera que el controlador le pase las variables 
      $canalizacion y $canalizacion->alumno
    --}}

    <div class="bg-slate-50 dark:bg-[#262626] p-6 md:p-8">
        <div class="max-w-5xl mx-auto">

            <header class="mb-6">
                {{-- Link para volver a la lista principal de canalizaciones --}}
                <a href="{{ route('canalizaciones') }}"
                    class="flex items-center space-x-1 text-sm font-medium text-gray-600 dark:text-neutral-400 hover:text-gray-900 dark:hover:text-neutral-100 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Volver a Canalizaciones</span>
                </a>

                <h1 class="text-3xl font-bold text-gray-900 dark:text-neutral-100">
                    Formato de Canalización
                </h1>
                <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">CÓDIGO: TUTOR-TUR-1A-04-00-150-2024</p>
            </header>

            {{-- Apuntamos la acción a la ruta 'storeFormato', pasando la canalización --}}
            <form action="{{ route('canalizaciones.formato.store', $canalizacion) }}" method="POST" class="space-y-6">
                @csrf

                {{-- ============================================= --}}
                {{-- BLOQUE DE RESUMEN DE ERRORES (NUEVO)          --}}
                {{-- ============================================= --}}
                @if ($errors->any())
                    <div class="rounded-md border border-red-400 bg-red-50 p-4 dark:bg-red-900/30">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800 dark:text-red-300">Hubo errores con tu envío
                                </h3>
                                <div class="mt-2 text-sm text-red-700 dark:text-red-400">
                                    <ul role="list" class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- ============================================= --}}
                {{-- FIN DEL BLOQUE DE ERRORES                     --}}
                {{-- ============================================= --}}


                <div
                    class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700 p-6 md:p-8">

                    {{-- 
                      NOTA: Tu BD vincula 'formato_canalizacion' con 'fk_alumno'.
                      Este input oculto se usará en el controlador.
                    --}}
                    

                    <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-100 mb-4">Datos del Alumno</h2>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div>
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Estudiante</label>
                            <p class="text-sm font-semibold text-gray-800 dark:text-neutral-100">
                                {{ $canalizacion->alumno->nombre_completo }}</p>
                        </div>
                        <div>
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Matrícula</label>
                            <p class="text-sm font-semibold text-gray-800 dark:text-neutral-100">
                                {{ $canalizacion->alumno->pk_alumno }}</p>
                        </div>
                        <div>
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Grado/Grupo</label>
                            <p class="text-sm font-semibold text-gray-800 dark:text-neutral-100">
                                {{ $canalizacion->alumno->grupo->nombre_grupo }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Celular</label>
                            <p class="text-sm font-semibold text-gray-800 dark:text-neutral-100">
                                {{ $canalizacion->alumno->celular ?? 'No registrado' }}</p>
                        </div>
                        <div class="md:col-span-4">
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-neutral-400">Domicilio</label>
                            <p class="text-sm font-semibold text-gray-800 dark:text-neutral-100">
                                {{ $canalizacion->alumno->direccion ?? 'No registrado' }}</p>
                        </div>
                    </div>

                    <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-100 mb-4">Datos del Formato</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="fecha_canalizacion"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Fecha</label>
                            <input type="date" id="fecha_canalizacion" name="fecha_canalizacion"
                                value="{{ old('fecha_canalizacion', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 @error('fecha_canalizacion') border-red-500 dark:border-red-500 @enderror">
                            @error('fecha_canalizacion')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="tutor_nombre"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Tutor (a)</label>
                            <input type="text" id="tutor_nombre" name="tutor_nombre"
                                value="{{ old('tutor_nombre', auth()->user()->name) }}"
                                class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 @error('tutor_nombre') border-red-500 dark:border-red-500 @enderror">
                            @error('tutor_nombre')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="carrera"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Carrera</label>
                            <input type="text" id="carrera" name="carrera"
                                value="{{ old('carrera', $canalizacion->alumno->carrera) }}"
                                class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 @error('carrera') border-red-500 dark:border-red-500 @enderror"
                                placeholder="Ingeniería en Software">
                            @error('carrera')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700 p-6 md:p-8">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-100 mb-4">Motivo</h2>

                    {{-- Resaltamos la caja del motivo principal seleccionado en el modal --}}
                    @php
                        $motivoPrincipal = strtolower($canalizacion->motivo->nombre);
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div
                            class="rounded-lg border-2 {{ str_contains($motivoPrincipal, 'acad') ? 'border-teal-500' : 'border-gray-200 dark:border-neutral-700' }} overflow-hidden">
                            <div class="bg-teal-700 text-white px-4 py-2 text-sm font-semibold">SITUACIÓN ACADÉMICA
                            </div>
                            <div class="p-4 space-y-3">
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_reprobacion" value="1"
                                        @checked(old('motivo_reprobacion'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Reprobación</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_constantes_faltas" value="1"
                                        @checked(old('motivo_constantes_faltas'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Constantes faltas</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_no_participa" value="1"
                                        @checked(old('motivo_no_participa'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">No participa</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_no_entrega_actividades" value="1"
                                        @checked(old('motivo_no_entrega_actividades'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">No entrega actividades</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_dificultad_asignatura" value="1"
                                        @checked(old('motivo_dificultad_asignatura'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Dificultad en Asignatura</span>
                                </label>
                            </div>
                        </div>

                        <div
                            class="rounded-lg border-2 {{ str_contains($motivoPrincipal, 'inasistencia') ? 'border-teal-500' : 'border-gray-200 dark:border-neutral-700' }} overflow-hidden">
                            <div class="bg-teal-700 text-white px-4 py-2 text-sm font-semibold">INASISTENCIA</div>
                            <div class="p-4 space-y-3">
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_inasistencia_distancia" value="1"
                                        @checked(old('motivo_inasistencia_distancia'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Distancia</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_inasistencia_transporte" value="1"
                                        @checked(old('motivo_inasistencia_transporte'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Transporte</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_inasistencia_enfermedad" value="1"
                                        @checked(old('motivo_inasistencia_enfermedad'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Enfermedad</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_inasistencia_familiar" value="1"
                                        @checked(old('motivo_inasistencia_familiar'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Familiar</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_inasistencia_personal" value="1"
                                        @checked(old('motivo_inasistencia_personal'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Personal</span>
                                </label>
                            </div>
                        </div>

                        <div
                            class="rounded-lg border-2 {{ str_contains($motivoPrincipal, 'salud') ? 'border-teal-500' : 'border-gray-200 dark:border-neutral-700' }} overflow-hidden">
                            <div class="bg-teal-700 text-white px-4 py-2 text-sm font-semibold">PROBLEMAS SALUD</div>
                            <div class="p-4 space-y-3">
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_salud_dolor_cabeza" value="1"
                                        @checked(old('motivo_salud_dolor_cabeza'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Dolor de cabeza</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_salud_dolor_estomago" value="1"
                                        @checked(old('motivo_salud_dolor_estomago'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Dolor de estómago</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_salud_dolor_muscular" value="1"
                                        @checked(old('motivo_salud_dolor_muscular'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Dolor muscular</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_salud_respiratorios" value="1"
                                        @checked(old('motivo_salud_respiratorios'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Respiratorios</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_salud_vertigo" value="1"
                                        @checked(old('motivo_salud_vertigo'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Vértigo</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_salud_vomito" value="1"
                                        @checked(old('motivo_salud_vomito'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Vómito</span>
                                </label>
                            </div>
                        </div>

                        <div
                            class="rounded-lg border-2 {{ str_contains($motivoPrincipal, 'adicci') ? 'border-teal-500' : 'border-gray-200 dark:border-neutral-700' }} overflow-hidden">
                            <div class="bg-teal-700 text-white px-4 py-2 text-sm font-semibold">SÍNTOMAS DE ADICCIÓN
                            </div>
                            <div class="p-4 space-y-3">
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_adiccion_ojos_rojos" value="1"
                                        @checked(old('motivo_adiccion_ojos_rojos'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Ojos rojos</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_adiccion_somnolencia" value="1"
                                        @checked(old('motivo_adiccion_somnolencia'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Somnolencia</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_adiccion_aliento_alcoholico" value="1"
                                        @checked(old('motivo_adiccion_aliento_alcoholico'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Aliento Alcohólico</span>
                                </label>
                            </div>
                        </div>

                        <div
                            class="rounded-lg border-2 {{ str_contains($motivoPrincipal, 'comportamiento') ? 'border-teal-500' : 'border-gray-200 dark:border-neutral-700' }} overflow-hidden">
                            <div class="bg-teal-700 text-white px-4 py-2 text-sm font-semibold">PROBLEMAS DE
                                COMPORTAMIENTO</div>
                            <div class="p-4 space-y-3">
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_comportamiento_agresivo" value="1"
                                        @checked(old('motivo_comportamiento_agresivo'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Agresivo</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_comportamiento_indisciplina" value="1"
                                        @checked(old('motivo_comportamiento_indisciplina'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Indisciplina</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_comportamiento_desafiante" value="1"
                                        @checked(old('motivo_comportamiento_desafiante'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Desafiante</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_comportamiento_irrespetuoso" value="1"
                                        @checked(old('motivo_comportamiento_irrespetuoso'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Irrespetuoso</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_comportamiento_desinteres" value="1"
                                        @checked(old('motivo_comportamiento_desinteres'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Desinterés</span>
                                </label>
                            </div>
                        </div>

                        <div
                            class="rounded-lg border-2 {{ str_contains($motivoPrincipal, 'estr') ? 'border-teal-500' : 'border-gray-200 dark:border-neutral-700' }} overflow-hidden">
                            <div class="bg-teal-700 text-white px-4 py-2 text-sm font-semibold">SÍNTOMAS DE ESTRÉS
                            </div>
                            <div class="p-4 space-y-3">
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_estres_frustracion" value="1"
                                        @checked(old('motivo_estres_frustracion'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Frustración</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_estres_desmotivacion" value="1"
                                        @checked(old('motivo_estres_desmotivacion'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Desmotivación</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_estres_cansancio" value="1"
                                        @checked(old('motivo_estres_cansancio'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Cansancio</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_estres_hiperactividad" value="1"
                                        @checked(old('motivo_estres_hiperactividad'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Hiperactividad</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_estres_ansiedad" value="1"
                                        @checked(old('motivo_estres_ansiedad'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Ansiedad</span>
                                </label>
                            </div>
                        </div>

                        <div
                            class="rounded-lg border-2 {{ str_contains($motivoPrincipal, 'socioecon') ? 'border-teal-500' : 'border-gray-200 dark:border-neutral-700' }} overflow-hidden">
                            <div class="bg-teal-700 text-white px-4 py-2 text-sm font-semibold">PROBLEMA SOCIOECONÓMICO
                            </div>
                            <div class="p-4 space-y-3">
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_socioeconomico_matrimonio" value="1"
                                        @checked(old('motivo_socioeconomico_matrimonio'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Matrimonio</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_socioeconomico_embarazo" value="1"
                                        @checked(old('motivo_socioeconomico_embarazo'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Embarazo</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_socioeconomico_no_desea_estudiar"
                                        value="1" @checked(old('motivo_socioeconomico_no_desea_estudiar'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">No desea seguir estudiando</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_socioeconomico_decidio_trabajar"
                                        value="1" @checked(old('motivo_socioeconomico_decidio_trabajar'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Decidió trabajar</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_socioeconomico_horario_laboral"
                                        value="1" @checked(old('motivo_socioeconomico_horario_laboral'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Horario laboral</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_socioeconomico_pago_mensualidades"
                                        value="1" @checked(old('motivo_socioeconomico_pago_mensualidades'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Pago mensualidades</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_socioeconomico_transporte" value="1"
                                        @checked(old('motivo_socioeconomico_transporte'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Transporte</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_socioeconomico_manutencion" value="1"
                                        @checked(old('motivo_socioeconomico_manutencion'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Manutención</span>
                                </label>
                            </div>
                        </div>

                        <div
                            class="rounded-lg border-2 {{ str_contains($motivoPrincipal, 'falta') ? 'border-teal-500' : 'border-gray-200 dark:border-neutral-700' }} overflow-hidden">
                            <div class="bg-teal-700 text-white px-4 py-2 text-sm font-semibold">FALTAS INSTITUCIONALES
                            </div>
                            <div class="p-4 space-y-3">
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_faltas_ebrio" value="1"
                                        @checked(old('motivo_faltas_ebrio'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Ebrio</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_faltas_drogado" value="1"
                                        @checked(old('motivo_faltas_drogado'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Drogado</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_faltas_vandalismo" value="1"
                                        @checked(old('motivo_faltas_vandalismo'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Vandalismo</span>
                                </label>
                                <label class="flex items-center text-sm text-gray-700 dark:text-neutral-200">
                                    <input type="checkbox" name="motivo_faltas_porta_armas_drogas" value="1"
                                        @checked(old('motivo_faltas_porta_armas_drogas'))
                                        class="form-checkbox h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                    <span class="ml-3">Porta armas / Drogas</span>
                                </label>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label for="motivo_otros"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Otros
                                (especifique):</label>
                            <input type="text" id="motivo_otros" name="motivo_otros"
                                value="{{ old('motivo_otros') }}"
                                class="mt-1 block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-[#262626] rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700 p-6 md:p-8">
                    <div class="space-y-6">
                        <div>
                            <label for="observaciones_tutor"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-200 mb-2">
                                OBSERVACIONES POR TUTOR:
                            </label>
                            <textarea id="observaciones_tutor" name="observaciones_tutor" rows="4"
                                class="block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 @error('observaciones_tutor') border-red-500 dark:border-red-500 @enderror">{{ old('observaciones_tutor') }}</textarea>
                            @error('observaciones_tutor')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="acciones_tutor"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-200 mb-2">
                                ACCIONES APLICADAS POR EL TUTOR:
                            </label>
                            <textarea id="acciones_tutor" name="acciones_tutor" rows="4"
                                class="block w-full text-sm border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 @error('acciones_tutor') border-red-500 dark:border-red-500 @enderror">{{ old('acciones_tutor') }}</textarea>
                            @error('acciones_tutor')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-teal-600 text-white rounded-md text-sm font-medium hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Guardar Formato
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-layouts.app>