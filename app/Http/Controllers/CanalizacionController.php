<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Canalizacion;
use App\Models\FormatoCanalizacion;
use App\Models\CanalizacionSeguimiento;
use App\Models\MotivoBaja;
use App\Models\Baja;
use carbon\Carbon;


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
}
