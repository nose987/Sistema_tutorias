<x-layouts.app>
    <div class="p-8">

        {{-- CABECERA (Tu código original, está perfecto) --}}
        <div class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Estadías y Empresas</h1>
                <p class="text-gray-600 dark:text-gray-400">Gestiona empresas y opciones de estadía de alumnos</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('estadias.reporte.final') }}" class="flex items-center gap-2 px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-medium transition cursor-pointer shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Ver Reportes Finales
                </a>
                <a href="{{ route('estadias.reporte') }}" class="flex items-center gap-2 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Estadísticas
                </a>
                <a href="{{ route('empresas.create') }}" class="flex items-center gap-2 px-4 py-2 border border-teal-600 text-teal-600 dark:text-teal-400 rounded-lg hover:bg-teal-50 dark:hover:bg-zinc-800 font-medium transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nueva Empresa
                </a>
            </div>
        </div>

        {{-- TABS (Tu código original, está perfecto) --}}
        <div class="flex gap-8 mb-6 border-b border-gray-200 dark:border-gray-700">
            <button onclick="mostrarSeccion('alumnos')" class="pb-3 font-bold text-gray-900 dark:text-white border-b-2 border-gray-900 dark:border-white tab-btn cursor-pointer" data-tab="alumnos">Alumnos y Opciones</button>
            <button onclick="mostrarSeccion('empresas')" class="pb-3 font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white tab-btn cursor-pointer" data-tab="empresas">Empresas</button>
        </div>

        {{-- INICIO: SECCIÓN DE ALUMNOS --}}
        <div id="seccion-alumnos" class="bg-white dark:bg-zinc-900 border border-gray-200 dark:border-gray-700 rounded-xl p-6" x-data="manageEstadiasModal()">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Opciones de Estadía por Alumno</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Gestiona opciones y estatus de empresa por alumno</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Alumno</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">ID</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Opción 1 (Empresa y Estatus)</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Opción 2 (Empresa y Estatus)</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Opción 3 (Empresa y Estatus)</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alumnos as $alumno)
                            
                            {{-- ============================================= --}}
                            {{--   INICIO: LÓGICA PHP CORREGIDA Y MEJORADA   --}}
                            {{-- ============================================= --}}
                            @php
                                $opciones = [
                                    $alumno->opcionesEstadia->firstWhere('opcion_numero', 1),
                                    $alumno->opcionesEstadia->firstWhere('opcion_numero', 2),
                                    $alumno->opcionesEstadia->firstWhere('opcion_numero', 3)
                                ];
                                
                                // 1. Encontrar la opción aceptada (respetando prioridad)
                                $opcionAceptada = null;
                                if ($opciones[0] && $opciones[0]->estatus == 'Aceptado') $opcionAceptada = $opciones[0];
                                elseif ($opciones[1] && $opciones[1]->estatus == 'Aceptado') $opcionAceptada = $opciones[1];
                                elseif ($opciones[2] && $opciones[2]->estatus == 'Aceptado') $opcionAceptada = $opciones[2];

                                $empresaFinal = $opcionAceptada?->empresa?->nombre ?? 'Ninguna';

                                // 2. Revisar si todavía hay opciones "pendientes" (que no sean la aceptada)
                                $hayOpcionesPendientes = false;
                                if ($opciones[0] && $opciones[0] != $opcionAceptada && in_array($opciones[0]->estatus, ['Pendiente', 'Contactado', 'No Contactado'])) $hayOpcionesPendientes = true;
                                if ($opciones[1] && $opciones[1] != $opcionAceptada && in_array($opciones[1]->estatus, ['Pendiente', 'Contactado', 'No Contactado'])) $hayOpcionesPendientes = true;
                                if ($opciones[2] && $opciones[2] != $opcionAceptada && in_array($opciones[2]->estatus, ['Pendiente', 'Contactado', 'No Contactado'])) $hayOpcionesPendientes = true;
                                
                                // 3. Decidir si mostrar el botón de confirmar (solo si hay 1 aceptada Y otras pendientes)
                                $mostrarBotonConfirmar = $opcionAceptada && $hayOpcionesPendientes;
                                
                                // 4. Decidir si mostrar que ya está confirmado (1 aceptada y 0 pendientes)
                                $yaEstaConfirmado = $opcionAceptada && !$hayOpcionesPendientes;
                            @endphp
                            {{-- ============================================= --}}
                            {{--     FIN: LÓGICA PHP CORREGIDA Y MEJORADA      --}}
                            {{-- ============================================= --}}


                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                <td class="py-4 px-4 text-gray-900 dark:text-white">{{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</td>
                                <td class="py-4 px-4 text-gray-900 dark:text-white">{{ $alumno->pk_alumno }}</td>

                                {{-- Opciones (Tu código original, está perfecto) --}}
                                @foreach ($opciones as $opcion)
                                    <td class="py-4 px-4">
                                        <div class="mb-2 text-sm text-gray-900 dark:text-white font-medium">{{ $opcion?->empresa?->nombre ?? 'Sin Asignar' }}</div>
                                        
                                        @if ($opcion)
                                            <div x-data="manageOpcionStatus({{ $opcion->pk_opcion_estadia }}, '{{ $opcion->estatus }}')">
                                                <select 
                                                    x-model="currentStatus" 
                                                    @change="updateStatus" 
                                                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm text-xs py-1 focus:border-teal-500 focus:ring-teal-500 cursor-pointer"
                                                    :class="{
                                                        'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-200': currentStatus == 'Pendiente',
                                                        'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200': currentStatus == 'Contactado',
                                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200': currentStatus == 'No Contactado',
                                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': currentStatus == 'Aceptado',
                                                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200': currentStatus == 'Rechazado'
                                                    }"
                                                >
                                                    <option value="Pendiente">Pendiente</option>
                                                    <option value="Contactado">Contactado</option>
                                                    <option value="No Contactado">No Contactado</option>
                                                    <option value="Aceptado">Aceptado</option>
                                                    <option value="Rechazado">Rechazado</option>
                                                </select>
                                            </div>
                                        @else
                                            <span class="inline-block bg-gray-300 dark:bg-gray-600 text-gray-900 dark:text-gray-200 text-xs px-3 py-1 rounded-full font-medium">N/A</span>
                                        @endif
                                    </td>
                                @endforeach
                                
                                {{-- ============================================= --}}
                                {{--   INICIO: CELDA DE ACCIONES CORREGIDA       --}}
                                {{-- ============================================= --}}
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-4">
                                        {{-- 1. Botón Editar (el que ya tenías) --}}
                                        <button @click.prevent="openModal({{ Js::from($alumno) }})" class="text-gray-600 dark:text-gray-400 hover:text-teal-600 dark:hover:text-teal-400 transition cursor-pointer" title="Editar Opciones">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>

                                        {{-- 2. BOTÓN CONFIRMAR (Se muestra si hay 1 Aceptado y 1+ Pendientes) --}}
                                        @if ($mostrarBotonConfirmar)
                                            <button 
                                                {{-- Llama a la nueva función JS de abajo --}}
                                                onclick="confirmarEstadia({{ $alumno->pk_alumno }}, '{{ addslashes($alumno->nombre) }}', '{{ addslashes($empresaFinal) }}')"
                                                class="transition text-green-600 hover:text-green-800 dark:text-green-500 dark:hover:text-green-400 cursor-pointer"
                                                title="Confirmar y Finalizar Estadía (Rechaza las demás opciones)"
                                            >
                                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </button>
                                        
                                        {{-- 3. ICONO FINALIZADO (Se muestra si hay 1 Aceptado y 0 Pendientes) --}}
                                        @elseif ($yaEstaConfirmado)
                                            <span class="text-green-500" title="Estadía Finalizada (listo para reporte)">
                                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                {{-- ============================================= --}}
                                {{--     FIN: CELDA DE ACCIONES CORREGIDA        --}}
                                {{-- ============================================= --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 px-4 text-center text-gray-600 dark:text-gray-400">No hay alumnos registrados todavía.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- MODAL ALUMNOS (Tu código original, está perfecto) --}}
            <div 
                x-show="showModal" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
                style="display: none;"
                @click.self="showModal = false"
            >
                <div 
                    x-show="showModal"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="w-full max-w-lg bg-white dark:bg-zinc-900 rounded-xl shadow-xl overflow-hidden"
                    @click.stop
                >
                    <form @submit.prevent="saveOpciones()">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Editar Opciones de Estadía</h3>
                            <p class="text-gray-600 dark:text-gray-400" x-text="selectedStudent ? selectedStudent.nombre + ' ' + selectedStudent.apellido_paterno : 'Cargando...'"></p>
                        </div>

                        <div class="p-6 space-y-4">
                            @foreach ([1, 2, 3] as $num)
                                <div>
                                    <label for="opcion_{{ $num }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Opción {{ $num }}</label>
                                    <select id="opcion_{{ $num }}" name="opcion_{{ $num }}_id" x-model="formData.opcion_{{ $num }}_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500 cursor-pointer">
                                        <option value="">-- Sin Asignar --</option>
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->pk_empresa }}">{{ $empresa->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>

                        <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-800 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                            <button type="button" @click.prevent="showModal = false" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium transition cursor-pointer">Cancelar</button>
                            <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-medium transition cursor-pointer">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- SECCIÓN DE EMPRESAS (Tu código original, lo incluyo completo por si acaso) --}}
        <div id="seccion-empresas" class="hidden bg-white dark:bg-zinc-900 border border-gray-200 dark:border-gray-700 rounded-xl p-6" x-data="manageEmpresasModal()">
             <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Empresas Registradas</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Catálogo de empresas para estadías</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Empresa</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Contacto</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Teléfono</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Correo</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($empresas as $empresa)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition" data-empresa-id="{{ $empresa->pk_empresa }}">
                                <td class="py-4 px-4 text-gray-900 dark:text-white" data-field="nombre">{{ $empresa->nombre }}</td>
                                <td class="py-4 px-4 text-gray-900 dark:text-white" data-field="contacto">{{ $empresa->nombre_contacto ?? 'N/A' }}</td>
                                <td class="py-4 px-4 text-gray-900 dark:text-white" data-field="telefono">{{ $empresa->tel ?? 'N/A' }}</td>
                                <td class="py-4 px-4 text-gray-900 dark:text-white" data-field="correo">{{ $empresa->correo ?? 'N/A' }}</td>
                                <td class="py-4 px-4">
                                    <div class="flex gap-3">
                                        <button @click.prevent="openModal({{ Js::from($empresa) }})" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition cursor-pointer" title="Editar Empresa">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button @click.prevent="confirmDelete({{ $empresa->pk_empresa }}, '{{ addslashes($empresa->nombre) }}')" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition cursor-pointer" title="Eliminar Empresa">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 px-4 text-center text-gray-600 dark:text-gray-400">No hay empresas registradas todavía.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" style="display: none;" @click.self="showModal = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div x-show="showModal" class="w-full max-w-lg bg-white dark:bg-zinc-900 rounded-xl shadow-xl overflow-hidden" @click.stop x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                    <form @submit.prevent="saveEmpresa()">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Editar Empresa</h3>
                            <p class="text-gray-600 dark:text-gray-400" x-text="selectedEmpresa ? selectedEmpresa.nombre : 'Cargando...'"></p>
                        </div>
                        <div class="p-6 space-y-4">
                            <div><label for="nombre_empresa" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre de la Empresa</label><input type="text" id="nombre_empresa" x-model="formData.nombre" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" maxlength="50" required ></div>
                            <div><label for="nombre_contacto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre de Contacto</label><input type="text" id="nombre_contacto" x-model="formData.nombre_contacto" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" maxlength="50"></div>
                            <div><label for="tel_empresa" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Teléfono</label><input type="text" id="tel_empresa" x-model="formData.tel" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" maxlength="10" pattern="[0-9]{10}"></div>
                            <div><label for="correo_empresa" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Correo Electrónico</label><input type="email" id="correo_empresa" x-model="formData.correo" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" maxlength="50"></div>
                        </div>
                        <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-800 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                            <button type="button" @click.prevent="showModal = false" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium transition cursor-pointer">Cancelar</button>
                            <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-medium transition cursor-pointer">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================= --}}
    {{--           INICIO: SCRIPT CORREGIDO          --}}
    {{-- ============================================= --}}
    <script>
        // --- FUNCIÓN 1: apiRequest (Tu código original) ---
        async function apiRequest(url, method, body = {}) {
            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            if (!tokenMeta) throw new Error('Token CSRF no disponible.');
            const token = tokenMeta.content;
            const isGet = method.toUpperCase() === 'GET';
            const response = await fetch(url, {
                method: isGet ? 'GET' : 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
                ...(isGet ? {} : { body: JSON.stringify({ ...body, _token: token, _method: method.toUpperCase() }) })
            });
            const result = await response.json();
            if (!response.ok) {
                let errorMessage = result.message || 'Error en el servidor.';
                if (result.errors) {
                    errorMessage += '\n\n' + Object.values(result.errors).map(e => e.join(', ')).join('; ');
                }
                throw new Error(errorMessage);
            }
            return result;
        }

        // --- FUNCIÓN 2: manageOpcionStatus (Tu código original) ---
        function manageOpcionStatus(opcionId, initialStatus) {
            return {
                currentStatus: initialStatus,
                opcionId: opcionId,
                async updateStatus() {
                    try {
                        await apiRequest(`/opciones-estadia/${this.opcionId}/status`, 'PATCH', { estatus: this.currentStatus });
                        const Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 2000, timerProgressBar: true });
                        Toast.fire({ icon: 'success', title: 'Estatus actualizado' });
                         // Recargamos para que el botón de confirmar se actualice
                        if (this.currentStatus === 'Aceptado' || initialStatus === 'Aceptado') {
                             setTimeout(() => window.location.reload(), 1000);
                        }
                    } catch (error) {
                        Swal.fire({ title: 'Error', text: error.message, icon: 'error' });
                        this.currentStatus = initialStatus; // Revertir si falló
                    }
                }
            }
        }

        // --- FUNCIÓN 3: manageEstadiasModal (Tu código original) ---
        function manageEstadiasModal() {
            return {
                showModal: false, selectedStudent: null, formUrl: '', formData: { opcion_1_id: null, opcion_2_id: null, opcion_3_id: null },
                openModal(student) {
                    this.selectedStudent = student; this.formUrl = `/alumnos/${student.pk_alumno}/opciones`;
                    const ops = student.opciones_estadia || [];
                    this.formData.opcion_1_id = ops.find(op => op.opcion_numero == 1)?.fk_empresa || "";
                    this.formData.opcion_2_id = ops.find(op => op.opcion_numero == 2)?.fk_empresa || "";
                    this.formData.opcion_3_id = ops.find(op => op.opcion_numero == 3)?.fk_empresa || "";
                    this.showModal = true;
                },
                async saveOpciones() {
                    try {
                        // CORRECCIÓN MENOR: Añadí 'this.formData' que faltaba en tu código
                        const cleanFormData = {
                            opcion_1_id: this.formData.opcion_1_id || null,
                            opcion_2_id: this.formData.opcion_2_id || null,
                            opcion_3_id: this.formData.opcion_3_id || null,
                        };
                        await apiRequest(this.formUrl, 'PUT', cleanFormData);
                        this.showModal = false;
                        Swal.fire({ icon: 'success', title: '¡Actualizado!', text: 'Opciones guardadas.', confirmButtonColor: '#0d9488' }).then(() => window.location.reload());
                    } catch (error) { Swal.fire({ icon: 'error', title: 'Error', text: error.message }); }
                }
            }
        }

        // --- FUNCIÓN 4: manageEmpresasModal (Tu código original) ---
        function manageEmpresasModal() {
             return {
                showModal: false, selectedEmpresa: null, formUrl: '', formData: { nombre: '', nombre_contacto: '', tel: '', correo: '' },
                openModal(empresa) {
                    this.selectedEmpresa = empresa; this.formUrl = `/empresas/${empresa.pk_empresa}`;
                    this.formData = { nombre: empresa.nombre || "", nombre_contacto: empresa.nombre_contacto || "", tel: empresa.tel || "", correo: empresa.correo || "" };
                    this.showModal = true;
                },
                async saveEmpresa() { 
                    try { 
                        const result = await apiRequest(this.formUrl, 'PUT', this.formData); 
                        this.showModal = false; 
                        // En lugar de recargar, actualizamos la fila (tu código original lo tenía)
                        this.updateEmpresaRow(this.selectedEmpresa.pk_empresa, this.formData);
                        Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Empresa actualizada', showConfirmButton: false, timer: 3000, timerProgressBar: true });
                    } catch (e) { 
                        Swal.fire('Error', e.message, 'error'); 
                    } 
                },
                async confirmDelete(id, name) {
                    const result = await Swal.fire({
                        title: '¿Estás seguro?', html: `¿Deseas eliminar <strong>${name}</strong>?`, icon: 'warning',
                        showCancelButton: true, confirmButtonColor: '#dc2626', cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Sí, eliminar', cancelButtonText: 'Cancelar'
                    });
                    if (result.isConfirmed) {
                        try {
                            await apiRequest(`/empresas/${id}`, 'DELETE', {});
                            this.removeEmpresaRow(id);
                            Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Empresa eliminada', showConfirmButton: false, timer: 3000, timerProgressBar: true });
                        } catch (e) {
                            Swal.fire('Error', e.message, 'error');
                        }
                    }
                },
                updateEmpresaRow(id, data) {
                    const row = document.querySelector(`tr[data-empresa-id="${id}"]`);
                    if (row) {
                        row.querySelector('[data-field="nombre"]').textContent = data.nombre;
                        row.querySelector('[data-field="contacto"]').textContent = data.nombre_contacto || 'N/A';
                        row.querySelector('[data-field="telefono"]').textContent = data.tel || 'N/A';
                        row.querySelector('[data-field="correo"]').textContent = data.correo || 'N/A';
                    }
                },
                removeEmpresaRow(id) {
                    const row = document.querySelector(`tr[data-empresa-id="${id}"]`);
                    if (row) row.remove();
                }
             }
        }

        // --- FUNCIÓN 5: mostrarSeccion (Tu código original) ---
        function mostrarSeccion(seccion) {
            document.getElementById('seccion-alumnos').classList.add('hidden');
            document.getElementById('seccion-empresas').classList.add('hidden');
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-b-2', 'border-gray-900', 'dark:border-white', 'font-bold', 'text-gray-900', 'dark:text-white');
                btn.classList.add('font-medium', 'text-gray-600', 'dark:text-gray-400', 'hover:text-gray-900', 'dark:hover:text-white');
            });

            if (seccion === 'alumnos') {
                document.getElementById('seccion-alumnos').classList.remove('hidden');
                const btn = document.querySelector('[data-tab="alumnos"]'); 
                btn.classList.add('border-b-2', 'border-gray-900', 'dark:border-white', 'font-bold', 'text-gray-900', 'dark:text-white'); 
                btn.classList.remove('font-medium', 'text-gray-600', 'dark:text-gray-400', 'hover:text-gray-900', 'dark:hover:text-white');
            } else {
                document.getElementById('seccion-empresas').classList.remove('hidden');
                const btn = document.querySelector('[data-tab="empresas"]'); 
                btn.classList.add('border-b-2', 'border-gray-900', 'dark:border-white', 'font-bold', 'text-gray-900', 'dark:text-white'); 
                btn.classList.remove('font-medium', 'text-gray-600', 'dark:text-gray-400', 'hover:text-gray-900', 'dark:hover:text-white');
            }
        }

        // --- ================================================== ---
        // ---   FUNCIÓN 6: confirmarEstadia (¡LA CORREGIDA!)   ---
        // --- ================================================== ---
        async function confirmarEstadia(alumnoId, nombreAlumno, nombreEmpresa) {
            
            // 1. Primero preguntamos
            const result = await Swal.fire({
                title: '¿Confirmar Alumno?',
                html: `¿Deseas finalizar a <strong>${nombreAlumno}</strong>?<br><br>Se rechazarán todas las otras opciones y se agregará al reporte final.<br><br>Empresa: <strong class="text-teal-600">${nombreEmpresa}</strong>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d9488',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, finalizar',
                cancelButtonText: 'Cancelar'
            });

            // 2. Si el usuario confirma, llamamos a la API
            if (result.isConfirmed) {
                try {
                    // ¡AQUÍ ESTÁ LA LLAMADA A LA RUTA QUE FINALIZA AL ALUMNO!
                    const url = `/alumnos/${alumnoId}/confirmar-final`;
                    const postResult = await apiRequest(url, 'PATCH', {}); // Usa tu función apiRequest
                    
                    // 3. Mostramos éxito y recargamos la página
                    await Swal.fire({
                        icon: 'success',
                        title: '¡Alumno Finalizado!',
                        text: postResult.message || 'El alumno ha sido confirmado y aparecerá en el reporte final.',
                        confirmButtonColor: '#0d9488'
                    });
                    
                    window.location.reload(); // Recarga para que aparezca el check verde
                    
                } catch (error) {
                    Swal.fire('Error', error.message || 'No se pudo finalizar al alumno.', 'error');
                }
            }
            // Si hacen clic en "Cancelar", no pasa nada.
        }


        // --- LÓGICA DE INICIO (Tu código original) ---
        document.addEventListener('DOMContentLoaded', () => mostrarSeccion('alumnos'));

        @if (session('success'))
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#0d9488'
                });
            }
        @endif
    </script>
</x-layouts.app>