<x-layouts.app :title="__('Nuevo Alumno')">
    {{-- Se usa 'h-screen' y se resta el alto del header para un scroll independiente del contenido --}}
    <div class="flex h-screen overflow-hidden">
        <main class="flex-1 p-6 md:p-8 bg-slate-50 dark:bg-[#262626] overflow-y-auto">

            @php
                // prioriza ?grupo= en la URL, luego el $preselect pasado por el controller, y luego old('fk_grupo')
                $gid = request('grupo') ?? ($preselect ?? old('fk_grupo'));
                $backUrl = $gid ? route('detalle_grupo', $gid) : route('grupo');
            @endphp

            <!-- Header -->
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ $backUrl }}"
                    class="flex items-center space-x-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-neutral-300 hover:text-gray-900 dark:hover:text-neutral-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Volver</span>
                </a>

                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-neutral-100">Nuevo Alumno</h1>
                    <p class="text-sm text-gray-500 dark:text-neutral-400">Registra un nuevo alumno en el sistema</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">

                <div class="p-6 border-b border-gray-200 dark:border-neutral-700">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Información del Alumno</h3>
                    <p class="text-sm text-gray-500 dark:text-neutral-400">
                        Completa los datos personales y académicos del alumno
                    </p>
                </div>

                <div class="p-6">
                    {{-- Errores de validación --}}
                    @if ($errors->any())
                        <div class="mb-4 rounded-lg border border-red-300 bg-red-50 dark:bg-red-900/20 p-3 text-sm text-red-700 dark:text-red-300">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="space-y-6" method="POST" action="{{ route('alumnos.store') }}">
                        @csrf

                        <!-- Datos Personales -->
                        <div>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-neutral-100 mb-4">Datos Personales</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Nombre(s) *
                                    </label>
                                    <input type="text" id="nombre" name="nombre" required
                                           value="{{ old('nombre') }}"
                                           placeholder="Ej: Juan Carlos"
                                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>

                                <div>
                                    <label for="apellido_paterno" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Apellido Paterno *
                                    </label>
                                    <input type="text" id="apellido_paterno" name="apellido_paterno" required
                                           value="{{ old('apellido_paterno') }}"
                                           placeholder="Ej: López"
                                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>

                                <div>
                                    <label for="apellido_materno" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Apellido Materno
                                    </label>
                                    <input type="text" id="apellido_materno" name="apellido_materno"
                                           value="{{ old('apellido_materno') }}"
                                           placeholder="Ej: García"
                                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>

                                <div>
                                    <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Fecha de Nacimiento
                                    </label>
                                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                                           value="{{ old('fecha_nacimiento') }}"
                                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>

                                <div>
    <label for="carrera" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
        Carrera *
    </label>

    <div class="flex gap-2 items-center">
        <select id="carrera_select" name="carrera"
                required
                class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-teal-500">
            <option value="">Seleccionar carrera...</option>

            @foreach($carreras as $c)
                <option value="{{ $c }}" @selected(old('carrera')===$c)>{{ $c }}</option>
            @endforeach

            <option value="__otra__" @selected(old('carrera')==='__otra__')>Otra...</option>
        </select>

        <!-- campo opcional para escribir otra carrera (oculto por defecto) -->
    </div>

    <div id="carrera_otra_wrap" class="mt-2" style="display: none;">
        <label for="carrera_otra" class="sr-only">Especificar carrera</label>
        <input type="text" id="carrera_otra" name="carrera_otra"
               value="{{ old('carrera_otra') }}"
               placeholder="Especifica la carrera"
               class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500">
        <p class="text-xs text-gray-500 mt-1">Si seleccionas "Otra...", escribe la carrera aquí.</p>
    </div>

    @error('carrera')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<!-- Al final del form, antes de enviar, añadimos un pequeño script para controlar la visibilidad -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sel = document.getElementById('carrera_select');
    const otraWrap = document.getElementById('carrera_otra_wrap');
    const otraInput = document.getElementById('carrera_otra');

    function toggleOtra() {
        if (!sel) return;
        if (sel.value === '__otra__') {
            otraWrap.style.display = 'block';
            // si el usuario opta por "otra", usamos su texto como valor real en el select antes de submit
            otraInput.required = true;
        } else {
            otraWrap.style.display = 'none';
            otraInput.required = false;
        }
    }

    if (sel) {
        sel.addEventListener('change', toggleOtra);
        // inicial_
        toggleOtra();
    }

    // Antes del submit: si seleccionó "otra", movemos el valor textual al campo oculto final del formulario.
    document.querySelector('form').addEventListener('submit', function (e) {
        if (sel.value === '__otra__') {
            // reemplazamos el valor de select por el valor escrito
            if (otraInput.value.trim() === '') {
                // deja que la validación del navegador/mensaje Laravel maneje el error
                return;
            }
            // crear un input hidden con el valor real (para que el controlador reciba 'carrera')
            let hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'carrera';
            hidden.value = otraInput.value.trim();
            this.appendChild(hidden);

            // evitar enviar el select con __otra__ (opcional)
            sel.disabled = true;
        }
    });
});
</script>
@endpush

                                <div>
                                    <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Teléfono
                                    </label>
                                    <input type="tel" id="telefono" name="telefono"
                                           value="{{ old('telefono') }}"
                                           placeholder="477-123-4567"
                                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>

                                <div>
                                    <label for="celular" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Celular
                                    </label>
                                    <input type="tel" id="celular" name="celular"
                                           value="{{ old('celular') }}"
                                           placeholder="477-123-4567"
                                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Dirección
                                    </label>
                                    <input type="text" id="direccion" name="direccion"
                                           value="{{ old('direccion') }}"
                                           placeholder="Calle, Número, Colonia, Ciudad"
                                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>
                            </div>
                        </div>

                        <!-- Información Académica -->
                        <div>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-neutral-100 mb-4">Información Académica</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="fk_grupo" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Grupo *
                                    </label>
                                    <select id="fk_grupo" name="fk_grupo" required
                                            class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                        <option value="">Seleccionar grupo...</option>
                                        @foreach($grupos as $g)
                                            <option value="{{ $g->pk_grupo }}"
                                                @selected((int)($gid ?? 0) === (int)$g->pk_grupo)>
                                                {{ $g->nombre_grupo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="estatus" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Estatus *
                                    </label>
                                    <select id="estatus" name="estatus" required
                                            class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                        <option value="Activo" @selected(old('estatus','Activo')==='Activo')>Activo</option>
                                        <option value="Baja"   @selected(old('estatus')==='Baja')>Baja</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Información Familiar (opcional) -->
                        <div>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-neutral-100 mb-4">Información Familiar</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="nombre_padre" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Nombre del Padre
                                    </label>
                                    <input type="text" id="nombre_padre" name="nombre_padre" value="{{ old('nombre_padre') }}"
                                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>

                                <div>
                                    <label for="padre_edad_profesion" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Edad y Profesión del Padre
                                    </label>
                                    <input type="text" id="padre_edad_profesion" name="padre_edad_profesion" value="{{ old('padre_edad_profesion') }}"
                                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>

                                <div>
                                    <label for="nombre_madre" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Nombre de la Madre
                                    </label>
                                    <input type="text" id="nombre_madre" name="nombre_madre" value="{{ old('nombre_madre') }}"
                                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>

                                <div>
                                    <label for="madre_edad_profesion" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Edad y Profesión de la Madre
                                    </label>
                                    <input type="text" id="madre_edad_profesion" name="madre_edad_profesion" value="{{ old('madre_edad_profesion') }}"
                                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="hermanos_info" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                        Información de Hermanos (Edad y Ocupación)
                                    </label>
                                    <textarea id="hermanos_info" name="hermanos_info" rows="2"
                                              class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">{{ old('hermanos_info') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Situación Personal (checkboxes) -->
                        <div>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-neutral-100 mb-4">Situación Personal</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <label class="flex items-center">
                                    <input type="checkbox" id="tiene_hijos" name="tiene_hijos" value="1"
                                           @checked(old('tiene_hijos')) class="w-4 h-4 text-teal-600 bg-white dark:bg-neutral-800 border-gray-300 dark:border-neutral-600 rounded focus:ring-teal-500 focus:ring-2">
                                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-neutral-300">Tiene Hijos</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="checkbox" id="trabaja" name="trabaja" value="1"
                                           @checked(old('trabaja')) class="w-4 h-4 text-teal-600 bg-white dark:bg-neutral-800 border-gray-300 dark:border-neutral-600 rounded focus:ring-teal-500 focus:ring-2">
                                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-neutral-300">Trabaja</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="checkbox" id="recibe_apoyo_familiar" name="recibe_apoyo_familiar" value="1"
                                           @checked(old('recibe_apoyo_familiar')) class="w-4 h-4 text-teal-600 bg-white dark:bg-neutral-800 border-gray-300 dark:border-neutral-600 rounded focus:ring-teal-500 focus:ring-2">
                                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-neutral-300">Recibe Apoyo Familiar</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="checkbox" id="tiene_beca" name="tiene_beca" value="1"
                                           @checked(old('tiene_beca')) class="w-4 h-4 text-teal-600 bg-white dark:bg-neutral-800 border-gray-300 dark:border-neutral-600 rounded focus:ring-teal-500 focus:ring-2">
                                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-neutral-300">Tiene Beca</span>
                                </label>
                            </div>

                            <div class="mt-4">
                                <label for="tipo_beca" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Tipo de Beca (si aplica)
                                </label>
                                <input type="text" id="tipo_beca" name="tipo_beca" value="{{ old('tipo_beca') }}"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-800 text-gray-900 dark:text-neutral-100 placeholder-gray-400 dark:placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors">
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                            <a href="{{ $backUrl }}"
                               class="flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-colors">
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-[#2B8A7F] border border-transparent rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors">
                                Guardar Alumno
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-layouts.app>
