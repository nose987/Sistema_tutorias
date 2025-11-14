<x-layouts.app>
    <div class="p-8">

        {{-- INICIO: CABECERA (Sin cambios) --}}
        <div class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Reportes Finales de Estadía</h1>
                <p class="text-gray-600 dark:text-gray-400">Alumnos con empresa confirmada para su estadía.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('estadias') }}" class="flex items-center gap-2 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Volver a Gestión
                </a>
            </div>
        </div>
        {{-- FIN: CABECERA --}}

        
        <div id="seccion-reportes" class="bg-white dark:bg-zinc-900 border border-gray-200 dark:border-gray-700 rounded-xl p-6">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Listado de Alumnos Confirmados</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Esta lista muestra la empresa final asignada a cada alumno.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Alumno</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">ID</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Empresa Confirmada</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-900 dark:text-white">Estatus Final</th>
                            
                            {{-- =================================== --}}
                            {{--      CORRECCIÓN 1: "text-center"      --}}
                            {{-- =================================== --}}
                            <th class="text-center py-3 px-4 font-semibold text-gray-900 dark:text-white">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @forelse ($alumnosConfirmados as $alumno)
                            @php
                                // Lógica (Sin cambios)
                                $op1 = $alumno->opcionesEstadia->firstWhere('opcion_numero', 1);
                                $op2 = $alumno->opcionesEstadia->firstWhere('opcion_numero', 2);
                                $op3 = $alumno->opcionesEstadia->firstWhere('opcion_numero', 3);
                                
                                $opcionFinal = null;
                                if ($op1 && $op1->estatus == 'Aceptado') $opcionFinal = $op1;
                                elseif ($op2 && $op2->estatus == 'Aceptado') $opcionFinal = $op2;
                                elseif ($op3 && $op3->estatus == 'Aceptado') $opcionFinal = $op3;
                            @endphp

                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                
                                {{-- Alumno --}}
                                <td class="py-4 px-4 text-gray-900 dark:text-white">
                                    {{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}
                                </td>
                                
                                {{-- ID --}}
                                <td class="py-4 px-4 text-gray-900 dark:text-white">
                                    {{ $alumno->pk_alumno }}
                                </td>
                                
                                {{-- Empresa Confirmada --}}
                                <td class="py-4 px-4 text-gray-900 dark:text-white font-medium">
                                    {{ $opcionFinal?->empresa?->nombre ?? 'N/A' }}
                                </td>
                                
                                {{-- Estatus Final --}}
                                <td class="py-4 px-4">
                                    @if ($opcionFinal)
                                        <span class="inline-block bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 text-xs px-3 py-1 rounded-full font-medium">
                                            Aceptado (Opción {{ $opcionFinal->opcion_numero }})
                                        </span>
                                    @else
                                        <span class="inline-block bg-gray-300 dark:bg-gray-600 text-gray-900 dark:text-gray-200 text-xs px-3 py-1 rounded-full font-medium">
                                            Error
                                        </span>
                                    @endif
                                </td>

                                {{-- =================================== --}}
                                {{--      CORRECCIÓN 2: "text-center"      --}}
                                {{-- =================================== --}}
                                <td class="py-4 px-4 text-center">
                                    <button 
                                        onclick="revertirFinalizacion({{ $alumno->pk_alumno }}, '{{ addslashes($alumno->nombre.' '.$alumno->apellido_paterno) }}')"
                                        class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition cursor-pointer" 
                                        title="Revertir finalización (regresa al alumno a gestión)"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                {{-- =================================== --}}
                                {{--        CORRECCIÓN 3: "colspan=5"        --}}
                                {{-- =================================== --}}
                                <td colspan="5" class="py-6 px-4 text-center text-gray-600 dark:text-gray-400">
                                    No hay alumnos con estadía confirmada todavía.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ====================================================================== --}}
    {{-- ============ INICIO DE MODIFICACIONES DE SCRIPT ============ --}}
    {{-- ====================================================================== --}}
    <script>
        // 🔑 CORRECCIÓN DEFINITIVA: Inyectar el token CSRF directamente en JavaScript
        // Esto soluciona el problema de sincronización/búsqueda de la etiqueta <meta>.
        window.csrfToken = "{{ csrf_token() }}"; 

        // --- FUNCIÓN 1: apiRequest (CORREGIDA para usar la variable global) ---
        async function apiRequest(url, method, body = {}) {
            // Usamos la variable inyectada.
            const token = window.csrfToken; 
            
            if (!token) {
                // Esta línea ahora solo se activa si el token es nulo o vacío
                throw new Error('Token CSRF no disponible (la variable Blade falló al inyectar).');
            }
            
            const isGet = method.toUpperCase() === 'GET';
            const response = await fetch(url, {
                method: isGet ? 'GET' : 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': token, 
                    'Accept': 'application/json' 
                },
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

        // --- FUNCIÓN 2: revertirFinalizacion ---
        async function revertirFinalizacion(alumnoId, alumnoNombre) {
            const result = await Swal.fire({
                title: '¿Revertir Finalización?',
                html: `¿Deseas revertir la estadía de <strong>${alumnoNombre}</strong>?<br><br><small>El alumno volverá a la pantalla de gestión y sus opciones "Rechazado" se marcarán como "Pendiente".</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626', // Color Rojo
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, revertir',
                cancelButtonText: 'Cancelar'
            });

            if (result.isConfirmed) {
                try {
                    // Esta es la nueva ruta que crearemos en el Paso 2
                    const url = `/alumnos/${alumnoId}/revertir-final`;
                    const postResult = await apiRequest(url, 'PATCH', {});
                    
                    await Swal.fire({
                        icon: 'success',
                        title: '¡Revertido!',
                        text: postResult.message || 'El alumno fue regresado a la gestión.',
                        confirmButtonColor: '#0d9488'
                    });
                    
                    window.location.reload(); // Recarga la página para que el alumno desaparezca de esta lista
                    
                } catch (error) {
                    Swal.fire('Error', error.message || 'No se pudo revertir la finalización.', 'error');
                }
            }
        }

        // --- Notificación de sesión (ya existente) ---
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