{{-- 1. Heredamos de la plantilla maestra (layouts.app) --}}
@extends('layouts.app')

{{-- 2. Definimos el título de esta página --}}
@section('title', 'Nueva Empresa')

{{-- 3. Aquí va todo el contenido HTML --}}
@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        
        {{-- CAMBIO: El botón "Volver" ahora usa la ruta 'estadias' --}}
        <a href="{{ route('estadias') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver
        </a>
        
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Nueva Empresa</h1>
            <p class="text-gray-600 mt-1">Registra una nueva empresa para estadías</p>
        </div>
    </div>

    <!-- Form Container -->
    <div class="bg-white border border-gray-200 rounded-xl p-8 max-w-4xl mx-auto">
        <!-- Section Title -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-2">Información de la Empresa</h2>
            <p class="text-gray-600 text-sm">Completa los datos de contacto de la empresa</p>
        </div>

        {{-- 
            CAMBIOS IMPORTANTES DEL FORMULARIO:
            1. 'method="POST"' - Le dice al navegador que envíe los datos.
            2. 'action="..."' - Le dice a dónde enviar los datos. Crearemos esta ruta 'empresas.store' después.
        --}}
        <form action="{{ route('empresas.store') }}" method="POST" class="space-y-6">
            
            {{-- 3. '@csrf' - ¡OBLIGATORIO! Es la protección de seguridad de Laravel para formularios --}}
            @csrf

            <!-- Nombre de la Empresa -->
            <div>
                <label class="block text-gray-900 font-semibold mb-2">Nombre de la Empresa</label>
                <input 
                    type="text" 
                    name="nombre_empresa" {{-- 4. AÑADIDO 'name' --}}
                    placeholder="Ej: RedPetroil"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500"
                />
            </div>

            <!-- Nombre del Contacto y Teléfono -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-900 font-semibold mb-2">Nombre del Contacto</label>
                    <input 
                        type="text" 
                        name="nombre_contacto" {{-- 4. AÑADIDO 'name' --}}
                        placeholder="Ej: Ing. Roberto Martínez"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500"
                    />
                </div>
                <div>
                    <label class="block text-gray-900 font-semibold mb-2">Teléfono</label>
                    <input 
                        type="tel" 
                        name="telefono" {{-- 4. AÑADIDO 'name' --}}
                        placeholder="555-1234"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500"
                    />
                </div>
            </div>

            <!-- Correo Electrónico -->
            <div>
                <label class="block text-gray-900 font-semibold mb-2">Correo Electrónico</label>
                <input 
                    type="email" 
                    name="email" {{-- 4. AÑADIDO 'name' --}}
                    placeholder="contacto@empresa.com"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500"
                />
            </div>

            <!-- Dirección (Opcional) -->
            <div>
                <label class="block text-gray-900 font-semibold mb-2">Dirección (Opcional)</label>
                <input 
                    type="text" 
                    name="direccion" {{-- 4. AÑADIDO 'name' --}}
                    placeholder="Dirección de la empresa"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500"
                />
            </div>

            <!-- Notas Adicionales (Opcional) -->
            <div>
                <label class="block text-gray-900 font-semibold mb-2">Notas Adicionales (Opcional)</label>
                <textarea 
                    name="notas" {{-- 4. AÑADIDO 'name' --}}
                    placeholder="Información adicional sobre la empresa..."
                    rows="5"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-500 resize-none"
                ></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-4 pt-4">
                
                {{-- CAMBIO: El botón Cancelar ahora es un link a 'estadias' --}}
                <a 
                   href="{{ route('estadias') }}"
                   class="px-6 py-2 border border-gray-300 text-gray-900 font-semibold rounded-lg hover:bg-gray-50 transition"
                >
                    Cancelar
                </a>
                
                <button 
                    type="submit"
                    class="px-6 py-2 bg-teal-600 text-white font-semibold rounded-lg hover:bg-teal-700 transition"
                >
                    Guardar Empresa
                </button>
            </div>
        </form>
    </div>
</div>
@endsection