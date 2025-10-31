<x-layouts.app :title="__('Editar Actividad')">
    <div class="flex-1 p-6 md:p-8">
        <div class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700 max-w-2xl mx-auto">
            <div class="p-6 border-b border-gray-200 dark:border-neutral-700">
                <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Editar Actividad</h3>
                <p class="text-sm text-gray-500 dark:text-neutral-400 mt-1">Actualiza los detalles de la actividad.</p>
            </div>
            <div class="p-6">
                <form action="{{ route('actividades.update', $actividad) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Nombre de la actividad</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $actividad->nombre) }}" required class="w-full pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="fk_tipo_actividad" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Tipo de actividad</label>
                        <select name="fk_tipo_actividad" id="fk_tipo_actividad" required class="w-full pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            <option value="">Seleccione un tipo</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->pk_tipo_actividad }}" @selected(old('fk_tipo_actividad', $actividad->fk_tipo_actividad) == $tipo->pk_tipo_actividad)>{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Fecha</label>
                        <input type="date" name="fecha" id="fecha" value="{{ old('fecha', $actividad->fecha) }}" required class="w-full pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="asistencia" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Asistentes</label>
                        <input type="number" name="asistencia" id="asistencia" value="{{ old('asistencia', $actividad->asistencia) }}" required min="0" max="99999" class="w-full pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('actividades') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cancelar</a>
                        <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-md text-sm font-medium hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">Actualizar Actividad</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
