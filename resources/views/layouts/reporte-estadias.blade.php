    {{-- 1. Heredamos de la plantilla maestra --}}
    @extends('layouts.app')

    {{-- 2. Definimos el título de esta página --}}
    @section('title', 'Reporte de Estadías')

    {{-- 3. Aquí va todo el contenido HTML --}}
    @section('content')
    <div class="p-8">
        <div class="flex justify-between items-start mb-8">
            <div class="flex items-center gap-4">
                
                {{-- Botón Volver --}}
                <a href="{{ route('estadias') }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Volver
                </a>
                
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Reporte de Estadías</h1>
                    <p class="text-gray-600 mt-1">Análisis de interés y aceptación por empresa</p>
                </div>
            </div>
            
            {{-- Botón de descarga (funcionalidad pendiente) --}}
            {{-- <a href="{{ route('estadias.reporte.pdf') }}" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Descargar PDF
            </a> --}}

        </div>

        {{-- ========================================= --}}
        {{-- CARDS DE ESTADÍSTICAS (DINÁMICAS) --}}
        {{-- ========================================= --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            {{-- Iteramos el array $stats que viene del controlador --}}
            @foreach ($stats as $estatus => $data)
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <p class="text-gray-600 text-sm font-medium mb-2">{{ $estatus }}</p>
                    {{-- Usamos la clase de color y el conteo --}}
                    <h3 class="text-4xl font-bold {{ $data['color'] }} mb-3">{{ $data['count'] }}</h3>
                    {{-- Mostramos el porcentaje si hay opciones, sino un guión --}}
                    <p class="text-gray-600 text-sm">
                        @if($totalOpciones > 0)
                            {{ $data['percentage'] }}% del total
                        @else
                            -
                        @endif
                    </p>
                </div>
            @endforeach
        </div>
        {{-- FIN CARDS --}}

        {{-- ========================================= --}}
        {{-- RANKING DE EMPRESAS (DINÁMICO) --}}
        {{-- ========================================= --}}
        <div class="bg-white border border-gray-200 rounded-xl p-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Ranking de Empresas por Interés</h2>
                <p class="text-gray-600">Empresas ordenadas por la cantidad de alumnos que las eligieron como opción.</p>
            </div>

            <div class="space-y-3">
                
                {{-- Usamos un bucle @forelse por si no hay datos --}}
                @forelse($empresasRankeadas as $index => $rankData)
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                        <div class="flex items-start sm:items-center gap-4 flex-col sm:flex-row"> {{-- Ajuste para móvil --}}
                            {{-- Icono y Número de Ranking --}}
                            <div class="flex items-center gap-3 flex-shrink-0">
                                <div class="bg-teal-100 p-3 rounded-lg">
                                    {{-- Puedes cambiar el icono si quieres --}}
                                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h6m-6 4h6m-6 4h6"></path></svg>
                                </div>
                                <span class="text-lg font-bold text-gray-500">{{ $index + 1 }}.</span>
                            </div>

                            {{-- Información de la Empresa --}}
                            <div class="flex-1 min-w-0">
                                {{-- Nombre de la empresa (viene de la relación ->empresa) --}}
                                <h3 class="text-base font-bold text-gray-900">{{ $rankData->empresa->nombre ?? 'Empresa Desconocida' }}</h3>
                                {{-- Total de interesados --}}
                                <p class="text-gray-600 text-sm mb-3">{{ $rankData->interesados }} alumno(s) interesado(s)</p>

                                {{-- Desglose por estatus --}}
                                <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm"> {{-- Ajuste de gap --}}
                                    <div>
                                        <span class="text-gray-600">Aceptados:</span>
                                        <p class="font-semibold text-teal-600">{{ $rankData->aceptados }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Pendientes:</span>
                                        <p class="font-semibold text-orange-500">{{ $rankData->pendientes }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Rechazados:</span>
                                        <p class="font-semibold text-red-600">{{ $rankData->rechazados }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Mensaje si no hay opciones de estadía registradas --}}
                    <div class="text-center py-8 text-gray-500">
                        No hay suficientes datos para generar el ranking de empresas.
                    </div>
                @endforelse
                
            </div>
        </div>
        {{-- FIN RANKING --}}
    </div>
    @endsection
    
