<x-layouts.app>

    <x-slot name="title">
        Nueva Empresa
    </x-slot>


    <div class="p-8">

        <div class="flex items-center gap-4 mb-8">
            
            
            <a href="{{ route('estadias') }}" class="flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white font-medium transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Volver
            </a>
            
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Nueva Empresa</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Registra una nueva empresa para estadías</p>
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
                        placeholder="Ej: RedPetroil"
                        value="{{ old('nombre_empresa') }}"
                        maxlength="50"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500 @error('nombre_empresa') border-red-500 @enderror"
                    />
                    
                    @error('nombre_empresa')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nombre_contacto" class="block text-gray-900 dark:text-gray-200 font-semibold mb-2">Nombre del Contacto</label>
                        <input 
                            type="text" 
                            id="nombre_contacto"
                            name="nombre_contacto"
                            placeholder="Ej: Ing. Roberto Martínez"
                            value="{{ old('nombre_contacto') }}" 
                            maxlength="50"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500 @error('nombre_contacto') border-red-500 @enderror"
                        />
                        @error('nombre_contacto')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
<div>
    
    <label for="telefono" class="block text-gray-900 dark:text-gray-200 font-semibold mb-2">Teléfono</label>
    <input 
        type="tel"
        id="telefono"
        name="telefono"
        placeholder="Ingresa un número de teléfono"
        value="{{ old('telefono') }}"
        maxlength="10"
        pattern="[0-9]{10}"
        inputmode="numeric"
        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500 @error('telefono') border-red-500 @enderror"
    />

    @error('telefono')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
                </div>

                
                <div>
                    
                    <label for="email" class="block text-gray-900 dark:text-gray-200 font-semibold mb-2">Correo Electrónico</label>
                    <input 
                        type="email" 
                        id="email"
                        name="email"
                        placeholder="contacto@empresa.com"
                        value="{{ old('email') }}"
                        maxlength="50"
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
                        maxlength="100"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500"
                    />
                </div>

                
                <div>
                    <label for="notas" class="block text-gray-900 dark:text-gray-200 font-semibold mb-2">Notas Adicionales (Opcional)</label>
                    <textarea 
                        id="notas"
                        name="notas"
                        placeholder="Información adicional sobre la empresa..."
                        maxlength="100"
                        rows="5"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500 resize-none"
                    >{{ old('notas') }}</textarea>
                </div>

                
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

