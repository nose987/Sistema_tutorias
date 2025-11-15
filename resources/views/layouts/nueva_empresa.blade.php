<x-layouts.app>

    <x-slot name="title">
        Nueva Empresa
    </x-slot>


    <div class="p-8">

        <!-- MODIFICADO: Se usa 'flex justify-between' para alinear el título a la izquierda y el botón a la derecha -->
        <div class="flex justify-between items-start mb-8">
            
            <!-- Contenedor del título (lado izquierdo) -->
            <div class="flex items-center gap-4">
                
                {{-- (Aquí iría el ícono si lo tenías) --}}
                
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Nueva Empresa</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Registra una nueva empresa para estadías</p>
                </div>
            </div>

            <!-- AÑADIDO: Botón de "Volver a Gestión" (lado derecho) -->
            <div>
                <a href="{{ route('estadias') }}" class="flex items-center gap-2 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Volver a Gestión
                </a>
            </div>

        </div>

        
        <div class="bg-white dark:bg-zinc-900 border border-gray-200 dark:border-gray-700 rounded-xl p-8 max-w-4xl mx-auto">
            <!-- Section Title -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Información de la Empresa</h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Completa los datos de contacto de la empresa</p>
            </div>

            <form action="{{ route('empresas.store') }}" method="POST" class="space-y-6">
                
                @csrf

                
                <div>
                    
                    <label for="nombre_empresa" class="block text-gray-900 dark:text-gray-200 font-semibold mb-2">Nombre de la Empresa</label>
                    <input 
                        type="text" 
                        id="nombre_empresa"
                        name="nombre_empresa"
                        placeholder="Ingresa el nombre de la empresa"
                        value="{{ old('nombre_empresa') }}"
                        maxlength="50" {{-- Ajustado al max de la validación --}}
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500 @error('nombre_empresa') border-red-500 @enderror"
                    />
                    
                    @error('nombre_empresa')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- CAMPO DE CONTACTO ELIMINADO -->
                
                <!-- CAMPO DE TELÉFONO AHORA OCUPA ANCHO COMPLETO -->
                <div>
                    <label for="telefono" class="block text-gray-900 dark:text-gray-200 font-semibold mb-2">Teléfono</label>
                    <input 
                        type="tel"
                        id="telefono"
                        name="telefono"
                        placeholder="Ingresa un número de teléfono"
                        value="{{ old('telefono') }}"
                        maxlength="10" {{-- Ajustado al max de la validación --}}
                        pattern="[0-9]{10,20}"
                        inputmode="numeric"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500 @error('telefono') border-red-500 @enderror"
                    />

                    @error('telefono')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                

                
                <div>
                    
                    <label for="email" class="block text-gray-900 dark:text-gray-200 font-semibold mb-2">Correo Electrónico</label>
                    <input 
                        type="email" 
                        id="email"
                        name="email"
                        placeholder="Ingresa el correo electrónico de la empresa"
                        value="{{ old('email') }}"
                        maxlength="50" {{-- Ajustado al max de la validación --}}
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500 @error('email') border-red-500 @enderror"
                    />
                    
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                
                <div>
                    <label for="direccion" class="block text-gray-900 dark:text-gray-200 font-semibold mb-2">Dirección (Opcional)</label>
                    <input 
                        type="text" 
                        id="direccion"
                        name="direccion"
                        placeholder="Dirección de la empresa"
                        value="{{ old('direccion') }}"
                        maxlength="50"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500"
                    />
                     @error('direccion')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                
                <!-- CAMPO DE NOTAS ELIMINADO -->

                
                <div class="flex justify-end gap-4 pt-4">
                    
                    <a 
                        href="{{ route('estadias') }}"
                        class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-200 font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition cursor-pointer"
                    >
                        Cancelar
                    </a>
                    
                    <button 
                        type="submit"
                        class="px-6 py-2 bg-teal-600 text-white font-semibold rounded-lg hover:bg-teal-700 transition cursor-pointer"
                    >
                        Guardar Empresa
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>