<x-layouts.app>
    <div class="p-8">

        <div class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Estadías y Empresas</h1>
                <p class="text-gray-600 dark:text-gray-400">Gestiona empresas y opciones de estadía de alumnos</p>
            </div>
            <div class="flex gap-3">

                <a href="{{ route('estadias.reporte') }}" class="flex items-center gap-2 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Ver Reporte
                </a>

                <a href="{{ route('empresas.create') }}" class="flex items-center gap-2 px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-medium transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nueva Empresa
                </a>
            </div>
        </div>

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
                            @php
                                $opciones = [
                                    $alumno->opcionesEstadia->firstWhere('opcion_numero', 1),
                                    $alumno->opcionesEstadia->firstWhere('opcion_numero', 2),
                                    $alumno->opcionesEstadia->firstWhere('opcion_numero', 3)
                                ];
                            @endphp

                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                <td class="py-4 px-4 text-gray-900 dark:text-white">{{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</td>
                                <td class="py-4 px-4 text-gray-900 dark:text-white">{{ $alumno->pk_alumno }}</td>

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
                                
                                <td class="py-9 px-9">
                                    <div class="flex gap-3">
                                        <button @click.prevent="openModal({{ Js::from($alumno) }})" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition cursor-pointer" title="Asignar Empresas">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 px-4 text-center text-gray-600 dark:text-gray-400">No hay alumnos registrados todavía.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

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
                            <button 
                                type="button" 
                                @click.prevent="showModal = false"
                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium transition cursor-pointer"
                            >
                                Cancelar
                            </button>
                            <button 
                                type="submit"
                                class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-medium transition cursor-pointer"
                            >
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


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
                    <form @submit.prevent="saveEmpresa()">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Editar Empresa</h3>
                            <p class="text-gray-600 dark:text-gray-400" x-text="selectedEmpresa ? selectedEmpresa.nombre : 'Cargando...'"></p>
                        </div>

                        <div class="p-6 space-y-4">
                            <div>
                                <label for="nombre_empresa" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre de la Empresa</label>
                                <input type="text" id="nombre_empresa" x-model="formData.nombre" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" maxlength="50" required >
                            </div>
                            <div>
                                <label for="nombre_contacto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre de Contacto</label>
                                <input type="text" id="nombre_contacto" x-model="formData.nombre_contacto" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" maxlength="50">
                            </div>
                            <div>
                                <label for="tel_empresa" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Teléfono</label>
                                <input type="text" id="tel_empresa" x-model="formData.tel" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" maxlength="10" pattern="[0-9]{10}">
                            </div>
                            <div>
                                <label for="correo_empresa" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Correo Electrónico</label>
                                <input type="email" id="correo_empresa" x-model="formData.correo" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" maxlength="50">
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-800 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                            <button type="button" @click.prevent="showModal = false" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium transition cursor-pointer">
                                Cancelar
                            </button>
                            <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-medium transition cursor-pointer">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPTS --}}
    <script>

        async function apiRequest(url, method, body = {}) {
            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            
            if (!tokenMeta) {
                console.error('Meta tag csrf-token no encontrado en el DOM');
                throw new Error('Token CSRF no disponible. Recarga la página.');
            }
            
            const token = tokenMeta.content;
            const isGet = method.toUpperCase() === 'GET';
            const fetchMethod = isGet ? 'GET' : 'POST'; 
            
            const data = isGet ? {} : {
                ...body,
                _token: token,
                _method: method.toUpperCase()
            };

            const response = await fetch(url, {
                method: fetchMethod,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                ...(isGet ? {} : { body: JSON.stringify(data) })
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

        function manageOpcionStatus(opcionId, initialStatus) {
            return {
                currentStatus: initialStatus,
                opcionId: opcionId,
                async updateStatus() {
                    try {
                        const url = `/opciones-estadia/${this.opcionId}/status`;
                        await apiRequest(url, 'PATCH', { estatus: this.currentStatus });

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

        // FUNCIÓN 'manageEstadiasModal' CORREGIDA

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
                    
                    const opciones = student.opciones_estadia || [];
                    const op1 = opciones.find(op => op.opcion_numero == 1);
                    const op2 = opciones.find(op => op.opcion_numero == 2);
                    const op3 = opciones.find(op => op.opcion_numero == 3);

                    this.formData.opcion_1_id = op1 ? op1.fk_empresa : "";
                    this.formData.opcion_2_id = op2 ? op2.fk_empresa : "";
                    this.formData.opcion_3_id = op3 ? op3.fk_empresa : "";

                    this.showModal = true;
                },

                async saveOpciones() {
                    const cleanFormData = {
                        opcion_1_id: this.formData.opcion_1_id || null,
                        opcion_2_id: this.formData.opcion_2_id || null,
                        opcion_3_id: this.formData.opcion_3_id || null,
                    };

                    try {
                        const result = await apiRequest(this.formUrl, 'PUT', cleanFormData);
                        
                        if (result.success) {
                            this.showModal = false;
                            
                            Swal.fire({
                                title: '¡Actualizado!',
                                text: result.message || 'Las opciones de estadía se guardaron correctamente.',
                                icon: 'success',
                                confirmButtonText: 'Entendido',
                                confirmButtonColor: '#0d9488'
                            }).then(() => {
                                window.location.reload(); 
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

        // FUNCIÓN 'manageEmpresasModal'

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
                        const result = await apiRequest(this.formUrl, 'PUT', this.formData);

                        if (result.success) {
                            this.showModal = false;
                            this.updateEmpresaRow(this.selectedEmpresa.pk_empresa, this.formData);
                            
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Empresa actualizada',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
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

                updateEmpresaRow(empresaId, newData) {
                    const row = document.querySelector(`tr[data-empresa-id="${empresaId}"]`);
                    
                    if (row) {
                        const nombreCell = row.querySelector('[data-field="nombre"]');
                        const contactoCell = row.querySelector('[data-field="contacto"]');
                        const telefonoCell = row.querySelector('[data-field="telefono"]');
                        const correoCell = row.querySelector('[data-field="correo"]');
                        
                        if (nombreCell) nombreCell.textContent = newData.nombre;
                        if (contactoCell) contactoCell.textContent = newData.nombre_contacto || 'N/A';
                        if (telefonoCell) telefonoCell.textContent = newData.tel || 'N/A';
                        if (correoCell) correoCell.textContent = newData.correo || 'N/A';
                        
                        row.classList.add('bg-green-50', 'dark:bg-green-900/20');
                        setTimeout(() => {
                            row.classList.remove('bg-green-50', 'dark:bg-green-900/20');
                        }, 2000);
                    }
                },

                async confirmDelete(empresaId, empresaNombre) {
                    const result = await Swal.fire({
                        title: '¿Estás seguro?',
                        html: `¿Deseas eliminar la empresa <strong>${empresaNombre}</strong>?<br><small class="text-gray-500">Esta acción no se puede deshacer.</small>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    });

                    if (result.isConfirmed) {
                        try {
                            const deleteResult = await apiRequest(`/empresas/${empresaId}`, 'DELETE', {});

                            if (deleteResult.success) {
                                this.removeEmpresaRow(empresaId);
                                
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Empresa eliminada',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true
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
                },

                removeEmpresaRow(empresaId) {
                    const row = document.querySelector(`tr[data-empresa-id="${empresaId}"]`);
                    
                    if (row) {
                        row.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                        row.style.opacity = '0';
                        row.style.transform = 'translateX(-20px)';
                        
                        setTimeout(() => {
                            row.remove();
                            
                            const remainingRows = document.querySelectorAll('#seccion-empresas tbody tr');
                            if (remainingRows.length === 0) {
                                const tbody = document.querySelector('#seccion-empresas tbody');
                                tbody.innerHTML = '<tr><td colspan="5" class="py-4 px-4 text-center text-gray-600 dark:text-gray-400">No hay empresas registradas todavía.</td></tr>';
                            }
                        }, 300);
                    }
                }
            }
        }

        // LÓGICA DE TABS Y NOTIFICACIONES
        function mostrarSeccion(seccion) {
            document.getElementById('seccion-alumnos').classList.add('hidden');
            document.getElementById('seccion-empresas').classList.add('hidden');
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-b-2', 'border-gray-900', 'dark:border-white', 'font-bold', 'text-gray-900', 'dark:text-white');
                btn.classList.add('font-medium', 'text-gray-600', 'dark:text-gray-400', 'hover:text-gray-900', 'dark:hover:text-white');
            });

            if (seccion === 'alumnos') {
                document.getElementById('seccion-alumnos').classList.remove('hidden');
                document.querySelector('[data-tab="alumnos"]').classList.remove('font-medium', 'text-gray-600', 'dark:text-gray-400');
                document.querySelector('[data-tab="alumnos"]').classList.add('border-b-2', 'border-gray-900', 'dark:border-white', 'font-bold', 'text-gray-900', 'dark:text-white');
            } else if (seccion === 'empresas') {
                document.getElementById('seccion-empresas').classList.remove('hidden');
                document.querySelector('[data-tab="empresas"]').classList.remove('font-medium', 'text-gray-600', 'dark:text-gray-400');
                document.querySelector('[data-tab="empresas"]').classList.add('border-b-2', 'border-gray-900', 'dark:border-white', 'font-bold', 'text-gray-900', 'dark:text-white');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            mostrarSeccion('alumnos');
        });

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