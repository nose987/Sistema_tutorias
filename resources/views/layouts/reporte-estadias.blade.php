<x-layouts.app>

    <x-slot name="title">
        Reporte de Estadías
    </x-slot>

    <div class="p-8">
        <div class="flex justify-between items-start mb-8">
            <div class="flex items-center gap-4">
                

                
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Reporte de Estadías</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Análisis de interés y aceptación por empresa</p>
                </div>
            </div>
            <div>
                                <a href="{{ route('estadias') }}" class="flex items-center gap-2 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Volver a Gestión
                </a>
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            @foreach ($stats as $estatus => $data)
                <div class="bg-white dark:bg-zinc-900 border border-gray-200 dark:border-gray-700 rounded-xl p-6">
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-medium mb-2">{{ $estatus }}</p>
                    
                    <h3 class="text-4xl font-bold text-gray-900 dark:text-white mb-3">{{ $data['count'] }}</h3>
                    
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        @if($totalOpciones > 0)
                            {{ $data['percentage'] }}% del total
                        @else
                            -
                        @endif
                    </p>
                </div>
            @endforeach
        </div>

        <div class="bg-white dark:bg-zinc-900 border border-gray-200 dark:border-gray-700 rounded-xl p-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Ranking de Empresas por Interés</h2>
                <p class="text-gray-600 dark:text-gray-400">Empresas ordenadas por la cantidad de alumnos que las eligieron como opción.</p>
            </div>

            <div class="space-y-3">
                
                @forelse($empresasRankeadas as $index => $rankData)
                    <div class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-md transition">
                        <div class="flex items-start sm:items-center gap-4 flex-col sm:flex-row">
                            <div class="flex items-center gap-3 flex-shrink-0">
                                <div class="bg-teal-100 dark:bg-teal-900 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-teal-600 dark:text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h6m-6 4h6m-6 4h6"></path></svg>
                                </div>
                                <span class="text-lg font-bold text-gray-500 dark:text-gray-400">{{ $index + 1 }}.</span>
                            </div>

                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">{{ $rankData->empresa->nombre ?? 'Empresa Desconocida' }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">{{ $rankData->interesados }} alumno(s) interesado(s)</p>

                                <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm">
                                    <div>
                                        <span class="text-gray-600 dark:text-gray-400">Aceptados:</span>
                                        <p class="font-semibold text-teal-600">{{ $rankData->aceptados }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 dark:text-gray-400">Pendientes:</span>
                                        <p class="font-semibold text-orange-500">{{ $rankData->pendientes }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 dark:text-gray-400">Rechazados:</span>
                                        <p class="font-semibold text-red-600">{{ $rankData->rechazados }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        No hay suficientes datos para generar el ranking de empresas.
                    </div>
                @endforelse
                
            </div>
        </div>
    </div>
</x-layouts.app>