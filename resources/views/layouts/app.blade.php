<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Sistema de Tutorías')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- 
        ¡IMPORTANTE! Carga los assets de Vite (CSS y JS principal) aquí.
    --}}
    @vite(['resources/css/app.css', 'resources/js/app.js']) 

    {{-- ========================================================== --}}
    {{-- AÑADIDO: SweetAlert2 CSS (en el head) --}}
    {{-- ========================================================== --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    {{-- AHORA SÍ: 'defer' está añadido al script --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="bg-gray-50">

    @yield('content')

    {{-- ========================================================== --}}
    {{-- AÑADIDO: SweetAlert2 JS (antes del @stack) --}}
    {{-- Esto hace que el comando 'Swal.fire()' esté disponible. --}}
    {{-- ========================================================== --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    {{-- 
        El @stack('scripts') debe ir DESPUÉS de cargar tu app.js principal y Swal.
    --}}
    @stack('scripts') 
</body>
</html>