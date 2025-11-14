<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Canalizacion;
use App\Models\FormatoCanalizacion;
use App\Models\CanalizacionSeguimiento;
use App\Models\MotivoBaja;
use App\Models\Baja;
use carbon\Carbon;

use App\Models\Actividad;
use Barryvdh\DomPDF\Facade\Pdf;


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;


use App\Models\Alumno;
use Illuminate\Support\Facades\DB;


class CanalizacionController extends Controller
{
    public function index()
    {
        // 1. Consulta original de canalizaciones
        $canalizaciones = Canalizacion::with(['alumno.grupo', 'motivo'])
            ->where('estatus', 'Activa') // Opcional: solo muestra las activas
            ->get();

        $total_canalizaciones = $canalizaciones->count();

        // 2. Consulta original de motivo común
        $motivo_comun = Canalizacion::join('motivo_canalizacion', 'canalizacion.fk_motivo_canalizacion', '=', 'motivo_canalizacion.pk_motivo_canalizacion')
            ->select('motivo_canalizacion.nombre', DB::raw('COUNT(*) as total'))
            ->groupBy('motivo_canalizacion.pk_motivo_canalizacion', 'motivo_canalizacion.nombre')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->first();

        // --- 3. ¡AQUÍ ESTÁ LO NUEVO! ---
        // Cargamos todas las bajas con sus relaciones (alumno y motivo)
        $bajas = Baja::with(['alumno', 'motivoBaja'])
            ->orderBy('fecha', 'desc')
            ->get();

        $total_bajas = $bajas->count();

        // 4. Pasamos todos los datos a la vista
        return view('canalizaciones', [
            'canalizaciones' => $canalizaciones,
            'total_canalizaciones' => $total_canalizaciones,
            'motivo_comun' => $motivo_comun,
            'bajas' => $bajas, 
            'total_bajas' => $total_bajas,
        ]);
    }

    public function show(Canalizacion $canalizacion)
    {
        // 1. Cargamos las relaciones que la vista de detalle necesita.
        $canalizacion->load(['alumno.grupo', 'motivo']);

        // 2. Buscamos el formato asociado (lógica que ya teníamos)
        $formato = FormatoCanalizacion::where('fk_alumno', $canalizacion->fk_alumno)
            ->orderBy('fecha_canalizacion', 'desc')
            ->first();

        // 3. ¡AQUÍ ESTÁ LA LÍNEA QUE FALTA!
        // Cargamos todos los motivos de baja para usarlos en el modal
        $motivos_baja = MotivoBaja::all();

        // 4. Retornamos la vista de detalle y le pasamos TODAS las variables
        return view('detalle_canalizacion_alumno', [
            'canalizacion' => $canalizacion,
            'formato' => $formato,
            'motivos_baja' => $motivos_baja, // <-- Esta es la variable que faltaba
        ]);
    }

    public function showFormato(Canalizacion $canalizacion)
    {
        // Cargamos el alumno y grupo para mostrar sus datos en el encabezado del formato
        $canalizacion->load('alumno.grupo');

        // Asumimos que tu vista se llama 'canalizaciones-formato.blade.php'
        return view('canalizaciones_formato', [
            'canalizacion' => $canalizacion,
        ]);
    }

    // --- 3. AÑADE ESTE MÉTODO PARA GUARDAR EL FORMULARIO ---
    /**
     * Guarda los datos del formato de canalización en la BD.
     */
    public function storeFormato(Request $request, Canalizacion $canalizacion)
    {
        // 1. Validamos los campos de texto principales
        $data = $request->validate([
            'fecha_canalizacion' => 'required|date',
            'tutor_nombre' => 'required|string|max:255',
            'carrera' => 'required|string|max:150',
            'motivo_otros' => 'nullable|string',
            'observaciones_tutor' => 'nullable|string',
            'acciones_tutor' => 'nullable|string',
        ]);

        // 2. Añadimos el fk_alumno (basado en la canalización de la URL)
        $data['fk_alumno'] = $canalizacion->fk_alumno; //

        // 3. Procesamos TODOS los checkboxes de la tabla 'formato_canalizacion'
        // (Esto es largo, pero necesario para que coincida con tu BD)

        // Académico
        $data['motivo_reprobacion'] = $request->has('motivo_reprobacion') ? 1 : 0;
        $data['motivo_constantes_faltas'] = $request->has('motivo_constantes_faltas') ? 1 : 0;
        $data['motivo_no_participa'] = $request->has('motivo_no_participa') ? 1 : 0;
        $data['motivo_no_entrega_actividades'] = $request->has('motivo_no_entrega_actividades') ? 1 : 0;
        $data['motivo_dificultad_asignatura'] = $request->has('motivo_dificultad_asignatura') ? 1 : 0;

        // Inasistencia
        $data['motivo_inasistencia_distancia'] = $request->has('motivo_inasistencia_distancia') ? 1 : 0;
        $data['motivo_inasistencia_transporte'] = $request->has('motivo_inasistencia_transporte') ? 1 : 0;
        $data['motivo_inasistencia_enfermedad'] = $request->has('motivo_inasistencia_enfermedad') ? 1 : 0;
        $data['motivo_inasistencia_familiar'] = $request->has('motivo_inasistencia_familiar') ? 1 : 0;
        $data['motivo_inasistencia_personal'] = $request->has('motivo_inasistencia_personal') ? 1 : 0;

        // Salud
        $data['motivo_salud_dolor_cabeza'] = $request->has('motivo_salud_dolor_cabeza') ? 1 : 0;
        $data['motivo_salud_dolor_estomago'] = $request->has('motivo_salud_dolor_estomago') ? 1 : 0;
        $data['motivo_salud_dolor_muscular'] = $request->has('motivo_salud_dolor_muscular') ? 1 : 0;
        $data['motivo_salud_respiratorios'] = $request->has('motivo_salud_respiratorios') ? 1 : 0;
        $data['motivo_salud_vertigo'] = $request->has('motivo_salud_vertigo') ? 1 : 0;
        $data['motivo_salud_vomito'] = $request->has('motivo_salud_vomito') ? 1 : 0;

        // Adicción
        $data['motivo_adiccion_ojos_rojos'] = $request->has('motivo_adiccion_ojos_rojos') ? 1 : 0;
        $data['motivo_adiccion_somnolencia'] = $request->has('motivo_adiccion_somnolencia') ? 1 : 0;
        $data['motivo_adiccion_aliento_alcoholico'] = $request->has('motivo_adiccion_aliento_alcoholico') ? 1 : 0;

        // Comportamiento
        $data['motivo_comportamiento_agresivo'] = $request->has('motivo_comportamiento_agresivo') ? 1 : 0;
        $data['motivo_comportamiento_indisciplina'] = $request->has('motivo_comportamiento_indisciplina') ? 1 : 0;
        $data['motivo_comportamiento_desafiante'] = $request->has('motivo_comportamiento_desafiante') ? 1 : 0;
        $data['motivo_comportamiento_irrespetuoso'] = $request->has('motivo_comportamiento_irrespetuoso') ? 1 : 0;
        $data['motivo_comportamiento_desinteres'] = $request->has('motivo_comportamiento_desinteres') ? 1 : 0;

        // Estrés
        $data['motivo_estres_frustracion'] = $request->has('motivo_estres_frustracion') ? 1 : 0;
        $data['motivo_estres_desmotivacion'] = $request->has('motivo_estres_desmotivacion') ? 1 : 0;
        $data['motivo_estres_cansancio'] = $request->has('motivo_estres_cansancio') ? 1 : 0;
        $data['motivo_estres_hiperactividad'] = $request->has('motivo_estres_hiperactividad') ? 1 : 0;
        $data['motivo_estres_ansiedad'] = $request->has('motivo_estres_ansiedad') ? 1 : 0;

        // Socioeconómico
        $data['motivo_socioeconomico_matrimonio'] = $request->has('motivo_socioeconomico_matrimonio') ? 1 : 0;
        $data['motivo_socioeconomico_embarazo'] = $request->has('motivo_socioeconomico_embarazo') ? 1 : 0;
        $data['motivo_socioeconomico_no_desea_estudiar'] = $request->has('motivo_socioeconomico_no_desea_estudiar') ? 1 : 0;
        $data['motivo_socioeconomico_decidio_trabajar'] = $request->has('motivo_socioeconomico_decidio_trabajar') ? 1 : 0;
        $data['motivo_socioeconomico_horario_laboral'] = $request->has('motivo_socioeconomico_horario_laboral') ? 1 : 0;
        $data['motivo_socioeconomico_pago_mensualidades'] = $request->has('motivo_socioeconomico_pago_mensualidades') ? 1 : 0;
        $data['motivo_socioeconomico_transporte'] = $request->has('motivo_socioeconomico_transporte') ? 1 : 0;
        $data['motivo_socioeconomico_manutencion'] = $request->has('motivo_socioeconomico_manutencion') ? 1 : 0;

        // Faltas Institucionales
        $data['motivo_faltas_ebrio'] = $request->has('motivo_faltas_ebrio') ? 1 : 0;
        $data['motivo_faltas_drogado'] = $request->has('motivo_faltas_drogado') ? 1 : 0;
        $data['motivo_faltas_vandalismo'] = $request->has('motivo_faltas_vandalismo') ? 1 : 0;
        $data['motivo_faltas_porta_armas_drogas'] = $request->has('motivo_faltas_porta_armas_drogas') ? 1 : 0;

        // 4. Creamos el registro en la tabla 'formato_canalizacion'
        FormatoCanalizacion::create($data);

        // 5. Redirigimos a la vista de detalle (la de solo-lectura) con un mensaje de éxito
        return redirect()->route('canalizaciones.show', $canalizacion)
            ->with('status', 'Formato de canalización guardado con éxito.');
    }

    public function storeSeguimiento(Request $request, Canalizacion $canalizacion)
    {
        // 1. Validamos los campos del formulario
        $data = $request->validate([
            'fk_formato_canalizacion' => 'required|integer|exists:formato_canalizacion,pk_formato_canalizacion',
            'fecha_seguimiento' => 'required|date',
            'modalidad_seguimiento' => 'required|string|max:255',
            'responsable_atencion' => 'required|string|max:255',
            'diagnostico_otorgado' => 'nullable|string',
            'seguimiento_tutorias' => 'nullable|string',
            'seguimiento_medico' => 'nullable|string',
            'seguimiento_psicologo' => 'nullable|string',
            'seguimiento_trabajo_social' => 'nullable|string',
        ]);

        // 2. Creamos el registro en la tabla 'canalizacion_seguimiento'
        CanalizacionSeguimiento::create($data);

        // 3. Redirigimos de vuelta a la página de detalle con un mensaje
        return redirect()->route('canalizaciones.show', $canalizacion)
            ->with('status', 'Seguimiento CAIE guardado con éxito.');
    }

    public function showHistorial(Alumno $alumno)
    {
        // 1. Cargar todas las canalizaciones del alumno con sus relaciones
        // Eager-loading ('with') es crucial para el rendimiento
        $canalizaciones = Canalizacion::with(['motivo', 'formato.seguimientos'])
            ->where('fk_alumno', $alumno->pk_alumno)
            ->orderBy('fecha_inicio', 'desc') // La más reciente primero
            ->get();

        // 2. Calcular las estadísticas
        $totalCanalizaciones = $canalizaciones->count();
        $totalActivas = $canalizaciones->where('estatus', 'Activa')->count();
        $totalCerradas = $canalizaciones->where('estatus', 'Cerrada')->count();

        // 3. Encontrar el motivo más común
        // countBy('motivo.nombre') agrupa por el nombre del motivo y cuenta
        // sortDesc() ordena de mayor a menor
        // keys()->first() obtiene el nombre del primero
        $motivoComun = $canalizaciones->countBy('motivo.nombre')
            ->sortDesc()
            ->keys()
            ->first() ?? 'N/A';

        // 4. Mandar todos los datos a la vista
        return view('historial_canalizaciones', [
            'alumno' => $alumno,
            'canalizaciones' => $canalizaciones,
            'totalCanalizaciones' => $totalCanalizaciones,
            'totalActivas' => $totalActivas,
            'totalCerradas' => $totalCerradas,
            'motivoComun' => $motivoComun,
        ]);
    }

    public function darDeBaja(Request $request, Alumno $alumno)
    {
        // 5. Validamos que el motivo de baja exista
        $data = $request->validate([
            'motivo_baja' => 'required|integer|exists:motivo_baja,pk_motivo_baja'
        ]);

        try {
            // 6. Iniciamos una transacción
            DB::transaction(function () use ($alumno, $data) {

                // --- ACCIÓN A ---
                // Actualizamos el estatus del alumno
                $alumno->estatus = 'Baja';
                $alumno->save();

                // --- ACCIÓN B ---
                // Creamos el registro en la tabla 'bajas'
                Baja::create([
                    'fk_alumno' => $alumno->pk_alumno,
                    'fk_motivo_baja' => $data['motivo_baja'],
                    'fecha' => Carbon::now(),
                    'estatus' => 'Activa' // Como define tu schema
                ]);

            }); // 7. Si todo salió bien, 'commit' (confirma) la transacción

        } catch (\Exception $e) {
            // 8. Si algo falló, revierte y manda un error
            return redirect()->back()
                ->with('error', 'Error al procesar la baja: ' . $e->getMessage());
        }

        // 9. Si todo salió bien, redirige
        return redirect()->route('canalizaciones')
            ->with('status', "El alumno {$alumno->nombre} ha sido dado de baja exitosamente.");
    }

    public function exportarInformeFinalPlantilla()
    {
        // --- 1. DEFINIR RUTA DE LA PLANTILLA ---
        $templatePath = storage_path('app/templates/INFORME FINAL.xlsx');

        if (!file_exists($templatePath)) {
            abort(500, "No se encontró el archivo de plantilla en: {$templatePath}.");
        }

        try {
            // --- 2. CARGAR LA PLANTILLA ---
            $spreadsheet = IOFactory::load($templatePath);
            $sheet = $spreadsheet->getSheetByName('INFORME FINAL'); // Asegúrate que el nombre de la hoja es EXACTO

            if (!$sheet) {
                // Si la hoja 'INFORME FINAL' no se encuentra, usa la primera disponible
                $sheet = $spreadsheet->getActiveSheet();
            }

            // --- 3. OBTENER DATOS DE LA BD (Filtrado y Agregaciones) ---
            // Estos datos son un EJEMPLO de cómo se podrían obtener.
            // Deberías añadir lógica para filtrar por grupo, periodo, etc.
            
            // Supongamos un ID de grupo específico para el ejemplo
            $grupoId = 1; // <--- ¡CAMBIA ESTO O PASALO COMO PARÁMETRO!
            $tutorNombre = 'L.I. Saúl Mendosa Mandujano'; // <--- ¡CAMBIA ESTO O PASALO COMO PARÁMETRO!
            $cuatrimestre = 'SEP - DIC 2024'; // <--- ¡CAMBIA ESTO O PASALO COMO PARÁMETRO!
            $carreraNombre = 'Tecnologías de la Información'; // <--- ¡CAMBIA ESTO O PASALO COMO PARÁMETRO!
            $nombreGrupo = 'TIC-403'; // <--- ¡CAMBIA ESTO O PASALO COMO PARÁMETRO!

            // 3.1 Datos del Alumno y Grupo asociado
            // Aquí cargamos los alumnos asociados al tutor/grupo que está generando el informe
            $alumnos = Alumno::with('grupo')
                              ->whereHas('grupo', function ($query) use ($grupoId) {
                                  $query->where('pk_grupo', $grupoId); // Filtrar por el grupo
                              })
                              ->orderBy('nombre')
                              ->get();

            // 3.2 Canalizaciones
            // Las canalizaciones asociadas a estos alumnos
            $canalizaciones = Canalizacion::with(['alumno', 'motivo'])
                                          ->whereIn('fk_alumno', $alumnos->pluck('pk_alumno'))
                                          ->get();

            // 3.3 Bajas
            // Las bajas de estos alumnos
            $bajas = Baja::with(['alumno', 'motivoBaja'])
                          ->whereIn('fk_alumno', $alumnos->pluck('pk_alumno'))
                          ->get();

            // 3.4 Actividades Tutoriales (asumiendo que hay una relación o filtro por grupo/tutor)
            // Aquí, por simplicidad, cargamos todas las actividades. Deberías filtrar.
            $actividadesTutoriales = Actividad::orderBy('fecha')->get(); 

            // --- 4. LLENAR CELDAS ESPECÍFICAS DE LA PLANTILLA ---

            // --- SECCIÓN DE ENCABEZADO ---
            $sheet->setCellValue('C4', $cuatrimestre);
            $sheet->setCellValue('G4', 'T.I.C.'); // Asumiendo división fija
            $sheet->setCellValue('C5', $carreraNombre);
            $sheet->setCellValue('G5', $nombreGrupo);
            $sheet->setCellValue('B6', $tutorNombre);

            // --- SECCIÓN: # DE TUTORÍAS GRUPALES PLANEADAS --- (Líneas 8-15)
            // Hay que rellenar estos conteos. Esto requiere lógica específica sobre cómo
            // defines cada situación (riesgo económico, salud, etc.) en tus canalizaciones o alumnos.
            // A continuación, se muestra un ejemplo.

            // Ejemplo: Contar canalizaciones por motivo para rellenar los N/A
            // Esto es muy específico a tu DB y lógica de negocio.
            $countRiesgoEconomico = $canalizaciones->filter(function($c) {
                return str_contains(strtolower($c->motivo->nombre), 'económic'); // Ejemplo de filtro
            })->count();
            $sheet->setCellValue('C9', $countRiesgoEconomico); 

            $countRiesgoSalud = $canalizaciones->filter(function($c) {
                return str_contains(strtolower($c->motivo->nombre), 'salud'); // Ejemplo de filtro
            })->count();
            $sheet->setCellValue('C10', $countRiesgoSalud);

            // Total de estudiantes detectados y derivados con riesgo en el ámbito de salud
            $countDetectadosSalud = $canalizaciones->filter(function($c) {
                return str_contains(strtolower($c->motivo->nombre), 'salud'); 
            })->unique('fk_alumno')->count(); // Contar alumnos únicos con ese motivo
            $sheet->setCellValue('C11', $countDetectadosSalud);

            // Total de estudiantes detectados y derivados con riesgo en el ámbito económico
            $countDetectadosEconomico = $canalizaciones->filter(function($c) {
                return str_contains(strtolower($c->motivo->nombre), 'económic'); 
            })->unique('fk_alumno')->count();
            $sheet->setCellValue('C12', $countDetectadosEconomico);

            // ... y así sucesivamente para cada uno de los conteos.
            // Para "continuarán en el siguiente cuatrimestre" vs "no continuarán", necesitas un campo de estatus futuro del alumno
            // Para "causaron baja sin canalización", necesitas cruzar datos entre alumnos y bajas.
            
            // Dejo los demás como '0' o 'N/A' si no tenemos la lógica exacta
            $sheet->setCellValue('C8', 'N/A'); // # de tutores detectados y derivados con riesgo económico (este es un conteo de tutores, no alumnos)
            $sheet->setCellValue('C13', 0); // Estudiantes que continúan derivados
            $sheet->setCellValue('C14', 0); // Estudiantes que no continúan derivados
            $sheet->setCellValue('C15', $bajas->filter(fn($b) => empty($canalizaciones->firstWhere('fk_alumno', $b->fk_alumno)))->count()); // Alumnos baja sin canalización
            $sheet->setCellValue('C16', $bajas->filter(fn($b) => empty($canalizaciones->firstWhere('fk_alumno', $b->fk_alumno)))->count()); // O el que sea

            // --- SECCIÓN: LISTADO DE ALUMNOS DEL GRUPO (FILA 17 en adelante) ---
            $filaInicioAlumnos = 17;
            $filaActualAlumnos = $filaInicioAlumnos;
            foreach ($alumnos as $index => $alumno) {
                $sheet->setCellValue('A' . $filaActualAlumnos, $index + 1);
                $sheet->setCellValue('B' . $filaActualAlumnos, $alumno->nombre_completo);
                
                // Estos campos (C,D,E,F,G,H,I,J,K) son situaciones (académica, psicológica, etc.).
                // Necesitas tener esta información asociada al alumno (ej. en la tabla 'formato_canalizacion'
                // o directamente en el modelo Alumno como un campo de riesgo).
                // Por ahora, pondremos "N/A" o "X" de ejemplo.
                // Ejemplo: Si el alumno tiene alguna canalización de tipo 'Académica'
                $tieneRiesgoAcademico = $canalizaciones->where('fk_alumno', $alumno->pk_alumno)
                                                        ->filter(function($c) {
                                                            return str_contains(strtolower($c->motivo->nombre), 'académic');
                                                        })->isNotEmpty();
                $sheet->setCellValue('C' . $filaActualAlumnos, $tieneRiesgoAcademico ? 'X' : 'N/A');
                // Repite esto para otras situaciones (Psicologica, Economica, etc.)
                $sheet->setCellValue('D' . $filaActualAlumnos, 'N/A'); 
                $sheet->setCellValue('E' . $filaActualAlumnos, 'N/A'); 
                $sheet->setCellValue('F' . $filaActualAlumnos, 'N/A'); 
                $sheet->setCellValue('G' . $filaActualAlumnos, 'N/A'); 
                $sheet->setCellValue('H' . $filaActualAlumnos, 'N/A'); 
                $sheet->setCellValue('I' . $filaActualAlumnos, 'N/A'); 
                $sheet->setCellValue('J' . $filaActualAlumnos, 'N/A'); 
                $sheet->setCellValue('K' . $filaActualAlumnos, 'N/A');

                $filaActualAlumnos++;
            }

            // Despues de listar los alumnos, la siguiente sección "REGISTRO DE CANALIZACIONES"
            // comienza en la FILA 39. Debemos asegurarnos de que la lista de alumnos no la sobrescriba.
            // Si la lista de alumnos es muy larga, esto causará problemas.
            // Considera hacer la plantilla dinámica o limitar el número de alumnos.
            $filaInicioCanalizaciones = 39;
            $filaActualCanalizaciones = $filaInicioCanalizaciones; 
            
            // --- SECCIÓN: REGISTRO DE CANALIZACIONES (FILA 39 en adelante) ---
            foreach ($canalizaciones as $index => $canalizacion) {
                // Aquí usamos 'alumno' y 'motivo' de las relaciones cargadas
                $sheet->setCellValue('A' . $filaActualCanalizaciones, $index + 1);
                $sheet->setCellValue('B' . $filaActualCanalizaciones, $canalizacion->alumno->nombre_completo ?? 'N/A');
                $sheet->setCellValue('C' . $filaActualCanalizaciones, $canalizacion->motivo->nombre ?? 'N/A');
                $sheet->setCellValue('D' . $filaActualCanalizaciones, $canalizacion->estatus); // Estatus o Área (según tu columna)
                $sheet->setCellValue('E' . $filaActualCanalizaciones, Carbon::parse($canalizacion->fecha_inicio)->format('d-m-Y'));
                $sheet->setCellValue('F' . $filaActualCanalizaciones, $canalizacion->fecha_final ? Carbon::parse($canalizacion->fecha_final)->format('d-m-Y') : 'N/A');
                $filaActualCanalizaciones++;
            }
            
            // --- SECCIÓN: BAJAS (FILA 51 en adelante) ---
            $filaInicioBajas = 51;
            $filaActualBajas = $filaInicioBajas;
            foreach ($bajas as $index => $baja) {
                $sheet->setCellValue('A' . $filaActualBajas, $index + 1);
                $sheet->setCellValue('B' . $filaActualBajas, $baja->alumno->nombre_completo ?? 'N/A');
                $sheet->setCellValue('C' . $filaActualBajas, $baja->motivoBaja->nombre ?? 'N/A');
                $sheet->setCellValue('E' . $filaActualBajas, Carbon::parse($baja->fecha)->format('d-m-Y'));
                $filaActualBajas++;
            }

            // --- SECCIÓN: ACCIONES TUTORIALES GRUPALES / INDIVIDUALES (FILA 58 en adelante) ---
            $filaInicioActividades = 58;
            $filaActualActividades = $filaInicioActividades;
            foreach ($actividadesTutoriales as $index => $actividad) {
                $sheet->setCellValue('A' . $filaActualActividades, $index + 1);
                $sheet->setCellValue('B' . $filaActualActividades, $actividad->nombre); // Nombre de la actividad
                $sheet->setCellValue('D' . $filaActualActividades, Carbon::parse($actividad->fecha)->format('d-m-Y')); // Fecha
                $sheet->setCellValue('E' . $filaActualActividades, $actividad->asistencia); // Asistencia
                // Otros campos (F, G, H, I, J, K) deben ser mapeados si existen en tu modelo Actividad
                $filaActualActividades++;
            }
            
            // --- SECCIÓN DE TOTALES Y FIRMAS (después de las acciones) ---
            // Estos valores se pondrán justo debajo de la última actividad listada.
            // Necesitas ajustar el +X según el número de filas que se deben dejar.
            $filaFinalReporte = $filaActualActividades + 3; // Ajusta este número según tu plantilla
            
            $sheet->setCellValue('B' . $filaFinalReporte, $alumnos->count()); // TOTAL DE ALUMNOS ATENDIDOS
            $sheet->setCellValue('B' . ($filaFinalReporte + 1), $canalizaciones->count()); // ALUMNOS CANALIZADOS
            $sheet->setCellValue('B' . ($filaFinalReporte + 2), 0); // ALUMNOS EN RIESGO (Necesitas definir la lógica para esto)
            $sheet->setCellValue('B' . ($filaFinalReporte + 3), $bajas->count()); // ALUMNOS DADOS DE BAJA

            // --- 5. CREAR EL ARCHIVO Y ENVIARLO AL NAVEGADOR ---
            $writer = new Xlsx($spreadsheet);

            // Asegura que el archivo se descargue
            $response = new StreamedResponse(function() use ($writer) {
                $writer->save('php://output');
            });

            $fileName = 'Informe_Final_Tutoria_' . Carbon::now()->format('Ymd_His') . '.xlsx';
            $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
            $response->headers->set('Cache-Control', 'max-age=0');
            $response->headers->set('Pragma', 'public');

            return $response;

        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->back()->with('error', 'Error al generar el reporte: ' . $e->getMessage());
        }
    }

    public function exportarFormatoPDF(Canalizacion $canalizacion)
    {
        // 1. Cargamos el alumno y grupo (ya lo hace el binding)
        $canalizacion->load('alumno.grupo', 'motivo');

        // 2. Buscamos el "formato" que corresponde al MISMO ALUMNO
        // Usamos la misma lógica que en el método show()
        $formato = FormatoCanalizacion::where('fk_alumno', $canalizacion->fk_alumno)
                                      ->orderBy('fecha_canalizacion', 'desc')
                                      ->first();

        // 3. Pasamos los datos a la vista PDF que creamos
        $pdf = Pdf::loadView('reportes.formato-canalizacion-pdf', [
            'canalizacion' => $canalizacion,
            'formato' => $formato
        ]);

        // 4. Creamos un nombre de archivo dinámico
        $fileName = 'Formato_Canalizacion_' . $canalizacion->alumno->pk_alumno . '.pdf';

        // 5. Devolvemos el PDF para descargar
        return $pdf->download($fileName);
    }
}