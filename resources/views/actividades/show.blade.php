<x-layouts.app :title="$actividad->nombre">
    <div class="flex-1 p-6 md:p-8">
        <div class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700 max-w-2xl mx-auto">
            <div class="p-6 border-b border-gray-200 dark:border-neutral-700">
                <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">{{ $actividad->nombre }}</h3>
                <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">Detalles de la actividad.</p>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Tipo</p>
                    <p class="text-base text-gray-900 dark:text-neutral-100">{{ $actividad->tipoActividad->nombre ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Fecha</p>
                    <p class="text-base text-gray-900 dark:text-neutral-100">{{ \Carbon\Carbon::parse($actividad->fecha)->translatedFormat('l, j \de F \de Y') }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Asistentes</p>
                    <p class="text-base text-gray-900 dark:text-neutral-100">{{ $actividad->asistencia }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">Estatus</p>
                    <p class="text-base text-gray-900 dark:text-neutral-100">{{ $actividad->estatus }}</p>
                </div>
            </div>
            <div class="p-6 bg-gray-50 dark:bg-neutral-800/50 border-t border-gray-200 dark:border-neutral-700 flex justify-end">
                <a href="{{ route('actividades') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Volver</a>
            </div>
        </div>
    </div>
</x-layouts.app>
