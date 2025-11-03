<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Formato de Canalización #{{ $canalizacion->pk_canalizacion }}</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10px; /* Reducimos la fuente para que quepa todo */
            line-height: 1.3;
            color: #333;
        }
        .container {
            width: 98%;
            margin: 0 auto;
        }
        
        /* Encabezado */
        .header-title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: #2B8A7F;
            margin-bottom: 5px;
        }
        .header-subtitle {
            font-size: 12px;
            text-align: center;
            color: #555;
            margin-bottom: 20px;
        }

        /* Títulos de Sección */
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #2B8A7F;
            border-bottom: 2px solid #2B8A7F;
            padding-bottom: 4px;
            margin-top: 20px;
            margin-bottom: 10px;
            page-break-after: avoid;
        }
        
        /* Subtítulos (para categorías de motivos) */
        .category-title {
            font-size: 11px;
            font-weight: bold;
            text-decoration: underline;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        /* Tabla de Datos (para Alumno y Canalización) */
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table tr {
            border-bottom: 1px solid #eee;
        }
        .info-table th, .info-table td {
            padding: 6px 0; /* Menos padding vertical */
            vertical-align: top;
        }
        .info-table th {
            width: 25%;
            text-align: left;
            font-weight: bold;
            color: #555;
        }
        
        /* Lista de Motivos */
        .motivos-list {
            list-style-type: none;
            padding-left: 0;
            column-count: 2; /* Muestra los motivos en 2 columnas */
            column-gap: 20px;
            page-break-inside: avoid;
        }
        .motivo-item {
            margin-bottom: 4px; /* Menos espacio */
        }
        .motivo-item span {
            display: inline-block;
            width: 15px;
            height: 15px;
            font-size: 11px;
            line-height: 15px;
            text-align: center;
            vertical-align: middle;
            margin-right: 6px;
            border: 1px solid #999;
            background-color: #f4f4f4;
            font-weight: bold;
        }
        /* Estilo para el motivo "marcado" */
        .motivo-checked {
            font-weight: bold;
            color: #000;
        }
        .motivo-checked span {
            background-color: #333;
            color: white;
            border-color: #333;
        }
        
        /* Cajas de texto */
        .text-box {
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            padding: 10px;
            min-height: 80px;
            page-break-inside: avoid;
        }
        .text-box p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header-title">Formato de Canalización</div>
        <div class="header-subtitle">TUTOR-TUR-IA-04-00-150-2024</div>

        {{-- SECCIÓN: DATOS DEL ALUMNO --}}
        <div class="section-title">Datos del Alumno</div>
        <table class="info-table">
            <tr>
                <th>Tutor(a):</th>
                <td>{{ $formato->tutor_nombre ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Alumno:</th>
                <td>{{ $canalizacion->alumno->nombre_completo ?? 'N/A' }}</td>
            </tr>
             <tr>
                <th>Matrícula:</th>
                <td>{{ $canalizacion->alumno->pk_alumno ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Carrera:</th>
                <td>{{ $formato->carrera ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Grado y Grupo:</th>
                <td>{{ $canalizacion->alumno->grupo->nombre_grupo ?? 'N/A' }}</td>
            </tr>
             <tr>
                <th>Fecha de Canalización:</th>
                <td>{{ $formato ? \Carbon\Carbon::parse($formato->fecha_canalizacion)->format('d \de F \de Y') : 'N/A' }}</td>
            </tr>
        </table>

        {{-- SECCIÓN: MOTIVOS DE CANALIZACIÓN --}}
        <div class="section-title">Motivos de Canalización</div>
        
        @php
            // Función helper para no repetir código
            function print_motivo($formato, $campo, $etiqueta) {
                $checked = $formato && $formato->$campo == 1;
                $class = $checked ? 'motivo-checked' : '';
                $icon = $checked ? 'X' : '&nbsp;';
                echo "<li class=\"motivo-item $class\"><span>$icon</span> $etiqueta</li>";
            }
        @endphp

        <ul class="motivos-list">
            <div>
                <div class="category-title">Académico</div>
                @php print_motivo($formato, 'motivo_reprobacion', 'Reprobación'); @endphp
                @php print_motivo($formato, 'motivo_constantes_faltas', 'Constantes faltas'); @endphp
                @php print_motivo($formato, 'motivo_no_participa', 'No participa'); @endphp
                @php print_motivo($formato, 'motivo_no_entrega_actividades', 'No entrega actividades'); @endphp
                @php print_motivo($formato, 'motivo_dificultad_asignatura', 'Dificultad en asignatura'); @endphp
            </div>
            
            <div>
                <div class="category-title">Inasistencia</div>
                @php print_motivo($formato, 'motivo_inasistencia_distancia', 'Inasistencia por distancia'); @endphp
                @php print_motivo($formato, 'motivo_inasistencia_transporte', 'Inasistencia por transporte'); @endphp
                @php print_motivo($formato, 'motivo_inasistencia_enfermedad', 'Inasistencia por enfermedad'); @endphp
                @php print_motivo($formato, 'motivo_inasistencia_familiar', 'Inasistencia por motivo familiar'); @endphp
                @php print_motivo($formato, 'motivo_inasistencia_personal', 'Inasistencia por motivo personal'); @endphp
            </div>
            
            <div>
                <div class="category-title">Salud</div>
                @php print_motivo($formato, 'motivo_salud_dolor_cabeza', 'Dolor de cabeza'); @endphp
                @php print_motivo($formato, 'motivo_salud_dolor_estomago', 'Dolor de estómago'); @endphp
                @php print_motivo($formato, 'motivo_salud_dolor_muscular', 'Dolor muscular'); @endphp
                @php print_motivo($formato, 'motivo_salud_respiratorios', 'Problemas respiratorios'); @endphp
                @php print_motivo($formato, 'motivo_salud_vertigo', 'Vértigo'); @endphp
                @php print_motivo($formato, 'motivo_salud_vomito', 'Vómito'); @endphp
            </div>
            
            <div>
                <div class="category-title">Adicción</div>
                @php print_motivo($formato, 'motivo_adiccion_ojos_rojos', 'Ojos rojos'); @endphp
                @php print_motivo($formato, 'motivo_adiccion_somnolencia', 'Somnolencia'); @endphp
                @php print_motivo($formato, 'motivo_adiccion_aliento_alcoholico', 'Aliento alcohólico'); @endphp
            </div>
            
            <div>
                <div class="category-title">Comportamiento</div>
                @php print_motivo($formato, 'motivo_comportamiento_agresivo', 'Agresivo'); @endphp
                @php print_motivo($formato, 'motivo_comportamiento_indisciplina', 'Indisciplina'); @endphp
                @php print_motivo($formato, 'motivo_comportamiento_desafiante', 'Desafiante'); @endphp
                @php print_motivo($formato, 'motivo_comportamiento_irrespetuoso', 'Irrespetuoso'); @endphp
                @php print_motivo($formato, 'motivo_comportamiento_desinteres', 'Desinterés'); @endphp
            </div>
            
            <div>
                <div class="category-title">Estrés</div>
                @php print_motivo($formato, 'motivo_estres_frustracion', 'Frustración'); @endphp
                @php print_motivo($formato, 'motivo_estres_desmotivacion', 'Desmotivación'); @endphp
                @php print_motivo($formato, 'motivo_estres_cansancio', 'Cansancio'); @endphp
                @php print_motivo($formato, 'motivo_estres_hiperactividad', 'Hiperactividad'); @endphp
                @php print_motivo($formato, 'motivo_estres_ansiedad', 'Ansiedad'); @endphp
            </div>
            
            <div>
                <div class="category-title">Socioeconómico</div>
                @php print_motivo($formato, 'motivo_socioeconomico_matrimonio', 'Matrimonio'); @endphp
                @php print_motivo($formato, 'motivo_socioeconomico_embarazo', 'Embarazo'); @endphp
                @php print_motivo($formato, 'motivo_socioeconomico_no_desea_estudiar', 'No desea estudiar'); @endphp
                @php print_motivo($formato, 'motivo_socioeconomico_decidio_trabajar', 'Decidió trabajar'); @endphp
                @php print_motivo($formato, 'motivo_socioeconomico_horario_laboral', 'Horario laboral'); @endphp
                @php print_motivo($formato, 'motivo_socioeconomico_pago_mensualidades', 'Pago de mensualidades'); @endphp
                @php print_motivo($formato, 'motivo_socioeconomico_transporte', 'Transporte'); @endphp
                @php print_motivo($formato, 'motivo_socioeconomico_manutencion', 'Manutención'); @endphp
            </div>
            
            <div>
                <div class="category-title">Faltas Institucionales</div>
                @php print_motivo($formato, 'motivo_faltas_ebrio', 'Presentarse ebrio'); @endphp
                @php print_motivo($formato, 'motivo_faltas_drogado', 'Presentarse drogado'); @endphp
                @php print_motivo($formato, 'motivo_faltas_vandalismo', 'Vandalismo'); @endphp
                @php print_motivo($formato, 'motivo_faltas_porta_armas_drogas', 'Portar armas/drogas'); @endphp
            </div>
        </ul>

        {{-- SECCIÓN: OTROS MOTIVOS --}}
        @if($formato && !empty($formato->motivo_otros))
            <div class="section-title" style="margin-top: 20px;">Otros Motivos</div>
            <div class="text-box">
                <p>{{ $formato->motivo_otros }}</p>
            </div>
        @endif

        {{-- SECCIÓN: OBSERVACIONES Y ACCIONES --}}
        <div class="section-title">Observaciones por Tutor</div>
        <div class="text-box">
            <p>{{ $formato->observaciones_tutor ?? 'Sin observaciones.' }}</p>
        </div>

        <div class="section-title">Acciones Aplicadas por el Tutor</div>
        <div class="text-box">
            <p>{{ $formato->acciones_tutor ?? 'Sin acciones registradas.' }}</p>
        </div>

    </div>
</body>
</html>