<x-layouts.app :title="__('Perfil del Alumno')">
  <div class="flex h-screen overflow-hidden">
    <main class="flex-1 p-6 md:p-8 bg-slate-50 dark:bg-[#262626] overflow-y-auto">
      @if (session('status'))
        <div class="mb-4 rounded-xl border px-4 py-3 text-sm
          bg-green-50 border-green-200 text-green-800
          dark:bg-green-900/40 dark:border-green-800 dark:text-green-200">
          {{ session('status') }}
        </div>
      @endif

      {{-- Back: vuelve al detalle del grupo del alumno --}}
      <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('detalle_grupo', $alumno->fk_grupo) }}"
          class="flex items-center space-x-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-neutral-300 hover:text-gray-900 dark:hover:text-neutral-100 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
          </svg>
          <span>Volver al Grupo</span>
        </a>
      </div>

      {{-- Header --}}
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
          <div class="flex items-center gap-3 mb-2">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-neutral-100">
              {{ trim(($alumno->nombre ?? '').' '.($alumno->apellido_paterno ?? '').' '.($alumno->apellido_materno ?? '')) ?: 'Sin nombre' }}
            </h1>

            {{-- Definir variables de estatus para reusar en toda la vista --}}
            @php
              $estatus = $alumno->estatus ?? 'Activo';
              $nextStatus = $estatus === 'Activo' ? 'Baja' : 'Activo';
              $isGoingToBaja = $nextStatus === 'Baja';
            @endphp

            @if($estatus === 'Activo')
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                Activo
              </span>
            @else
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">
                Baja
              </span>
            @endif
          </div>
        </div>
      </div>

      {{-- Info + Acciones rápidas --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        {{-- Información del Alumno --}}
        <div class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
          <div class="p-6 border-b border-gray-200 dark:border-neutral-700">
            <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Información del Alumno</h3>
            <p class="text-sm text-gray-500 dark:text-neutral-400">Datos personales y de contacto</p>
          </div>
          <div class="p-6 space-y-4">
            <div>
              <p class="text-sm text-gray-500 dark:text-neutral-400">Grupo</p>
              <p class="font-medium text-gray-900 dark:text-neutral-100 mt-1">
                {{ $alumno->grupo->nombre_grupo ?? '—' }}
              </p>
              @if(!empty($alumno->grupo))
                <p class="text-xs text-gray-500 dark:text-neutral-400">
                  Estatus grupo: {{ $alumno->grupo->estatus ?? '—' }}
                  @if(!empty($alumno->grupo->cuatrimestre)) • Cuatrimestre: {{ $alumno->grupo->cuatrimestre }} @endif
                </p>
              @endif
            </div>

            <div>
              <p class="text-sm text-gray-500 dark:text-neutral-400">Correo Electrónico</p>
              <p class="font-medium text-gray-900 dark:text-neutral-100 mt-1">
                {{ $alumno->correo ?? '—' }}
              </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm text-gray-500 dark:text-neutral-400">Teléfono</p>
                <p class="font-medium text-gray-900 dark:text-neutral-100 mt-1">{{ $alumno->telefono ?? '—' }}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500 dark:text-neutral-400">Celular</p>
                <p class="font-medium text-gray-900 dark:text-neutral-100 mt-1">{{ $alumno->celular ?? '—' }}</p>
              </div>
            </div>

            <div>
              <p class="text-sm text-gray-500 dark:text-neutral-400">Dirección</p>
              <p class="font-medium text-gray-900 dark:text-neutral-100 mt-1 whitespace-pre-line">
                {{ $alumno->direccion ?? '—' }}
              </p>
            </div>
          </div>
        </div>

        {{-- Acciones Rápidas (enlaces placeholders para tus módulos) --}}
        <div class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
          <div class="p-6 border-b border-gray-200 dark:border-neutral-700">
            <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Acciones Rápidas</h3>
            <p class="text-sm text-gray-500 dark:text-neutral-400">Gestión del tutorado</p>
          </div>
          <div class="p-6 space-y-2">
            <a href="#"
              class="flex items-center justify-start w-full px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-700">
              Entrevista Individual
            </a>
            <a href="#"
              class="flex items-center justify-start w-full px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-700">
              Generar Canalización
            </a>
            <button
              class="flex items-center justify-start w-full px-4 py-2 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-700">
              Ver Historial de Canalizaciones
            </button>

            <button
              type="button"
              id="openStatusModal"
              class="flex items-center justify-start w-full px-4 py-2 text-sm font-medium border rounded-lg shadow-sm transition-colors
                {{ $estatus === 'Activo'
                  ? 'text-red-600 dark:text-red-400 bg-white dark:bg-neutral-800 border-gray-300 dark:border-neutral-700 hover:bg-red-50 dark:hover:bg-red-950'
                  : 'text-green-700 dark:text-green-300 bg-white dark:bg-neutral-800 border-gray-300 dark:border-neutral-700 hover:bg-green-50 dark:hover:bg-green-900' }}">
              {{ $estatus === 'Activo' ? 'Marcar como Baja' : 'Marcar como Activo' }}
            </button>
          </div>
        </div>
      </div>

      {{-- Observaciones --}}
      <div class="bg-white dark:bg-neutral-900 rounded-lg shadow-sm border border-gray-200 dark:border-neutral-700">
        <div class="p-6 border-b border-gray-200 dark:border-neutral-700">
          <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
              <h3 class="font-bold text-lg text-gray-800 dark:text-neutral-100">Observaciones</h3>
              <p class="text-sm text-gray-500 dark:text-neutral-400">Notas y seguimiento del tutorado</p>
            </div>
            <button
              id="openObsModal"
              type="button"
              class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-white bg-[#2B8A7F] border border-transparent rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 mt-3 md:mt-0">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
              </svg>
              <span>Nueva Observación</span>
            </button>
          </div>
        </div>

        <div class="p-6">
          @forelse($alumno->observaciones as $obs)
            <div class="p-4 border border-gray-200 dark:border-neutral-700 rounded-lg bg-gray-50 dark:bg-neutral-800 mb-4">
              <div class="flex items-start justify-between gap-3">
                <div>
                  <strong class="text-gray-900 dark:text-neutral-100 text-sm font-semibold">
                    {{ $obs->nombre ?? 'Observación' }}
                  </strong>
                  <p class="text-sm text-gray-700 dark:text-neutral-300 leading-relaxed mt-1 whitespace-pre-line">
                    {{ $obs->observacion }}
                  </p>
                </div>

                {{-- CAMBIO: Botón que abre el modal de eliminar --}}
                <button
                  type="button"
                  class="openDeleteObsModal text-red-600 dark:text-red-400 text-xs px-2 py-1 rounded hover:bg-red-50 dark:hover:bg-red-950 border border-transparent hover:border-red-200 dark:hover:border-red-900"
                  data-action-url="{{ route('observaciones.destroy', $obs->pk_observacion) }}"
                  data-obs-nombre="{{ $obs->nombre ?? 'Observación' }}">
                  Eliminar
                </button>
                
              </div>
            </div>
          @empty
            <div class="p-4 border border-dashed border-gray-300 dark:border-neutral-700 rounded-lg text-sm text-gray-500 dark:text-neutral-400">
              Aún no hay observaciones registradas para este alumno.
            </div>
          @endforelse
        </div>
      </div>
    </main>

    {{-- 
      MODALES
      Movidos fuera del <main> para evitar problemas de scroll y z-index 
    --}}

    {{-- Modal: Cambiar estatus --}}
    <div id="statusModal" class="fixed inset-0 z-[80] hidden">
      {{-- Overlay --}}
      <div id="statusOverlay" class="absolute inset-0 bg-black/50 backdrop-blur-[2px]"></div>

      {{-- Dialog --}}
      <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="w-full max-w-md rounded-2xl border shadow-2xl
          bg-white dark:bg-neutral-900
          border-gray-200 dark:border-neutral-700">

          {{-- Header --}}
          <div class="flex items-start justify-between p-5 border-b border-gray-200 dark:border-neutral-700">
            <div>
              <h3 class="text-lg font-bold text-gray-900 dark:text-neutral-100">
                Confirmar cambio de estatus
              </h3>
              <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
                Esta acción actualizará el estatus del alumno.
              </p>
            </div>
            <button id="closeStatusModal"
              class="ml-3 inline-flex items-center justify-center rounded-full p-2
                text-gray-500 hover:text-gray-800 hover:bg-gray-100
                dark:text-neutral-400 dark:hover:text-neutral-100 dark:hover:bg-neutral-800">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>

          {{-- Body --}}
          <div class="p-5 space-y-4">
            <div class="flex items-center gap-2">
              {{-- Chip actual --}}
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium
                {{ $estatus === 'Activo'
                  ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200'
                  : 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200' }}">
                Estatus actual: {{ $estatus }}
              </span>

              {{-- Flecha --}}
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M10.293 15.707a1 1 0 010-1.414L13.586 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 111.414-1.414l5 5c.39.39.39 1.024 0 1.414l-5 5a1 1 0 01-1.414 0z"
                  clip-rule="evenodd" />
              </svg>

              {{-- Chip nuevo --}}
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium
                {{ $isGoingToBaja
                  ? 'bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200'
                  : 'bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-200' }}">
                Nuevo: {{ $nextStatus }}
              </span>
            </div>

            {{-- Mensaje según acción --}}
            @if ($isGoingToBaja)
              <div class="rounded-xl border p-3 text-sm
                bg-red-50 border-red-200 text-red-700
                dark:bg-red-950/50 dark:border-red-900 dark:text-red-200">
                Se marcará al alumno como <strong>BAJA</strong>. Podrás revertirlo más tarde.
              </div>
            @else
              <div class="rounded-xl border p-3 text-sm
                bg-emerald-50 border-emerald-200 text-emerald-700
                dark:bg-emerald-950/50 dark:border-emerald-900 dark:text-emerald-200">
                El alumno volverá a estar <strong>ACTIVO</strong>.
              </div>
            @endif
          </div>

          {{-- Footer --}}
          <div class="px-5 pb-5 flex items-center justify-end gap-3">
            <button id="cancelStatusModal"
              class="px-4 py-2 text-sm font-medium rounded-lg border
                bg-white text-gray-700 hover:bg-gray-50
                dark:bg-neutral-900 dark:text-neutral-200 dark:border-neutral-700 dark:hover:bg-neutral-800">
              Cancelar
            </button>

            <form method="POST" action="{{ route('alumnos.updateStatus', $alumno->pk_alumno) }}">
              @csrf
              @method('PATCH')
              <input type="hidden" name="estatus" value="{{ $nextStatus }}">
              <button type="submit"
                class="px-4 py-2 text-sm font-medium rounded-lg shadow-sm border
                  focus:outline-none focus:ring-2 focus:ring-offset-2
                  {{ $isGoingToBaja
                    ? 'text-white bg-red-600 hover:bg-red-700 border-red-700 focus:ring-red-500 dark:focus:ring-offset-0'
                    : 'text-white bg-emerald-600 hover:bg-emerald-700 border-emerald-700 focus:ring-emerald-500 dark:focus:ring-offset-0' }}">
                Confirmar cambio
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- Modal: Nueva Observación --}}
    <div id="obsModal" class="fixed inset-0 z-[80] hidden">
      {{-- Overlay --}}
      <div id="obsOverlay" class="absolute inset-0 bg-black/50 backdrop-blur-[2px]"></div>

      {{-- Dialog --}}
      <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="w-full max-w-lg rounded-2xl border shadow-2xl
          bg-white dark:bg-neutral-900
          border-gray-200 dark:border-neutral-700">

          {{-- Header --}}
          <div class="flex items-start justify-between p-5 border-b border-gray-200 dark:border-neutral-700">
            <div>
              <h3 class="text-lg font-bold text-gray-900 dark:text-neutral-100">
                Nueva observación
              </h3>
              <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
                Registra una nota para el seguimiento del tutorado.
              </p>
            </div>
            <button id="closeObsModal"
              class="ml-3 inline-flex items-center justify-center rounded-full p-2
                text-gray-500 hover:text-gray-800 hover:bg-gray-100
                dark:text-neutral-400 dark:hover:text-neutral-100 dark:hover:bg-neutral-800">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>

          {{-- Body (Form) --}}
          <form method="POST" action="{{ route('observaciones.store', $alumno->pk_alumno) }}">
            @csrf
            <div class="p-5 space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Título</label>
                <input type="text" name="nombre" required maxlength="150"
                  class="mt-1 w-full rounded-lg border-gray-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-100 focus:ring-teal-500 focus:border-teal-500"
                  placeholder="Ej. Seguimiento académico" />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Observación</label>
                <textarea name="observacion" required rows="5"
                  class="mt-1 w-full rounded-lg border-gray-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-100 focus:ring-teal-500 focus:border-teal-500"
                  placeholder="Escribe los detalles..."></textarea>
              </div>
            </div>

            {{-- Footer --}}
            <div class="px-5 pb-5 flex items-center justify-end gap-3">
              <button type="button" id="cancelObsModal"
                class="px-4 py-2 text-sm font-medium rounded-lg border
                  bg-white text-gray-700 hover:bg-gray-50
                  dark:bg-neutral-900 dark:text-neutral-200 dark:border-neutral-700 dark:hover:bg-neutral-800">
                Cancelar
              </button>
              <button type="submit"
                class="px-4 py-2 text-sm font-medium rounded-lg shadow-sm border
                  text-white bg-[#2B8A7F] hover:bg-teal-700 border-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 dark:focus:ring-offset-0">
                Guardar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- NUEVO: Modal Eliminar Observación --}}
    <div id="deleteObsModal" class="fixed inset-0 z-[80] hidden">
      {{-- Overlay --}}
      <div id="deleteObsOverlay" class="absolute inset-0 bg-black/50 backdrop-blur-[2px]"></div>

      {{-- Dialog --}}
      <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="w-full max-w-md rounded-2xl border shadow-2xl
          bg-white dark:bg-neutral-900
          border-gray-200 dark:border-neutral-700">

          {{-- Header --}}
          <div class="flex items-start justify-between p-5 border-b border-gray-200 dark:border-neutral-700">
            <div>
              <h3 class="text-lg font-bold text-gray-900 dark:text-neutral-100">
                Confirmar Eliminación
              </h3>
              <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
                Esta acción no se puede deshacer.
              </p>
            </div>
            <button id="closeDeleteObsModal"
              class="ml-3 inline-flex items-center justify-center rounded-full p-2
                text-gray-500 hover:text-gray-800 hover:bg-gray-100
                dark:text-neutral-400 dark:hover:text-neutral-100 dark:hover:bg-neutral-800">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>

          {{-- Body --}}
          <div class="p-5">
            <div class="rounded-xl border p-3 text-sm
              bg-red-50 border-red-200 text-red-700
              dark:bg-red-950/50 dark:border-red-900 dark:text-red-200">
              ¿Seguro que quieres eliminar la observación:
              <strong id="deleteObsNombre" class="block mt-1"></strong>
            </div>
          </div>

          {{-- Footer --}}
          <div class="px-5 pb-5 flex items-center justify-end gap-3">
            <button id="cancelDeleteObsModal"
              type="button"
              class="px-4 py-2 text-sm font-medium rounded-lg border
                bg-white text-gray-700 hover:bg-gray-50
                dark:bg-neutral-900 dark:text-neutral-200 dark:border-neutral-700 dark:hover:bg-neutral-800">
              Cancelar
            </button>

            {{-- El formulario de eliminación está aquí dentro --}}
            <form method="POST" action="" id="deleteObsForm">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="px-4 py-2 text-sm font-medium rounded-lg shadow-sm border
                  text-white bg-red-600 hover:bg-red-700 border-red-700 
                  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-0">
                Sí, Eliminar
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

  {{-- Script consolidado para TRES modales --}}
  <script>
    (function () {
      // ---- Modal Estatus ----
      const statusModal = document.getElementById('statusModal');
      const openStatus  = document.getElementById('openStatusModal');
      const overlayStatus = document.getElementById('statusOverlay');
      const closeStatus = document.getElementById('closeStatusModal');
      const cancelStatus = document.getElementById('cancelStatusModal');

      const openStatusFn  = () => statusModal && statusModal.classList.remove('hidden');
      const closeStatusFn = () => statusModal && statusModal.classList.add('hidden');

      if (openStatus)   openStatus.addEventListener('click', openStatusFn);
      if (overlayStatus) overlayStatus.addEventListener('click', closeStatusFn);
      if (closeStatus)  closeStatus.addEventListener('click', closeStatusFn);
      if (cancelStatus) cancelStatus.addEventListener('click', closeStatusFn);

      // ---- Modal Observación (Crear) ----
      const obsModal    = document.getElementById('obsModal');
      const openObs     = document.getElementById('openObsModal');
      const obsOverlay  = document.getElementById('obsOverlay');
      const closeObs    = document.getElementById('closeObsModal');
      const cancelObs   = document.getElementById('cancelObsModal');

      const openObsFn   = () => obsModal && obsModal.classList.remove('hidden');
      const closeObsFn  = () => obsModal && obsModal.classList.add('hidden');

      if (openObs)    openObs.addEventListener('click', openObsFn);
      if (obsOverlay) obsOverlay.addEventListener('click', closeObsFn);
      if (closeObs)   closeObs.addEventListener('click', closeObsFn);
      if (cancelObs)  cancelObs.addEventListener('click', closeObsFn);

      // ---- Modal Observación (Eliminar) ----
      const deleteObsModal       = document.getElementById('deleteObsModal');
      const deleteObsOverlay     = document.getElementById('deleteObsOverlay');
      const closeDeleteObsModal  = document.getElementById('closeDeleteObsModal');
      const cancelDeleteObsModal = document.getElementById('cancelDeleteObsModal');
      const deleteObsForm        = document.getElementById('deleteObsForm'); // El formulario
      const deleteObsNombre      = document.getElementById('deleteObsNombre'); // El texto
      const openDeleteObsButtons = document.querySelectorAll('.openDeleteObsModal'); // Los botones de trigger

      const openDeleteObsFn  = () => deleteObsModal && deleteObsModal.classList.remove('hidden');
      const closeDeleteObsFn = () => deleteObsModal && deleteObsModal.classList.add('hidden');

      // Listeners para CERRAR el modal de eliminar
      if (deleteObsOverlay) deleteObsOverlay.addEventListener('click', closeDeleteObsFn);
      if (closeDeleteObsModal) closeDeleteObsModal.addEventListener('click', closeDeleteObsFn);
      if (cancelDeleteObsModal) cancelDeleteObsModal.addEventListener('click', closeDeleteObsFn);

      // Listeners para ABRIR el modal de eliminar (configurándolo primero)
      if (openDeleteObsButtons.length) {
        openDeleteObsButtons.forEach(button => {
          button.addEventListener('click', (e) => {
            e.preventDefault();
            // Obtener datos del botón
            const url = button.dataset.actionUrl;
            const nombre = button.dataset.obsNombre;
            
            // Poner los datos en el modal
            if (deleteObsForm) {
              deleteObsForm.setAttribute('action', url);
            }
            if (deleteObsNombre) {
              deleteObsNombre.textContent = `"${nombre}"`;
            }
            
            // Abrir el modal
            openDeleteObsFn();
          });
        });
      }

      // ---- Cerrar con ESC (un solo listener para TODOS los modales) ----
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
          closeStatusFn();
          closeObsFn();
          closeDeleteObsFn(); // Añadido
        }
      });
    })();
  </script>
</x-layouts.app>