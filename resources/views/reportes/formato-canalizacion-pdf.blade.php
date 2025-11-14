<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Formato de Canalización #{{ $canalizacion->pk_canalizacion }}</title>
    <style>
        /* Estilos Generales Comprimidos */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            line-height: 1.3;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 10px;
        }

        /* Encabezado (Logo y Código) */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #000;
            margin-bottom: 3px;
        }
        .header-table .logo-side {
            width: 70%;
            text-align: left;
            vertical-align: top;
        }
        .header-table .logo-side .logo-main {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 3px;
        }
        .header-table .logo-side .logo-fragments {
            font-size: 8px;
            color: #555;
            letter-spacing: 2px;
        }
        .header-table .code-side {
            width: 30%;
            text-align: right;
            vertical-align: top;
            font-size: 9px;
            font-weight: bold;
        }
        .main-title {
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        /* Estilo de Tarjeta (Card) Comprimido */
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 8px;
            width: 100%;
            page-break-inside: avoid; 
        }
        .card-header {
            /* === NUEVO COLOR APLICADO A TODOS LOS HEADERS === */
            background-color: #2B8A7F;
            color: #ffffff; /* Texto blanco para legibilidad */
            padding: 6px 10px;
            font-weight: bold;
            font-size: 12px;
            border-bottom: 1px solid #ddd;
            border-radius: 5px 5px 0 0;
        }
        .card-body {
            padding: 8px;
        }
        
        /* Tabla de Datos Generales (Alumno y Formato) Comprimida */
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 2px 4px;
            vertical-align: top;
        }
        .info-table .label {
            font-size: 8px;
            font-weight: bold;
            color: #555;
            padding-bottom: 0;
        }
        .info-table .value {
            font-size: 10px;
        }
        
        /* Tabla de Motivos Comprimida */
        .motivos-table {
            width: 100%;
            border-collapse: collapse;
        }
        .motivos-table > tbody > tr > td {
            width: 50%;
            padding: 3px;
            vertical-align: top;
        }
        .motivo-box {
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }
        .motivo-box-header {
            /* === NUEVO COLOR APLICADO AQUÍ === */
            background-color: #2B8A7F; 
            color: #ffffff;
            padding: 4px 6px;
            font-weight: bold;
            font-size: 9px;
            text-align: center;
            border-bottom: 1px solid #ccc;
            border-radius: 4px 4px 0 0;
        }
        .motivo-box-content {
            padding: 6px 8px;
            font-size: 9px;
        }

        .motivo-item {
            margin-bottom: 2px;
        }
        .motivo-item span { 
            font-family: 'Courier New', monospace;
            font-weight: bold;
            margin-right: 5px;
            font-size: 10px;
        }
        .motivo-checked {
            font-weight: bold;
        }

        /* Caja de Textos (Observaciones, Acciones) Comprimida */
        .text-section {
            margin-bottom: 5px;
        }
        .text-section-label {
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 2px;
        }
        .text-section-content {
            border: 1px solid #eee;
            background-color: #fdfdfd;
            padding: 5px;
            min-height: 30px;
            font-size: 9px;
        }

        /* Pie de Página (Firma) Comprimido */
        .signature-box {
            margin-top: 25px;
            text-align: center;
            page-break-inside: avoid; 
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 250px;
            margin: 0 auto;
            padding-top: 5px;
            font-weight: bold;
            font-size: 10px;
        }
        .signature-subtext {
            font-weight: normal;
            font-size: 9px;
        }

    </style>
</head>
<body>
    @php
        // Función helper (sin cambios)
        function print_motivo($formato, $campo, $etiqueta) {
            $checked = $formato && $formato->$campo == 1;
            $class = $checked ? 'motivo-checked' : '';
            $icon = $checked ? '[&nbsp;X&nbsp;]' : '[&nbsp;&nbsp;&nbsp;]';
            echo "<div class=\"motivo-item $class\"><span>$icon</span> $etiqueta</div>";
        }
    @endphp

    <div class="container">
        
        <table class="header-table">
            <tr>
                <td class="logo-side">
                    <div class="logo-main">UNIVERSIDAD TECNOLÓGICA DE ESCUINAPA</div>
                    <div class="logo-fragments">TUTORÍAS</div>
                </td>
                <td class="code-side">
                    CÓDIGO: TUTOR-TUR-1A-04-00-150-2024
                </td>
            </tr>
        </table>

        <div class="main-title">FORMATO DE CANALIZACIÓN</div>

        {{-- TARJETA 1: DATOS GENERALES (Alumno y Formato) --}}
        <div class="card">
            <div class="card-header">Datos Generales</div>
            <div class="card-body">
                <table class="info-table">
                    <tr>
                        <td style="width: 33%;">
                            <div class="label">Estudiante</div>
                            <div class="value">{{ $canalizacion->alumno->nombre_completo ?? 'N/A' }}</div>
                        </td>
                        <td style="width: 33%;">
                            <div class="label">Matrícula</div>
                            <div class="value">{{ $canalizacion->alumno->pk_alumno ?? 'N/A' }}</div>
                        </td>
                        <td style="width: 33%;">
                            <div class="label">Grado/Grupo</div>
                            <div class="value">{{ $canalizacion->alumno->grupo->nombre_grupo ?? 'N/A' }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="label">Fecha</div>
                            <div class="value">{{ $formato ? \Carbon\Carbon::parse($formato->fecha_canalizacion)->format('d \de F \de Y') : 'N/A' }}</div>
                        </td>
                        <td>
                            <div class="label">Tutor(a)</div>
                            <div class="value">{{ $formato->tutor_nombre ?? 'N/A' }}</div>
                        </td>
                        <td>
                            <div class="label">Carrera</div>
                            <div class="value">{{ $formato->carrera ?? $canalizacion->alumno->carrera ?? 'N/A' }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="label">Celular</div>
                            <div class="value">{{ $canalizacion->alumno->celular ?? 'No registrado' }}</div>
                        </td>
                        <td colspan="2">
                            <div class="label">Domicilio</div>
                            <div class="value">{{ $canalizacion->alumno->direccion ?? 'No registrado' }}</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- TARJETA 2: MOTIVOS DE CANALIZACIÓN --}}
        <div class="card">
            <div class="card-header">Motivo de Canalización</div>
            <div class="card-body" style="padding: 5px 3px 3px 3px;">
                <table class="motivos-table">
                    {{-- Fila 1 --}}
                    <tr>
                        <td>
                            <div class="motivo-box">
                                <div class="motivo-box-header">SITUACIÓN ACADÉMICA</div>
                                <div class="motivo-box-content">
                                    @php print_motivo($formato, 'motivo_reprobacion', 'Reprobación'); @endphp
                                    @php print_motivo($formato, 'motivo_constantes_faltas', 'Constantes faltas'); @endphp
                                    @php print_motivo($formato, 'motivo_no_participa', 'No participa'); @endphp
                                    @php print_motivo($formato, 'motivo_no_entrega_actividades', 'No entrega actividades'); @endphp
                                    @php print_motivo($formato, 'motivo_dificultad_asignatura', 'Dificultad en asignatura'); @endphp
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="motivo-box">
                                <div class="motivo-box-header">INASISTENCIA</div>
                                <div class="motivo-box-content">
                                    @php print_motivo($formato, 'motivo_inasistencia_distancia', 'Problema de: Distancia'); @endphp
                                    @php print_motivo($formato, 'motivo_inasistencia_transporte', 'Problema de: Transporte'); @endphp
                                    @php print_motivo($formato, 'motivo_inasistencia_enfermedad', 'Problema de: Enfermedad'); @endphp
                                    @php print_motivo($formato, 'motivo_inasistencia_familiar', 'Problema de: Familiar'); @endphp
                                    @php print_motivo($formato, 'motivo_inasistencia_personal', 'Problema de: Personal'); @endphp
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- Fila 2 --}}
                    <tr>
                        <td>
                            <div class="motivo-box">
                                <div class="motivo-box-header">PROBLEMAS SALUD</div>
                                <div class="motivo-box-content">
                                    @php print_motivo($formato, 'motivo_salud_dolor_cabeza', 'Dolor de cabeza'); @endphp
                                    @php print_motivo($formato, 'motivo_salud_dolor_estomago', 'Dolor de estómago'); @endphp
                                    @php print_motivo($formato, 'motivo_salud_dolor_muscular', 'Dolor muscular'); @endphp
                                    @php print_motivo($formato, 'motivo_salud_respiratorios', 'Respiratorios'); @endphp
                                    @php print_motivo($formato, 'motivo_salud_vertigo', 'Vértigo'); @endphp
                                    @php print_motivo($formato, 'motivo_salud_vomito', 'Vómito'); @endphp
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="motivo-box">
                                <div class="motivo-box-header">SÍNTOMAS DE ADICCIÓN</div>
                                <div class="motivo-box-content">
                                    @php print_motivo($formato, 'motivo_adiccion_ojos_rojos', 'Ojos rojos'); @endphp
                                    @php print_motivo($formato, 'motivo_adiccion_somnolencia', 'Somnolencia'); @endphp
                                    @php print_motivo($formato, 'motivo_adiccion_aliento_alcoholico', 'Aliento alcohólico'); @endphp
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- Fila 3 --}}
                    <tr>
                        <td>
                            <div class="motivo-box">
                                <div class="motivo-box-header">PROBLEMAS DE COMPORTAMIENTO</div>
                                <div class="motivo-box-content">
                                    @php print_motivo($formato, 'motivo_comportamiento_agresivo', 'Agresivo'); @endphp
                                    @php print_motivo($formato, 'motivo_comportamiento_indisciplina', 'Indisciplina'); @endphp
                                    @php print_motivo($formato, 'motivo_comportamiento_desafiante', 'Desafiante'); @endphp
                                    @php print_motivo($formato, 'motivo_comportamiento_irrespetuoso', 'Irrespetuoso'); @endphp
                                    @php print_motivo($formato, 'motivo_comportamiento_desinteres', 'Desinterés'); @endphp
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="motivo-box">
                                <div class="motivo-box-header">SÍNTOMAS DE ESTRÉS</div>
                                <div class="motivo-box-content">
                                    @php print_motivo($formato, 'motivo_estres_frustracion', 'Frustración'); @endphp
                                    @php print_motivo($formato, 'motivo_estres_desmotivacion', 'Desmotivación'); @endphp
                                    @php print_motivo($formato, 'motivo_estres_cansancio', 'Cansancio'); @endphp
                                    @php print_motivo($formato, 'motivo_estres_hiperactividad', 'Hiperactividad'); @endphp
                                    @php print_motivo($formato, 'motivo_estres_ansiedad', 'Ansiedad'); @endphp
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- Fila 4 --}}
                    <tr>
                        <td>
                            <div class="motivo-box">
                                <div class="motivo-box-header">PROBLEMA SOCIOECONÓMICO</div>
                                <div class="motivo-box-content">
                                    @php print_motivo($formato, 'motivo_socioeconomico_matrimonio', 'Matrimonio'); @endphp
                                    @php print_motivo($formato, 'motivo_socioeconomico_embarazo', 'Embarazo'); @endphp
                                    @php print_motivo($formato, 'motivo_socioeconomico_no_desea_estudiar', 'No desea seguir estudiando'); @endphp
                                    @php print_motivo($formato, 'motivo_socioeconomico_decidio_trabajar', 'Decidió trabajar'); @endphp
                                    @php print_motivo($formato, 'motivo_socioeconomico_horario_laboral', 'Horario laboral'); @endphp
                                    @php print_motivo($formato, 'motivo_socioeconomico_pago_mensualidades', 'Pago mensualidades'); @endphp
                                    @php print_motivo($formato, 'motivo_socioeconomico_transporte', 'Transporte'); @endphp
                                    @php print_motivo($formato, 'motivo_socioeconomico_manutencion', 'Manutención'); @endphp
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="motivo-box">
                                <div class="motivo-box-header">FALTAS INSTITUCIONALES</div>
                                <div class="motivo-box-content">
                                    @php print_motivo($formato, 'motivo_faltas_ebrio', 'Ebrio'); @endphp
                                    @php print_motivo($formato, 'motivo_faltas_drogado', 'Drogado'); @endphp
                                    @php print_motivo($formato, 'motivo_faltas_vandalismo', 'Vandalismo'); @endphp
                                    @php print_motivo($formato, 'motivo_faltas_porta_armas_drogas', 'Porta armas / Drogas'); @endphp
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- Fila 5: Otros --}}
                    <tr>
                        <td colspan="2" style="padding-top: 5px;">
                            <div class="text-section">
                                <div class="text-section-label">Otros (especifique):</div>
                                <div class="text-section-content" style="min-height: 20px;">
                                    <p>{{ $formato->motivo_otros ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- TARJETA 3: OBSERVACIONES Y ACCIONES --}}
        <div class="card">
            <div class="card-header">Observaciones y Acciones</div>
            <div class="card-body">
                
                {{-- Observaciones Tutor --}}
                <div class="text-section">
                    <div class="text-section-label">OBSERVACIONES POR TUTOR:</div>
                    <div class="text-section-content">
                        <p>{{ $formato->observaciones_tutor ?? 'N/A' }}</p>
                    </div>
                </div>
                
                {{-- Acciones Tutor --}}
                <div class="text-section" style="margin-bottom: 0;">
                    <div class="text-section-label">ACCIONES APLICADAS POR EL TUTOR:</div>
                    <div class="text-section-content">
                        <p>{{ $formato->acciones_tutor ?? 'N/A' }}</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- SECCIÓN DE FIRMA (Como el original) --}}
        <div class="signature-box">
            <div class="signature-line">
                COORDINADOR / TUTOR (A)
                <div class="signature-subtext">Nombre completo</div>
            </div>
        </div>

    </div>
</body>
</html>