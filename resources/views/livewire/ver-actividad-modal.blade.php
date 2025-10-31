<div x-data="{ show: @entangle('showModal') }" x-show="show" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="show = false"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-lg p-8 my-8 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-neutral-800 shadow-xl rounded-2xl">
            @if (isset($actividad))
            <h3 class="text-lg font-bold leading-6 text-gray-900 dark:text-neutral-100" id="modal-title">
                {{ $actividad->nombre }}
            </h3>
            <div class="mt-4 space-y-4">
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
            <div class="mt-6 flex justify-end">
                <button type="button" @click="show = false" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cerrar</button>
            </div>
            @endif
        </div>
    </div>
</div>
