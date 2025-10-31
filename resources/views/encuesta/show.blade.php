<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Entrevista Individual de Tutorías</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .section-content { display: none; }
        .section-content.active { display: block; }
        .tab-button.active { background-color: #2B8A7F; color: white; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <header class="bg-[#192734] text-white py-6 px-4">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center gap-3 mb-2">
                <div class="bg-white rounded-lg p-2">
                    <svg class="w-8 h-8 text-slate-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Editar Entrevista Individual de Tutorías</h1>
                    <p class="text-sm text-gray-300">Código: UTESC-PIT-TUT-ENTREVISTA</p>
                </div>
            </div>
        </div>
    </header>

    <div class="bg-white border-b sticky top-0 z-10 shadow-sm">
        <div class="max-w-5xl mx-auto px-4">
            <div class="flex gap-2 overflow-x-auto py-3">
                <button type="button" onclick="showSection(1)" class="tab-button active flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap">Datos personales</button>
                <button type="button" onclick="showSection(2)" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap">Historial médico</button>
                <button type="button" onclick="showSection(3)" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap">Antecedentes escolares</button>
                <button type="button" onclick="showSection(4)" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap">Potencial de aprendizaje</button>
                <button type="button" onclick="showSection(5)" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap">Sociabilidad</button>
                <button type="button" onclick="showSection(6)" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap">Personalidad</button>
                <button type="button" onclick="showSection(7)" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap">Información extra</button>
            </div>
        </div>
    </div>

    <main class="max-w-5xl mx-auto px-4 py-8">
        <form id="interview-form" action="{{ route('encuesta.update', $alumno->pk_alumno) }}" method="POST" class="bg-white rounded-lg shadow-sm p-8">
            @csrf
            @method('PUT')

            <!-- Section 1: Datos Personales -->
            <div id="section-1" class="section-content active">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Datos personales</h2>
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre(s)</label>
                            <input type="text" name="nombre" value="{{ $alumno->nombre }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Apellido Paterno</label>
                            <input type="text" name="apellido_paterno" value="{{ $alumno->apellido_paterno }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Apellido Materno</label>
                            <input type="text" name="apellido_materno" value="{{ $alumno->apellido_materno }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" value="{{ $alumno->fecha_nacimiento }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Carrera</label>
                            <select name="carrera" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                                <option value="">Selecciona una carrera</option>
                                <option value="Desarrollo y gestión de software" @if($alumno->carrera == 'Desarrollo y gestión de software') selected @endif>Desarrollo y gestión de software</option>
                                <option value="Mecatrónica" @if($alumno->carrera == 'Mecatrónica') selected @endif>Mecatrónica</option>
                                <option value="Contaduría" @if($alumno->carrera == 'Contaduría') selected @endif>Contaduría</option>
                                <option value="Agricultura" @if($alumno->carrera == 'Agricultura') selected @endif>Agricultura</option>
                                <option value="Enfermería" @if($alumno->carrera == 'Enfermería') selected @endif>Enfermería</option>
                                <option value="Gastronomía" @if($alumno->carrera == 'Gastronomía') selected @endif>Gastronomía</option>
                                <option value="Mantenimiento" @if($alumno->carrera == 'Mantenimiento') selected @endif>Mantenimiento</option>
                                <option value="Alimentos" @if($alumno->carrera == 'Alimentos') selected @endif>Alimentos</option>
                                <option value="Turismo" @if($alumno->carrera == 'Turismo') selected @endif>Turismo</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dirección</label>
                        <textarea name="direccion" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $alumno->direccion }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                            <input type="tel" name="telefono" value="{{ $alumno->telefono }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Celular</label>
                            <input type="tel" name="celular" value="{{ $alumno->celular }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del padre</label>
                        <input type="text" name="nombre_padre" value="{{ $alumno->nombre_padre }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Edad del padre</label>
                            <input type="number" name="padre_edad" value="{{ $alumno->padre_edad }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profesión del padre</label>
                            <input type="text" name="padre_profesion" value="{{ $alumno->padre_profesion }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre de la madre</label>
                        <input type="text" name="nombre_madre" value="{{ $alumno->nombre_madre }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Edad de la madre</label>
                            <input type="number" name="madre_edad" value="{{ $alumno->madre_edad }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profesión de la madre</label>
                            <input type="text" name="madre_profesion" value="{{ $alumno->madre_profesion }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hermanos (edad y ocupación)</label>
                        <textarea name="hermanos_info" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $alumno->hermanos_info }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">¿Tienes hijos?</label>
                            <div class="flex gap-4">
                                <label class="flex items-center"><input type="radio" name="tiene_hijos" value="1" @if($alumno->tiene_hijos) checked @endif> Sí</label>
                                <label class="flex items-center"><input type="radio" name="tiene_hijos" value="0" @if(!$alumno->tiene_hijos) checked @endif> No</label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">¿Trabajas?</label>
                            <div class="flex gap-4">
                                <label class="flex items-center"><input type="radio" name="trabaja" value="1" @if($alumno->trabaja) checked @endif> Sí</label>
                                <label class="flex items-center"><input type="radio" name="trabaja" value="0" @if(!$alumno->trabaja) checked @endif> No</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Recibes apoyo económico de algún familiar?</label>
                        <div class="flex gap-4">
                            <label class="flex items-center"><input type="radio" name="recibe_apoyo_familiar" value="1" @if($alumno->recibe_apoyo_familiar) checked @endif> Sí</label>
                            <label class="flex items-center"><input type="radio" name="recibe_apoyo_familiar" value="0" @if(!$alumno->recibe_apoyo_familiar) checked @endif> No</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Eres beneficiario(a) de alguna beca?</label>
                        <div class="flex gap-4 mb-4">
                            <label class="flex items-center"><input type="radio" name="tiene_beca" value="1" @if($alumno->tiene_beca) checked @endif> Sí</label>
                            <label class="flex items-center"><input type="radio" name="tiene_beca" value="0" @if(!$alumno->tiene_beca) checked @endif> No</label>
                        </div>
                        <input type="text" name="tipo_beca" value="{{ $alumno->tipo_beca }}" placeholder="Tipo de beca" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Contacto en caso de emergencia</label>
                        <input type="text" name="contacto_emergencia_nombre" value="{{ $alumno->contacto_emergencia_nombre }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input type="tel" name="contacto_emergencia_telefono" value="{{ $alumno->contacto_emergencia_telefono }}" placeholder="Teléfono" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                            <input type="tel" name="contacto_emergencia_celular" value="{{ $alumno->contacto_emergencia_celular }}" placeholder="Celular" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Historial Médico -->
            <div id="section-2" class="section-content">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Historial médico</h2>
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
                            @php $historial = $alumno->historialMedico; @endphp
                            <tr>
                                <td class="border border-gray-300 px-4 py-3">Alergia</td>
                                <td class="border border-gray-300 px-4 py-3 text-center"><input type="radio" name="check_alergia" value="1" @if($historial->check_alergia) checked @endif></td>
                                <td class="border border-gray-300 px-4 py-3 text-center"><input type="radio" name="check_alergia" value="0" @if(!$historial->check_alergia) checked @endif></td>
                                <td class="border border-gray-300 px-4 py-3"><input type="text" name="alergias" value="{{ $historial->alergias }}" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent"></td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-3">Gripa o tos frecuente</td>
                                <td class="border border-gray-300 px-4 py-3 text-center"><input type="radio" name="check_gripa_tos_frecuente" value="1" @if($historial->check_gripa_tos_frecuente) checked @endif></td>
                                <td class="border border-gray-300 px-4 py-3 text-center"><input type="radio" name="check_gripa_tos_frecuente" value="0" @if(!$historial->check_gripa_tos_frecuente) checked @endif></td>
                                <td class="border border-gray-300 px-4 py-3"><input type="text" name="gripa_tos_especifica" value="{{ $historial->gripa_tos_especifica }}" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent"></td>
                            </tr>
                            @foreach ([
                                'check_asma' => 'Asma',
                                'check_cancer' => 'Cáncer',
                                'check_diabetes' => 'Diabetes',
                                'check_epilepsia' => 'Epilepsia',
                                'check_leucemia' => 'Leucemia',
                                'check_migrana' => 'Migraña',
                                'check_anorexia' => 'Anorexia',
                                'check_bulimia' => 'Bulimia',
                                'check_crisis_ansiedad' => 'Crisis de ansiedad',
                                'check_afeccion_corazon' => 'Afección en el corazón',
                                'check_depresion' => 'Depresión',
                                'check_otro_salud' => 'Otro',
                            ] as $key => $label)
                            <tr>
                                <td class="border border-gray-300 px-4 py-3">{{ $label }}</td>
                                <td class="border border-gray-300 px-4 py-3 text-center"><input type="radio" name="{{$key}}" value="1" @if($historial->$key) checked @endif></td>
                                <td class="border border-gray-300 px-4 py-3 text-center"><input type="radio" name="{{$key}}" value="0" @if(!$historial->$key) checked @endif></td>
                                <td class="border border-gray-300 px-4 py-3"><input type="text" name="{{ str_replace('check_', '', $key) . '_especifica' }}" value="{{ $historial[str_replace('check_', '', $key) . '_especifica'] }}" class="w-full px-2 py-1 border border-gray-300 rounded focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section 3: Antecedentes Escolares -->
            <div id="section-3" class="section-content">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Antecedentes escolares</h2>
                @php $antecedentes = $alumno->antecedentesEscolares; @endphp
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Institución en la que cursó Preparatoria</label>
                        <input type="text" name="institucion_preparatoria" value="{{ $antecedentes->institucion_preparatoria }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ciclo</label>
                        <input type="text" name="ciclo_preparatoria" value="{{ $antecedentes->ciclo_preparatoria }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Habías estado estudiando en otra universidad anteriormente?</label>
                        <div class="flex gap-4">
                            <label class="flex items-center"><input type="radio" name="estudio_universidad_anterior" value="1" @if($antecedentes->estudio_universidad_anterior) checked @endif> Sí</label>
                            <label class="flex items-center"><input type="radio" name="estudio_universidad_anterior" value="0" @if(!$antecedentes->estudio_universidad_anterior) checked @endif> No</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Qué universidad y carrera?</label>
                        <input type="text" name="universidad_anterior_y_carrera_anterior" value="{{ $antecedentes->universidad_anterior_y_carrera_anterior }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Hace cuánto tiempo?</label>
                        <input type="text" name="universidad_anterior_tiempo" value="{{ $antecedentes->universidad_anterior_tiempo }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cuál fue el motivo por el que ya no seguiste estudiando ahí?</label>
                        <textarea name="universidad_anterior_motivo_salida" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $antecedentes->universidad_anterior_motivo_salida }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cómo te ha ido en los cuatrimestres anteriores?</label>
                        <textarea name="rendimiento_cuatris_anteriores" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $antecedentes->rendimiento_cuatris_anteriores }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Has perdido algún cuatrimestre? ¿Cuál fue la causa? Si fue por reprobación, ¿por qué materia fue?</label>
                        <textarea name="perdio_cuatrimestre_causa" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $antecedentes->perdio_cuatrimestre_causa }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cómo te va este cuatrimestre?</label>
                        <textarea name="rendimiento_cuatri_actual" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $antecedentes->rendimiento_cuatri_actual }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Has necesitado apoyo extra en alguna clase? ¿Cuál?</label>
                        <input type="text" name="necesita_apoyo_extra" value="{{ $antecedentes->necesita_apoyo_extra }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Cuando apruebas una asignatura crees que se debe:</label>
                        <div class="space-y-2 ml-4">
                            <label class="flex items-center"><input type="radio" name="atribucion_aprobacion" value="esfuerzo" @if($antecedentes->atribucion_aprobacion == 'esfuerzo') checked @endif> Tu esfuerzo</label>
                            <label class="flex items-center"><input type="radio" name="atribucion_aprobacion" value="suerte" @if($antecedentes->atribucion_aprobacion == 'suerte') checked @endif> Buena suerte</label>
                            <label class="flex items-center"><input type="radio" name="atribucion_aprobacion" value="habilidad" @if($antecedentes->atribucion_aprobacion == 'habilidad') checked @endif> Lo bueno que eres</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Cuando suspendes una asignatura crees que se debe:</label>
                        <div class="space-y-2 ml-4">
                            <label class="flex items-center"><input type="radio" name="atribucion_suspension" value="falta_esfuerzo" @if($antecedentes->atribucion_suspension == 'falta_esfuerzo') checked @endif> Falta de esfuerzo</label>
                            <label class="flex items-center"><input type="radio" name="atribucion_suspension" value="mala_suerte" @if($antecedentes->atribucion_suspension == 'mala_suerte') checked @endif> Mala suerte</label>
                            <label class="flex items-center"><input type="radio" name="atribucion_suspension" value="dificultad" @if($antecedentes->atribucion_suspension == 'dificultad') checked @endif> Se te dan mal</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 4: Potencial de Aprendizaje -->
            <div id="section-4" class="section-content">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Potencial de aprendizaje</h2>
                @php $potencial = $alumno->potencialAprendizaje; @endphp
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Qué aspectos consideras que propician y dificultan tu aprendizaje?</label>
                        <textarea name="aspectos_propician_y_dificultan_aprendizaje" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $potencial->aspectos_propician_y_dificultan_aprendizaje }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cuáles son tus razones para estudiar?</label>
                        <textarea name="razones_para_estudiar" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $potencial->razones_para_estudiar }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Crees que en tu clase hay un clima que permite aprender? Especifica</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center"><input type="radio" name="clima_clase_permite_aprender" value="1" @if($potencial->clima_clase_permite_aprender) checked @endif> Sí</label>
                            <label class="flex items-center"><input type="radio" name="clima_clase_permite_aprender" value="0" @if(!$potencial->clima_clase_permite_aprender) checked @endif> No</label>
                        </div>
                        <textarea name="clima_clase_especifica" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $potencial->clima_clase_especifica }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Estás contento/a con tus profesores en general?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center"><input type="radio" name="contento_profesores_general" value="1" @if($potencial->contento_profesores_general) checked @endif> Sí</label>
                            <label class="flex items-center"><input type="radio" name="contento_profesores_general" value="0" @if(!$potencial->contento_profesores_general) checked @endif> No</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Qué piensan en tu casa de que estés estudiando en la universidad?</label>
                        <textarea name="opinion_familia_estudios" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $potencial->opinion_familia_estudios }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Tus padres te apoyan para seguir estudiando?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center"><input type="radio" name="apoyo_padres_estudiar" value="1" @if($potencial->apoyo_padres_estudiar) checked @endif> Sí</label>
                            <label class="flex items-center"><input type="radio" name="apoyo_padres_estudiar" value="0" @if(!$potencial->apoyo_padres_estudiar) checked @endif> No</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Asistes a alguna actividad paraescolar? ¿Cuál?</label>
                        <input type="text" name="actividad_paraescolar_cual" value="{{ $potencial->actividad_paraescolar_cual }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Section 5: Sociabilidad -->
            <div id="section-5" class="section-content">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Sociabilidad</h2>
                @php $sociabilidad = $alumno->sociabilidad; @endphp
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Qué tal te llevas con tus padres?</label>
                        <textarea name="relacion_padres" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $sociabilidad->relacion_padres }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Y con tus hermanos?</label>
                        <textarea name="relacion_hermanos" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $sociabilidad->relacion_hermanos }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Te gusta pasar tiempo con la familia?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center"><input type="radio" name="gusta_tiempo_familia" value="1" @if($sociabilidad->gusta_tiempo_familia) checked @endif> Sí</label>
                            <label class="flex items-center"><input type="radio" name="gusta_tiempo_familia" value="0" @if(!$sociabilidad->gusta_tiempo_familia) checked @endif> No</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Te sientes a gusto en casa?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center"><input type="radio" name="agusto_en_casa" value="1" @if($sociabilidad->agusto_en_casa) checked @endif> Sí</label>
                            <label class="flex items-center"><input type="radio" name="agusto_en_casa" value="0" @if(!$sociabilidad->agusto_en_casa) checked @endif> No</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Te sientes comprendido por tus padres y hermanos?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center"><input type="radio" name="comprendido_familia" value="1" @if($sociabilidad->comprendido_familia) checked @endif> Sí</label>
                            <label class="flex items-center"><input type="radio" name="comprendido_familia" value="0" @if(!$sociabilidad->comprendido_familia) checked @endif> No</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Tienes buenos amigos?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center"><input type="radio" name="tiene_buenos_amigos" value="1" @if($sociabilidad->tiene_buenos_amigos) checked @endif> Sí</label>
                            <label class="flex items-center"><input type="radio" name="tiene_buenos_amigos" value="0" @if(!$sociabilidad->tiene_buenos_amigos) checked @endif> No</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Confías en ellos? ¿Qué es lo que te hace confiar o no en ellos?</label>
                        <textarea name="confia_amigos_detalle" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $sociabilidad->confia_amigos_detalle }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Pasas mucho tiempo con ellos o prefieres pasar más tiempo sólo?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center"><input type="radio" name="preferencia_tiempo_libre" value="amigos" @if($sociabilidad->preferencia_tiempo_libre == 'amigos') checked @endif> Con amigos</label>
                            <label class="flex items-center"><input type="radio" name="preferencia_tiempo_libre" value="solo" @if($sociabilidad->preferencia_tiempo_libre == 'solo') checked @endif> Solo</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Qué es lo que más te preocupa de tu relación con los amigos?</label>
                        <textarea name="preocupacion_amigos" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $sociabilidad->preocupacion_amigos }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Te encuentras a gusto con tus compañeros de clase?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center"><input type="radio" name="agusto_companeros_clase" value="1" @if($sociabilidad->agusto_companeros_clase) checked @endif> Sí</label>
                            <label class="flex items-center"><input type="radio" name="agusto_companeros_clase" value="0" @if(!$sociabilidad->agusto_companeros_clase) checked @endif> No</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Crees que estás integrado/a? ¿Por qué?</label>
                        <textarea name="integrado_clase_porque" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $sociabilidad->integrado_clase_porque }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Crees que se conocen y respetan las normas de funcionamiento de la clase? Especifica</label>
                        <textarea name="normas_clase_respetan_detalle" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $sociabilidad->normas_clase_respetan_detalle }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Hay alguien con quien te lleves mal? ¿Cuál crees que sea el motivo?</label>
                        <textarea name="enemistad_clase_motivo" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $sociabilidad->enemistad_clase_motivo }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 6: Personalidad -->
            <div id="section-6" class="section-content">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Personalidad</h2>
                @php $personalidad = $alumno->personalidad; @endphp
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cómo te describirías a ti mismo/a?</label>
                        <textarea name="autodescripcion" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $personalidad->autodescripcion }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cómo crees que te ven los demás?</label>
                        <textarea name="como_lo_ven_demas" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $personalidad->como_lo_ven_demas }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Qué es lo que más te gusta de ti?</label>
                        <textarea name="gusta_mas_de_si" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $personalidad->gusta_mas_de_si }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Y lo que menos te gusta de ti?</label>
                        <textarea name="gusta_menos_de_si" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $personalidad->gusta_menos_de_si }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Estás contento/a con tu forma de ser y con tu físico?</label>
                        <div class="flex gap-4 mb-2">
                            <label class="flex items-center"><input type="radio" name="contento_ser_fisico" value="1" @if($personalidad->contento_ser_fisico) checked @endif> Sí</label>
                            <label class="flex items-center"><input type="radio" name="contento_ser_fisico" value="0" @if(!$personalidad->contento_ser_fisico) checked @endif> No</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Cambiarías algo de tu forma de ser o de tu físico?</label>
                        <textarea name="cambiaria_algo_ser_fisico" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $personalidad->cambiaria_algo_ser_fisico }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 7: Información Extra -->
            <div id="section-7" class="section-content">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Información extra</h2>
                @php $informacionExtra = $alumno->informacionExtra; @endphp
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿Hay alguna situación que quisieras comentar que consideras está afectando tu desempeño escolar?</label>
                        <textarea name="datos_adicionales" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2B8A7F] focus:border-transparent">{{ $informacionExtra->datos_adicionales }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8">
                <button type="submit" class="px-6 py-2 bg-[#2B8A7F] text-white rounded-lg font-medium hover:bg-emerald-900 transition-colors">Guardar Cambios</button>
            </div>
        </form>
    </main>

    <script>
        let currentSection = 1;
        function showSection(sectionNumber) {
            document.querySelectorAll('.section-content').forEach(section => section.classList.remove('active'));
            document.getElementById(`section-${sectionNumber}`).classList.add('active');
            document.querySelectorAll('.tab-button').forEach((btn, index) => {
                btn.classList.toggle('active', index + 1 === sectionNumber);
            });
            currentSection = sectionNumber;
        }
        document.addEventListener('DOMContentLoaded', () => showSection(1));
    </script>
</body>
</html>