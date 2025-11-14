<x-layouts.app.sidebar :title="$title ?? null">
    <head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head>
    <flux:main>
        {{ $slot }}
        @if (session('status'))
            <script>
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ session('status') }}', // Toma el texto del controlador
                    icon: 'success',
                    confirmButtonColor: '#2B8A7F', // Opcional: tu color verde
                    confirmButtonText: 'Aceptar'
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    title: 'Error',
                    text: '{{ session('error') }}', // Toma el texto del controlador
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Aceptar'
                });
            </script>
        @endif
    </flux:main>

</x-layouts.app.sidebar>