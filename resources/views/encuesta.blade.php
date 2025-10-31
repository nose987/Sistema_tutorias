<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrevista Individual de Tutorías</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .section-content {
            display: none;
        }
        .section-content.active {
            display: block;
        }
        .tab-button.active {
            background-color: #2B8A7F;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-[#192734] text-white py-6 px-4">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center gap-3 mb-2">
                <div class="bg-white rounded-lg p-2">
                    <svg class="w-8 h-8 text-slate-800" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Entrevista individual de tutorías</h1>
                    <p class="text-sm text-gray-300">Código: UTESC-PIT-TUT-ENTREVISTA</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Progress Bar -->
    <div class="bg-white border-b">
        <div class="max-w-5xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-medium text-gray-700">Sección <span id="current-section">1</span> de 7</span>
                <span class="text-sm font-medium text-[#2B8A7F]"><span id="progress-percent">0</span>% completado</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="progress-bar" class="bg-[#2B8A7F] h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="bg-white border-b sticky top-0 z-10 shadow-sm">
        <div class="max-w-5xl mx-auto px-4">
            <div class="flex gap-2 overflow-x-auto py-3">
                <button onclick="showSection(1)" class="tab-button active flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap bg-[#2B8A7F] text-white transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    Datos personales
                </button>
                <button onclick="showSection(2)" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg>
                    Historial médico
                </button>
                <button onclick="showSection(3)" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                    Antecedentes escolares
                </button>
                <button onclick="showSection(4)" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/></svg>
                    Potencial de aprendizaje
                </button>
                <button onclick="showSection(5)" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                    Sociabilidad
                </button>
                <button onclick="showSection(6)" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/></svg>
                    Personalidad
                </button>
                <button onclick="showSection(7)" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                    Información extra
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-700" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form id="interview-form" action="{{ route('encuesta.store') }}" method="POST" class="bg-white rounded-lg shadow-sm p-8">
            @csrf
            
            <!-- Section 1: Datos Personales -->
            <div id="section-1" class="section-content active">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Datos personales</h2>
                
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre(s)</label>
                            <input type="text" name="nombre" placeholder="Ingresa tu nombre" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Apellido Paterno</label>
                            <input type="text" name="apellido_paterno" placeholder="Ingresa tu apellido paterno" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Apellido Materno</label>
                            <input type="text" name="apellido_materno" placeholder="Ingresa tu apellido materno" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Carrera</label>
                            <select name="carrera" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                                <option value="">Selecciona una carrera</option>
                                <option value="Desarrollo y gestión de software">Desarrollo y gestión de software</option>
                                <option value="Mecatrónica">Mecatrónica</option>
                                <option value="Contaduría">Contaduría</option>
                                <option value="Agricultura">Agricultura</option>
                                <option value="Enfermería">Enfermería</option>
                                <option value="Gastronomía">Gastronomía</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                                <option value="Alimentos">Alimentos</option>
                                <option value="Turismo">Turismo</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cuatrimestre</label>
                            <select name="cuatrimestre" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                                <option value="">Selecciona</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Grupo</label>
                            <select name="fk_grupo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                                <option value="">Selecciona</option>
                                <!-- This should be populated from the database -->
                                <option value="1">A</option> 
                                <option value="2">B</option>
                                <option value="3">C</option>
                                <option value="4">D</option>
                                <option value="5">E</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dirección</label>
                        <textarea name="direccion" rows="2" placeholder="Calle, número, colonia, ciudad" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                            <input type="tel" name="telefono" placeholder="000 000 0000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Celular</label>
                            <input type="tel" name="celular" placeholder="000 000 0000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del padre</label>
                        <input type="text" name="nombre_padre" placeholder="Nombre completo del padre" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Edad del padre</label>
                            <input type="number" name="padre_edad" placeholder="Ej. 45" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profesión del padre</label>
                            <input type="text" name="padre_profesion" placeholder="Ej. Agricultor" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre de la madre</label>
                        <input type="text" name="nombre_madre" placeholder="Nombre completo de la madre" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Edad de la madre</label>
                            <input type="number" name="madre_edad" placeholder="Ej. 45" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profesión de la madre</label>
                            <input type="text" name="madre_profesion" placeholder="Ej. Agricultor" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hermanos (edad y ocupación)</label>
                        <textarea name="hermanos_info" rows="3" placeholder="Ej. Juan, 22 años, estudiante" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">¿Tienes hijos?</label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="tiene_hijos" value="1" class="mr-2">
                                    <span>Sí</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="tiene_hijos" value="0" class="mr-2" checked>
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">¿Trabajas?</label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" name="trabaja" value="1" class="mr-2">
                                    <span>Sí</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="trabaja" value="0" class="mr-2" checked>
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Recibes apoyo económico de algún familiar?</label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="recibe_apoyo_familiar" value="1" class="mr-2">
                                <span>Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="recibe_apoyo_familiar" value="0" class="mr-2" checked>
                                <span>No</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Eres beneficiario(a) de alguna beca?</label>
                        <div class="flex gap-4 mb-4">
                            <label class="flex items-center">
                                <input type="radio" name="tiene_beca" value="1" class="mr-2">
                                <span>Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="tiene_beca" value="0" class="mr-2" checked>
                                <span>No</span>
                            </label>
                        </div>
                        <input type="text" name="tipo_beca" placeholder="Tipo de beca" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Contacto en caso de emergencia</label>
                        <input type="text" name="contacto_emergencia_nombre" placeholder="Nombre completo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent mb-4" required>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input type="tel" name="contacto_emergencia_telefono" placeholder="Teléfono" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                            <input type="tel" name="contacto_emergencia_celular" placeholder="Celular" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Historial Médico -->
            <div id="section-2" class="section-content">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Historial médico</h2>
                
                <p class="text-gray-700 mb-6">¿Cuáles de los siguientes problemas de salud has tenido?</p>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-700">Condición</th>
                                <th class="border border-gray-300 px-4 py-3 text-center text-sm font-semibold text-gray-700">Sí</th>
                                <th class="border border-gray-300 px-4 py-3 text-center text-sm font-semibold text-gray-700">No</th>
                                <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-700">Especifica</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 px-4 py-3">a) Alergia</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_alergia" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_alergia" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="alergias" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border border-gray-300 px-4 py-3">b) Asma</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_asma" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_asma" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="asma_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-3">c) Cáncer</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_cancer" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_cancer" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="cancer_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border border-gray-300 px-4 py-3">d) Diabetes</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_diabetes" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_diabetes" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="diabetes_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-3">e) Epilepsia</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_epilepsia" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_epilepsia" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="epilepsia_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border border-gray-300 px-4 py-3">f) Gripa o tos más de 3 veces al año</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_gripa_tos_frecuente" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_gripa_tos_frecuente" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="gripa_tos_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-3">g) Leucemia</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_leucemia" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_leucemia" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="leucemia_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border border-gray-300 px-4 py-3">h) Migraña</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_migrana" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_migrana" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="migrana_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-3">i) Anorexia</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_anorexia" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_anorexia" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="anorexia_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border border-gray-300 px-4 py-3">j) Bulimia</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_bulimia" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_bulimia" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="bulimia_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-3">k) Crisis de ansiedad o pánico</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_crisis_ansiedad" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_crisis_ansiedad" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="crisis_ansiedad_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border border-gray-300 px-4 py-3">l) Afección en el corazón</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_afeccion_corazon" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_afeccion_corazon" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="afeccion_corazon_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-3">m) Depresión</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_depresion" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_depresion" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="depresion_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border border-gray-300 px-4 py-3">ñ) Otro (requiere atención especial)</td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_otro_salud" value="1">
                                </td>
                                <td class="border border-gray-300 px-4 py-3 text-center">
                                    <input type="radio" name="check_otro_salud" value="0" checked>
                                </td>
                                <td class="border border-gray-300 px-4 py-3">
                                    <input type="text" name="otro_salud_especifica" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section 3: Antecedentes Escolares -->
            <div id="section-3" class="section-content">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Antecedentes escolares</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Institución en la que cursó Preparatoria</label>
                        <input type="text" name="institucion_preparatoria" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ciclo</label>
                        <input type="text" name="ciclo_preparatoria" placeholder="Ej. 2018-2021" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Habías estado estudiando en otra universidad anteriormente?</label>
                        <div class="flex gap-4 mb-4">
                            <label class="flex items-center">
                                <input type="radio" name="estudio_universidad_anterior" value="1" class="mr-2" required>
                                <span>Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="estudio_universidad_anterior" value="0" class="mr-2" checked required>
                                <span>No</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Qué universidad y carrera?</label>
                        <input type="text" name="universidad_anterior_carrera" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Hace cuánto tiempo?</label>
                        <input type="text" name="universidad_anterior_tiempo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cuál fue el motivo por el que ya no seguiste estudiando ahí?</label>
                        <textarea name="universidad_anterior_motivo_salida" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cómo te ha ido en los cuatrimestres anteriores?</label>
                        <textarea name="rendimiento_cuatris_anteriores" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Has perdido algún cuatrimestre? ¿Cuál fue la causa? Si fue por reprobación, ¿por qué materia fue?</label>
                        <textarea name="perdio_cuatrimestre_causa" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cómo te va este cuatrimestre?</label>
                        <textarea name="rendimiento_cuatri_actual" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Has necesitado apoyo extra en alguna clase? ¿Cuál?</label>
                        <input type="text" name="necesita_apoyo_extra" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Cuando apruebas una asignatura crees que se debe:</label>
                        <div class="space-y-2 ml-4">
                            <label class="flex items-center">
                                <input type="radio" name="atribucion_aprobacion" value="esfuerzo" class="mr-2">
                                <span>Tu esfuerzo</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="atribucion_aprobacion" value="suerte" class="mr-2">
                                <span>Buena suerte</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="atribucion_aprobacion" value="habilidad" class="mr-2">
                                <span>Lo bueno que eres</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Cuando suspendes una asignatura crees que se debe:</label>
                        <div class="space-y-2 ml-4">
                            <label class="flex items-center">
                                <input type="radio" name="atribucion_suspension" value="falta_esfuerzo" class="mr-2">
                                <span>Falta de esfuerzo</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="atribucion_suspension" value="mala_suerte" class="mr-2">
                                <span>Mala suerte</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="atribucion_suspension" value="dificultad" class="mr-2">
                                <span>Se te dan mal</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 4: Potencial de Aprendizaje -->
            <div id="section-4" class="section-content">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Potencial de aprendizaje</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Qué aspectos consideras que propician y dificultan tu aprendizaje?</label>
                        <textarea name="aspectos_propician_y_dificultan_aprendizaje" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cuáles son tus razones para estudiar?</label>
                        <textarea name="razones_para_estudiar" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Crees que en tu clase hay un clima que permite aprender? Especifica</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center">
                                <input type="radio" name="clima_clase_permite_aprender" value="1" class="mr-2" required>
                                <span>Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="clima_clase_permite_aprender" value="0" class="mr-2" checked required>
                                <span>No</span>
                            </label>
                        </div>
                        <textarea name="clima_clase_especifica" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Estás contento/a con tus profesores en general?</label>
                         <div class="flex gap-4 mb-2">
                            <label class="flex items-center">
                                <input type="radio" name="contento_profesores_general" value="1" class="mr-2" required>
                                <span>Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="contento_profesores_general" value="0" class="mr-2" checked required>
                                <span>No</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Qué piensan en tu casa de que estés estudiando en la universidad?</label>
                        <textarea name="opinion_familia_estudios" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Tus padres te apoyan para seguir estudiando?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center">
                                <input type="radio" name="apoyo_padres_estudiar" value="1" class="mr-2" required>
                                <span>Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="apoyo_padres_estudiar" value="0" class="mr-2" checked required>
                                <span>No</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Asistes a alguna actividad paraescolar? ¿Cuál?</label>
                        <input type="text" name="actividad_paraescolar_cual" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required>
                    </div>
                </div>
            </div>

            <!-- Section 5: Sociabilidad -->
            <div id="section-5" class="section-content">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Sociabilidad</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Qué tal te llevas con tus padres?</label>
                        <textarea name="relacion_padres" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Y con tus hermanos?</label>
                        <textarea name="relacion_hermanos" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Te gusta pasar tiempo con la familia?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center">
                                <input type="radio" name="gusta_tiempo_familia" value="1" class="mr-2" required>
                                <span>Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="gusta_tiempo_familia" value="0" class="mr-2" checked required>
                                <span>No</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Te sientes a gusto en casa?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center">
                                <input type="radio" name="agusto_en_casa" value="1" class="mr-2" required>
                                <span>Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="agusto_en_casa" value="0" class="mr-2" checked required>
                                <span>No</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Te sientes comprendido por tus padres y hermanos?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center">
                                <input type="radio" name="comprendido_familia" value="1" class="mr-2" required>
                                <span>Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="comprendido_familia" value="0" class="mr-2" checked required>
                                <span>No</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Tienes buenos amigos?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center">
                                <input type="radio" name="tiene_buenos_amigos" value="1" class="mr-2" required>
                                <span>Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="tiene_buenos_amigos" value="0" class="mr-2" checked required>
                                <span>No</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Confías en ellos? ¿Qué es lo que te hace confiar o no en ellos?</label>
                        <textarea name="confia_amigos_detalle" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Pasas mucho tiempo con ellos o prefieres pasar más tiempo sólo?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center">
                                <input type="radio" name="preferencia_tiempo_libre" value="amigos" class="mr-2" required>
                                <span>Con amigos</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="preferencia_tiempo_libre" value="solo" class="mr-2" required>
                                <span>Solo</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Qué es lo que más te preocupa de tu relación con los amigos?</label>
                        <textarea name="preocupacion_amigos" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Te encuentras a gusto con tus compañeros de clase?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center">
                                <input type="radio" name="agusto_companeros_clase" value="1" class="mr-2" required>
                                <span>Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="agusto_companeros_clase" value="0" class="mr-2" checked required>
                                <span>No</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Crees que estás integrado/a? ¿Por qué?</label>
                        <textarea name="integrado_clase_porque" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Crees que se conocen y respetan las normas de funcionamiento de la clase? Especifica</label>
                        <textarea name="normas_clase_respetan_detalle" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Hay alguien con quien te lleves mal? ¿Cuál crees que sea el motivo?</label>
                        <textarea name="enemistad_clase_motivo" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>
                </div>
            </div>

            <!-- Section 6: Personalidad -->
            <div id="section-6" class="section-content">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Personalidad</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cómo te describirías a ti mismo/a?</label>
                        <textarea name="autodescripcion" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cómo crees que te ven los demás?</label>
                        <textarea name="como_lo_ven_demas" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Qué es lo que más te gusta de ti?</label>
                        <textarea name="gusta_mas_de_si" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Y lo que menos te gusta de ti?</label>
                        <textarea name="gusta_menos_de_si" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Estás contento/a con tu forma de ser y con tu físico?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center">
                                <input type="radio" name="contento_ser_fisico" value="1" class="mr-2" required>
                                <span>Sí</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="contento_ser_fisico" value="0" class="mr-2" checked required>
                                <span>No</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cambiarías algo de tu forma de ser o de tu físico?</label>
                        <textarea name="cambiaria_algo_ser_fisico" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>
                </div>
            </div>

            <!-- Section 7: Información Extra -->
            <div id="section-7" class="section-content">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Información extra</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Hay alguna situación que quisieras comentar que consideras está afectando tu desempeño escolar?</label>
                        <textarea name="datos_adicionales" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent" required></textarea>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-8 pt-6 border-t">
                <button type="button" id="prev-btn" onclick="previousSection()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    Anterior
                </button>
                <button type="button" id="next-btn" onclick="nextSection()" class="px-6 py-2 bg-[#2B8A7F] text-white rounded-lg font-medium hover:bg-emerald-900 transition-colors">
                    Siguiente
                </button>
                <button type="submit" id="submit-btn" class="hidden px-6 py-2 bg-[#2B8A7F] text-white rounded-lg font-medium hover:bg-emerald-900 transition-colors">
                    Enviar entrevista
                </button>
            </div>
        </form>
    </main>

    <script>
        let currentSection = 1;
        const totalSections = 7;

        function showSection(sectionNumber) {
            // Hide all sections
            document.querySelectorAll('.section-content').forEach(section => {
                section.classList.remove('active');
            });

            // Show selected section
            document.getElementById(`section-${sectionNumber}`).classList.add('active');

            // Update tab buttons
            document.querySelectorAll('.tab-button').forEach((btn, index) => {
                if (index + 1 === sectionNumber) {
                    btn.classList.add('active');
                    btn.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                    btn.classList.add('bg-[#2B8A7F]', 'text-white');
                } else {
                    btn.classList.remove('active');
                    btn.classList.remove('bg-[#2B8A7F]', 'text-white');
                    btn.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                }
            });

            currentSection = sectionNumber;
            updateProgress();
            updateNavigationButtons();
        }

        function nextSection() {
            const currentSectionElement = document.getElementById(`section-${currentSection}`);
            const inputs = currentSectionElement.querySelectorAll('input[required], select[required], textarea[required]');
            let allValid = true;

            for (const input of inputs) {
                if (!input.checkValidity()) {
                    // Use the form to report validity, which will show the browser's validation message on the specific invalid input.
                    document.getElementById('interview-form').reportValidity();
                    allValid = false;
                    break; // Stop on the first invalid input
                }
            }

            if (allValid && currentSection < totalSections) {
                showSection(currentSection + 1);
            }
        }

        function previousSection() {
            if (currentSection > 1) {
                showSection(currentSection - 1);
            }
        }

        function updateProgress() {
            const progress = ((currentSection - 1) / (totalSections - 1)) * 100;
            document.getElementById('progress-bar').style.width = `${progress}%`;
            document.getElementById('progress-percent').textContent = Math.round(progress);
            document.getElementById('current-section').textContent = currentSection;
        }

        function updateNavigationButtons() {
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');

            // Update previous button
            prevBtn.disabled = currentSection === 1;

            // Show/hide next and submit buttons
            if (currentSection === totalSections) {
                nextBtn.classList.add('hidden');
                submitBtn.classList.remove('hidden');
            } else {
                nextBtn.classList.remove('hidden');
                submitBtn.classList.add('hidden');
            }
        }

        // Form submission
        document.getElementById('interview-form').addEventListener('submit', function(e) {
            // Allow the form to submit to the server
        });

        // Initialize
        updateProgress();
        updateNavigationButtons();
    </script>
</body>
</html>
