@extends('layouts.app')

@section('title', 'Estadías y Empresas')

@section('content')
<div class="p-8">
    {{-- HEADER Y BOTONES --}}
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Estadías y Empresas</h1>
            <p class="text-gray-600">Gestiona empresas y opciones de estadía de alumnos</p>
        </div>
        <div class="flex gap-3">
            {{-- Botón Ver Reporte --}}
            <a href="{{ route('estadias.reporte') }}" class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Ver Reporte
            </a>
            {{-- Botón Nueva Empresa --}}
            <a href="{{ route('empresas.create') }}" class="flex items-center gap-2 px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nueva Empresa
            </a>
        </div>
    </div>


    {{-- BOTONES DE TABS --}}
    <div class="flex gap-8 mb-6 border-b border-gray-200">
        <button onclick="mostrarSeccion('alumnos')" class="pb-3 font-bold text-gray-900 border-b-2 border-gray-900 tab-btn" data-tab="alumnos">Alumnos y Opciones</button>
        <button onclick="mostrarSeccion('empresas')" class="pb-3 font-medium text-gray-600 hover:text-gray-900 tab-btn" data-tab="empresas">Empresas</button>
    </div>

    {{-- ========================================================== --}}
    {{-- INICIO: SECCIÓN DE ALUMNOS (REFACTORIZADO) --}}
    {{-- ========================================================== --}}
    <div id="seccion-alumnos" class="bg-white border border-gray-200 rounded-xl p-6" x-data="manageEstadiasModal()">
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-900 mb-1">Opciones de Estadía por Alumno</h3>
            <p class="text-gray-600 text-sm">Gestiona opciones y estatus de empresa por alumno</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-900">Alumno</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900">Matricula</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900">Opción 1 (Empresa y Estatus)</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900">Opción 2 (Empresa y Estatus)</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900">Opción 3 (Empresa y Estatus)</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($alumnos as $alumno)
                        
                        {{-- Definimos las opciones en un array para poder iterarlas --}}
                        @php
                            $opciones = [
                                $alumno->opcionesEstadia->firstWhere('opcion_numero', 1),
                                $alumno->opcionesEstadia->firstWhere('opcion_numero', 2),
                                $alumno->opcionesEstadia->firstWhere('opcion_numero', 3)
                            ];
                        @endphp

                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-4 text-gray-900">{{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</td>
                            <td class="py-4 px-4 text-gray-900">{{ $alumno->pk_alumno }}</td>

                            {{-- ========================================================== --}}
                            {{-- INICIO: CELDAS DE OPCIÓN (REFACTORIZADO) --}}
                            {{-- ========================================================== --}}
                            {{-- Iteramos el array $opciones para no repetir el HTML --}}
                            @foreach ($opciones as $opcion)
                                <td class="py-4 px-4">
                                    <div class="mb-2 text-sm text-gray-900 font-medium">{{ $opcion?->empresa?->nombre ?? 'Sin Asignar' }}</div>
                                    
                                    @if ($opcion)
                                        <div x-data="manageOpcionStatus({{ $opcion->pk_opcion_estadia }}, '{{ $opcion->estatus }}')">
                                            <select 
                                                x-model="currentStatus" 
                                                @change="updateStatus" 
                                                class="w-full border-gray-300 rounded-lg shadow-sm text-xs py-1 focus:border-teal-500 focus:ring-teal-500"
                                                :class="{
                                                    'bg-gray-100 text-gray-800': currentStatus == 'Pendiente',
                                                    'bg-blue-100 text-blue-800': currentStatus == 'Contactado',
                                                    'bg-yellow-100 text-yellow-800': currentStatus == 'No Contactado',
                                                    'bg-green-100 text-green-800': currentStatus == 'Aceptado',
                                                    'bg-red-100 text-red-800': currentStatus == 'Rechazado'
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
                                        <span class="inline-block bg-gray-300 text-gray-900 text-xs px-3 py-1 rounded-full font-medium">N/A</span>
                                    @endif
                                </td>
                            @endforeach
                            {{-- FIN: CELDAS DE OPCIÓN --}}
                            
                            <td class="py-9 px-9">
                                <div class="flex gap-3">
                                    
                                    {{-- Botón Editar (abre el modal) --}}
                                    <button @click.prevent="openModal({{ Js::from($alumno) }})" class="text-gray-600 hover:text-gray-900" title="Asignar Empresas">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-gray-600">No hay alumnos registrados todavía.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- MODAL DE ASIGNACIÓN DE EMPRESAS (REFACTORIZADO INTERNAMENTE) --}}
        <div 
            x-show="showModal" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4"
            style="display: none;"
        >
            <div 
                @click.outside="showModal = false"
                x-show="showModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-lg bg-white rounded-xl shadow-xl overflow-hidden"
            >
                <form @submit.prevent="saveOpciones()">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900">Editar Opciones de Estadía</h3>
                        <p class="text-gray-600" x-text="selectedStudent ? selectedStudent.nombre + ' ' + selectedStudent.apellido_paterno : 'Cargando...'"></p>
                    </div>

                    <div class="p-6 space-y-4">
                        {{-- ========================================================== --}}
                        {{-- INICIO: SELECTS DEL MODAL (REFACTORIZADO) --}}
                        {{-- ========================================================== --}}
                        {{-- Usamos un bucle para los 3 selects --}}
                        @foreach ([1, 2, 3] as $num)
                            <div>
                                <label for="opcion_{{ $num }}" class="block text-sm font-medium text-gray-700 mb-1">Opción {{ $num }}</label>
                                <select id="opcion_{{ $num }}" name="opcion_{{ $num }}_id" x-model="formData.opcion_{{ $num }}_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    <option value="">-- Sin Asignar --</option>
                                    {{-- El bucle de empresas solo se escribe una vez --}}
                                    @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->pk_empresa }}">{{ $empresa->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                        {{-- FIN: SELECTS DEL MODAL --}}
                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                        <button 
                            type="button" 
                            @click.prevent="showModal = false"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 font-medium"
                        >
                            Cancelar
                        </button>
                        <button 
                            type="submit"
                            class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-medium"
                        >
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
    {{-- FIN: SECCIÓN DE ALUMNOS --}}


    {{-- SECCIÓN DE EMPRESAS (Sin cambios estructurales) --}}
    <div id="seccion-empresas" class="hidden bg-white border border-gray-200 rounded-xl p-6" x-data="manageEmpresasModal()">
        
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-900 mb-1">Empresas Registradas</h3>
            <p class="text-gray-600 text-sm">Catálogo de empresas para estadías</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-900">Empresa</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900">Contacto</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900">Teléfono</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900">Correo</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empresas as $empresa)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-4 text-gray-900">{{ $empresa->nombre }}</td>
                            <td class="py-4 px-4 text-gray-900">{{ $empresa->nombre_contacto ?? 'N/A' }}</td>
                            <td class="py-4 px-4 text-gray-900">{{ $empresa->tel ?? 'N/A' }}</td>
                            <td class="py-4 px-4 text-gray-900">{{ $empresa->correo ?? 'N/A' }}</td>
                            <td class="py-4 px-4">
                                <div class="flex gap-3">
                                    {{-- Botón Editar Empresa --}}
                                    <button @click.prevent="openModal({{ Js::from($empresa) }})" class="text-gray-600 hover:text-gray-900" title="Editar Empresa">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    {{-- Botón Eliminar Empresa --}}
                                    <button @click.prevent="confirmDelete({{ $empresa->pk_empresa }}, '{{ $empresa->nombre }}')" class="text-red-600 hover:text-red-800" title="Eliminar Empresa">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-4 text-center text-gray-600">No hay empresas registradas todavía.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- MODAL DE EDICIÓN DE EMPRESA --}}
        <div 
            x-show="showModal" 
            x-transition...
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4"
            style="display: none;"
        >
            <div 
                @click.outside="showModal = false"
                x-show="showModal"
                x-transition...
                class="w-full max-w-lg bg-white rounded-xl shadow-xl overflow-hidden"
            >
                <form @submit.prevent="saveEmpresa()">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900">Editar Empresa</h3>
                        <p class="text-gray-600" x-text="selectedEmpresa ? selectedEmpresa.nombre : 'Cargando...'"></p>
                    </div>

                    <div class="p-6 space-y-4">
                        <div>
                            <label for="nombre_empresa" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la Empresa</label>
                            <input type="text" id="nombre_empresa" x-model="formData.nombre" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" required>
                        </div>
                        <div>
                            <label for="nombre_contacto" class="block text-sm font-medium text-gray-700 mb-1">Nombre de Contacto</label>
                            <input type="text" id="nombre_contacto" x-model="formData.nombre_contacto" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div>
                            <label for="tel_empresa" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                            <input type="text" id="tel_empresa" x-model="formData.tel" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div>
                            <label for="correo_empresa" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                            <input type="email" id="correo_empresa" x-model="formData.correo" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                        <button type="button" @click.prevent="showModal = false" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 font-medium">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-medium">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- FIN: SECCIÓN DE EMPRESAS --}}
</div>
@endsection


{{-- =================================================================== --}}
{{-- =================================================================== --}}
{{-- SCRIPT: LÓGICA DE JS REFACTORIZADA --}}
{{-- =================================================================== --}}
{{-- =================================================================== --}}
@push('scripts')
<script>
    /**
     * =================================================================
     * FUNCIÓN AUXILIAR DE API (NUEVA)
     * =================================================================
     * Manejador genérico de peticiones API. Centraliza el CSRF,
     * el 'method spoofing' (usar POST para PUT/PATCH/DELETE) y el
     * manejo de errores de validación.
     * * Lanza un error si la petición falla, que debe ser capturado (catch).
     *
     * @param {string} url - La URL del endpoint
     * @param {string} method - 'PUT', 'PATCH', 'DELETE', 'POST', 'GET'
     * @param {object} body - El cuerpo de la petición (sin _token o _method)
     * @returns {Promise<object>} - El resultado JSON
     */
    async function apiRequest(url, method, body = {}) {
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const isGet = method.toUpperCase() === 'GET';
        // Usamos 'POST' para simular PUT/PATCH/DELETE, como es estándar en Laravel
        const fetchMethod = isGet ? 'GET' : 'POST'; 
        
        const data = isGet ? {} : {
            ...body,
            _token: token,
            _method: method.toUpperCase() // 'PUT', 'PATCH', 'DELETE'
        };

        const response = await fetch(url, {
            method: fetchMethod,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            // No enviar body en GET, en otros casos stringify
            ...(isGet ? {} : { body: JSON.stringify(data) })
        });

        const result = await response.json();

        if (!response.ok) {
            // Si la respuesta no es OK, preparamos un mensaje de error y lo lanzamos
            let errorMessage = result.message || 'Error en el servidor.';
            if (result.errors) {
                // Si hay errores de validación, los adjuntamos
                errorMessage += '\n\n' + Object.values(result.errors).map(e => e.join(', ')).join('; ');
            }
            throw new Error(errorMessage);
        }
        
        return result; // Devuelve el resultado exitoso
    }


    /**
     * ============================================================
     * LÓGICA ALPINE: ACTUALIZAR ESTATUS (DROPDOWN) (REFACTORIZADA)
     * ============================================================
     * Ahora usa la función auxiliar `apiRequest` y maneja su propio try/catch
     */
    function manageOpcionStatus(opcionId, initialStatus) {
        return {
            currentStatus: initialStatus,
            opcionId: opcionId,
            async updateStatus() {
                try {
                    const url = `/opciones-estadia/${this.opcionId}/status`;
                    // Llama a la función auxiliar
                    await apiRequest(url, 'PATCH', { estatus: this.currentStatus });

                    // Éxito: mostramos una alerta "toast" no intrusiva
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Estatus actualizado',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });

                } catch (error) {
                    // El error ya viene formateado desde apiRequest
                    console.error('Error al actualizar estatus:', error);
                    Swal.fire({
                        title: 'Error',
                        text: error.message || 'No se pudo actualizar el estatus.',
                        icon: 'error',
                        confirmButtonText: 'Cerrar'
                    });
                }
            }
        }
    }

    /**
     * ============================================================
     * LÓGICA ALPINE: ASIGNAR EMPRESAS (MODAL) (REFACTORIZADA)
     * ============================================================
     */
    function manageEstadiasModal() {
        return {
            showModal: false,
            selectedStudent: null,
            formUrl: '',
            formData: {
                opcion_1_id: null,
                opcion_2_id: null,
                opcion_3_id: null
            },
            
            openModal(student) {
                this.selectedStudent = student;
                this.formUrl = `/alumnos/${student.pk_alumno}/opciones`; 
                
                const op1 = student.opciones_estadia ? student.opciones_estadia.find(op => op.opcion_numero == 1) : null;
                const op2 = student.opciones_estadia ? student.opciones_estadia.find(op => op.opcion_numero == 2) : null;
                const op3 = student.opciones_estadia ? student.opciones_estadia.find(op => op.opcion_numero == 3) : null;

                // Asignamos el fk_empresa o un string vacío para el <select>
                this.formData.opcion_1_id = op1 ? op1.fk_empresa : "";
                this.formData.opcion_2_id = op2 ? op2.fk_empresa : "";
                this.formData.opcion_3_id = op3 ? op3.fk_empresa : "";

                this.showModal = true;
            },

            async saveOpciones() {
                // Limpiamos los IDs nulos ("") para que sean `null`
                const cleanFormData = {
                    opcion_1_id: this.formData.opcion_1_id || null,
                    opcion_2_id: this.formData.opcion_2_id || null,
                    opcion_3_id: this.formData.opcion_3_id || null,
                };

                try {
                    // Llama a la función auxiliar
                    const result = await apiRequest(this.formUrl, 'PUT', cleanFormData);
                    
                    // Éxito: cerramos modal y mostramos alerta
                    if (result.success) {
                        this.showModal = false;
                        Swal.fire({
                            title: '¡Actualizado!',
                            text: result.message || 'Las opciones de estadía se guardaron correctamente.',
                            icon: 'success',
                            confirmButtonText: 'Entendido',
                            confirmButtonColor: '#0d9488'
                        }).then(() => {
                            window.location.reload(); // Recargamos para ver todos los cambios
                        });
                    }
                } catch (error) {
                    console.error('Error al guardar opciones:', error);
                    Swal.fire({
                        title: 'Error de Guardado',
                        text: error.message || 'Hubo un error de conexión o el servidor falló.',
                        icon: 'error',
                        confirmButtonText: 'Cerrar'
                    });
                }
            }
        }
    }

    /**
     * ============================================================
     * LÓGICA ALPINE: EMPRESAS (MODAL) (REFACTORIZADA)
     * ============================================================
     */
    function manageEmpresasModal() {
        return {
            showModal: false,
            selectedEmpresa: null,
            formUrl: '',
            formData: {
                nombre: '',
                nombre_contacto: '',
                tel: '',
                correo: ''
            },
            
            openModal(empresa) {
                this.selectedEmpresa = empresa;
                this.formUrl = `/empresas/${empresa.pk_empresa}`; 
                this.formData.nombre = empresa.nombre || "";
                this.formData.nombre_contacto = empresa.nombre_contacto || "";
                this.formData.tel = empresa.tel || "";
                this.formData.correo = empresa.correo || "";
                this.showModal = true;
            },

            async saveEmpresa() {
                try {
                    // Llama a la función auxiliar
                    const result = await apiRequest(this.formUrl, 'PUT', this.formData);

                    if (result.success) {
                        this.showModal = false;
                        Swal.fire({
                            title: '¡Actualizado!',
                            text: result.message || 'La empresa se actualizó correctamente.',
                            icon: 'success',
                            confirmButtonText: 'Entendido',
                            confirmButtonColor: '#0d9488'
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                } catch (error) {
                    console.error('Error al guardar empresa:', error);
                    Swal.fire({
                        title: 'Error de Guardado',
                        text: error.message || 'Hubo un error de conexión o el servidor falló.',
                        icon: 'error',
                        confirmButtonText: 'Cerrar'
                    });
                }
            },

            async confirmDelete(empresaId, empresaNombre) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    html: `¿Deseas eliminar la empresa <strong>${empresaNombre}</strong>?<br><small class="text-gray-500">Esta acción no se puede deshacer.</small>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            // Llama a la función auxiliar
                            const deleteResult = await apiRequest(`/empresas/${empresaId}`, 'DELETE', {});

                            if (deleteResult.success) {
                                Swal.fire({
                                    title: '¡Eliminada!',
                                    text: deleteResult.message || 'La empresa ha sido eliminada correctamente.',
                                    icon: 'success',
                                    confirmButtonText: 'Entendido',
                                    confirmButtonColor: '#0d9488'
                                }).then(() => {
                                    window.location.reload();
                                });
                            }
                        } catch (error) {
                            console.error('Error al eliminar empresa:', error);
                            Swal.fire({
                                title: 'Error',
                                text: error.message || 'No se pudo eliminar la empresa.',
                                icon: 'error',
                                confirmButtonText: 'Cerrar'
                            });
                        }
                    }
                });
            }
        }
    }
</script>


{{-- JS para los tabs (Sin cambios) --}}
<script>
    function mostrarSeccion(seccion) {
        document.getElementById('seccion-alumnos').classList.add('hidden');
        document.getElementById('seccion-empresas').classList.add('hidden');
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('border-b-2', 'border-gray-900', 'font-bold', 'text-gray-900');
            btn.classList.add('font-medium', 'text-gray-600', 'hover:text-gray-900');
        });

        if (seccion === 'alumnos') {
            document.getElementById('seccion-alumnos').classList.remove('hidden');
            document.querySelector('[data-tab="alumnos"]').classList.remove('font-medium', 'text-gray-600');
            document.querySelector('[data-tab="alumnos"]').classList.add('border-b-2', 'border-gray-900', 'font-bold', 'text-gray-900');
        } else if (seccion === 'empresas') {
            document.getElementById('seccion-empresas').classList.remove('hidden');
            document.querySelector('[data-tab="empresas"]').classList.remove('font-medium', 'text-gray-600');
            document.querySelector('[data-tab="empresas"]').classList.add('border-b-2', 'border-gray-900', 'font-bold', 'text-gray-900');
        }
    }
    document.addEventListener('DOMContentLoaded', () => {
        mostrarSeccion('alumnos');
    });
</script>

{{-- JS para la alerta de éxito (Sin cambios, corregido el typo </Gscript>) --}}
@if (session('success'))
    <script>
        console.log('Verificando Swal:', window.Swal);
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#0d9488'
            });
        } else {
            console.error('SweetAlert (Swal) no está definido. La alerta de éxito no se mostrará como pop-up.');
        }
    </script>
@endif
@endpush