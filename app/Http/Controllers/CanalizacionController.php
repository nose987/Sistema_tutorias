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
        $canalizaciones = Canalizacion::with(['alumno.grupo', 'motivo'])
            ->where('estatus', 'Activa')
            ->get();

        $total_canalizaciones = $canalizaciones->count();

        $motivo_comun = Canalizacion::join('motivo_canalizacion', 'canalizacion.fk_motivo_canalizacion', '=', 'motivo_canalizacion.pk_motivo_canalizacion')
            ->select('motivo_canalizacion.nombre', DB::raw('COUNT(*) as total'))
            ->groupBy('motivo_canalizacion.pk_motivo_canalizacion', 'motivo_canalizacion.nombre')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->first();

        $bajas = Baja::with(['alumno', 'motivoBaja'])
            ->orderBy('fecha', 'desc')
            ->get();

        $total_bajas = $bajas->count();

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
        $canalizacion->load(['alumno.grupo', 'motivo']);

        $formato = FormatoCanalizacion::where('fk_alumno', $canalizacion->fk_alumno)
            ->orderBy('fecha_canalizacion', 'desc')
            ->first();

        $motivos_baja = MotivoBaja::all();

        return view('detalle_canalizacion_alumno', [
            'canalizacion' => $canalizacion,
            'formato' => $formato,
            'motivos_baja' => $motivos_baja,
        ]);
    }

    public function showFormato(Canalizacion $canalizacion)
    {
        $canalizacion->load('alumno.grupo');

        return view('canalizaciones_formato', [
            'canalizacion' => $canalizacion,
        ]);
    }


    public function storeFormato(Request $request, Canalizacion $canalizacion)
    {
        $data = $request->validate([
            'fecha_canalizacion' => 'required|date',
            'tutor_nombre' => 'required|string|max:255',
            'carrera' => 'required|string|max:150',
            'motivo_otros' => 'nullable|string',
            'observaciones_tutor' => 'nullable|string',
            'acciones_tutor' => 'nullable|string',
        ]);

        $data['fk_alumno'] = $canalizacion->fk_alumno;

        $data['motivo_reprobacion'] = $request->has('motivo_reprobacion') ? 1 : 0;
        $data['motivo_constantes_faltas'] = $request->has('motivo_constantes_faltas') ? 1 : 0;
        $data['motivo_no_participa'] = $request->has('motivo_no_participa') ? 1 : 0;
        $data['motivo_no_entrega_actividades'] = $request->has('motivo_no_entrega_actividades') ? 1 : 0;
        $data['motivo_dificultad_asignatura'] = $request->has('motivo_dificultad_asignatura') ? 1 : 0;

        $data['motivo_inasistencia_distancia'] = $request->has('motivo_inasistencia_distancia') ? 1 : 0;
        $data['motivo_inasistencia_transporte'] = $request->has('motivo_inasistencia_transporte') ? 1 : 0;
        $data['motivo_inasistencia_enfermedad'] = $request->has('motivo_inasistencia_enfermedad') ? 1 : 0;
        $data['motivo_inasistencia_familiar'] = $request->has('motivo_inasistencia_familiar') ? 1 : 0;
        $data['motivo_inasistencia_personal'] = $request->has('motivo_inasistencia_personal') ? 1 : 0;

        $data['motivo_salud_dolor_cabeza'] = $request->has('motivo_salud_dolor_cabeza') ? 1 : 0;
        $data['motivo_salud_dolor_estomago'] = $request->has('motivo_salud_dolor_estomago') ? 1 : 0;
        $data['motivo_salud_dolor_muscular'] = $request->has('motivo_salud_dolor_muscular') ? 1 : 0;
        $data['motivo_salud_respiratorios'] = $request->has('motivo_salud_respiratorios') ? 1 : 0;
        $data['motivo_salud_vertigo'] = $request->has('motivo_salud_vertigo') ? 1 : 0;
        $data['motivo_salud_vomito'] = $request->has('motivo_salud_vomito') ? 1 : 0;

        $data['motivo_adiccion_ojos_rojos'] = $request->has('motivo_adiccion_ojos_rojos') ? 1 : 0;
        $data['motivo_adiccion_somnolencia'] = $request->has('motivo_adiccion_somnolencia') ? 1 : 0;
        $data['motivo_adiccion_aliento_alcoholico'] = $request->has('motivo_adiccion_aliento_alcoholico') ? 1 : 0;

        $data['motivo_comportamiento_agresivo'] = $request->has('motivo_comportamiento_agresivo') ? 1 : 0;
        $data['motivo_comportamiento_indisciplina'] = $request->has('motivo_comportamiento_indisciplina') ? 1 : 0;
        $data['motivo_comportamiento_desafiante'] = $request->has('motivo_comportamiento_desafiante') ? 1 : 0;
        $data['motivo_comportamiento_irrespetuoso'] = $request->has('motivo_comportamiento_irrespetuoso') ? 1 : 0;
        $data['motivo_comportamiento_desinteres'] = $request->has('motivo_comportamiento_desinteres') ? 1 : 0;

        $data['motivo_estres_frustracion'] = $request->has('motivo_estres_frustracion') ? 1 : 0;
        $data['motivo_estres_desmotivacion'] = $request->has('motivo_estres_desmotivacion') ? 1 : 0;
        $data['motivo_estres_cansancio'] = $request->has('motivo_estres_cansancio') ? 1 : 0;
        $data['motivo_estres_hiperactividad'] = $request->has('motivo_estres_hiperactividad') ? 1 : 0;
        $data['motivo_estres_ansiedad'] = $request->has('motivo_estres_ansiedad') ? 1 : 0;

        $data['motivo_socioeconomico_matrimonio'] = $request->has('motivo_socioeconomico_matrimonio') ? 1 : 0;
        $data['motivo_socioeconomico_embarazo'] = $request->has('motivo_socioeconomico_embarazo') ? 1 : 0;
        $data['motivo_socioeconomico_no_desea_estudiar'] = $request->has('motivo_socioeconomico_no_desea_estudiar') ? 1 : 0;
        $data['motivo_socioeconomico_decidio_trabajar'] = $request->has('motivo_socioeconomico_decidio_trabajar') ? 1 : 0;
        $data['motivo_socioeconomico_horario_laboral'] = $request->has('motivo_socioeconomico_horario_laboral') ? 1 : 0;
        $data['motivo_socioeconomico_pago_mensualidades'] = $request->has('motivo_socioeconomico_pago_mensualidades') ? 1 : 0;
        $data['motivo_socioeconomico_transporte'] = $request->has('motivo_socioeconomico_transporte') ? 1 : 0;
        $data['motivo_socioeconomico_manutencion'] = $request->has('motivo_socioeconomico_manutencion') ? 1 : 0;

        $data['motivo_faltas_ebrio'] = $request->has('motivo_faltas_ebrio') ? 1 : 0;
        $data['motivo_faltas_drogado'] = $request->has('motivo_faltas_drogado') ? 1 : 0;
        $data['motivo_faltas_vandalismo'] = $request->has('motivo_faltas_vandalismo') ? 1 : 0;
        $data['motivo_faltas_porta_armas_drogas'] = $request->has('motivo_faltas_porta_armas_drogas') ? 1 : 0;

        FormatoCanalizacion::create($data);

        return redirect()->route('canalizaciones.show', $canalizacion)
            ->with('status', 'Formato de canalización guardado con éxito.');
    }

    public function storeSeguimiento(Request $request, Canalizacion $canalizacion)
    {
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
            'finalizar_canalizacion' => 'nullable|boolean'
        ]);

     
        CanalizacionSeguimiento::create($data);

       
        if ($request->has('finalizar_canalizacion') && $request->input('finalizar_canalizacion') == '1') {
            $canalizacion->estatus = 'Cerrada';
            $canalizacion->fecha_final = Carbon::now();
            $canalizacion->save();
        }
       
        return redirect()->route('canalizaciones.show', $canalizacion)
            ->with('status', 'Seguimiento CAIE guardado con éxito.');
    }


    public function showHistorial(Alumno $alumno)
    {
        $canalizaciones = Canalizacion::with(['motivo', 'formato.seguimientos'])
            ->where('fk_alumno', $alumno->pk_alumno)
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        $totalCanalizaciones = $canalizaciones->count();
        $totalActivas = $canalizaciones->where('estatus', 'Activa')->count();
        $totalCerradas = $canalizaciones->where('estatus', 'Cerrada')->count();

        $motivoComun = $canalizaciones->countBy('motivo.nombre')
            ->sortDesc()
            ->keys()
            ->first() ?? 'N/A';

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
        $data = $request->validate([
            'motivo_baja' => 'required|integer|exists:motivo_baja,pk_motivo_baja'
        ]);

        try {
            DB::transaction(function () use ($alumno, $data) {

                $alumno->estatus = 'Baja';
                $alumno->save();

                Baja::create([
                    'fk_alumno' => $alumno->pk_alumno,
                    'fk_motivo_baja' => $data['motivo_baja'],
                    'fecha' => Carbon::now(),
                    'estatus' => 'Activa'
                ]);
            });
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al procesar la baja: ' . $e->getMessage());
        }

        return redirect()->route('canalizaciones')
            ->with('status', "El alumno {$alumno->nombre} ha sido dado de baja exitosamente.");
    }

    public function exportarInformeFinalPlantilla()
    {
        $templatePath = storage_path('app/templates/INFORME FINAL.xlsx');

        if (!file_exists($templatePath)) {
            abort(500, "No se encontró el archivo de plantilla en: {$templatePath}.");
        }

        try {
            $spreadsheet = IOFactory::load($templatePath);
            $sheet = $spreadsheet->getSheetByName('INFORME FINAL');

            if (!$sheet) {
                $sheet = $spreadsheet->getActiveSheet();
            }


            $grupoId = 1;
            $tutorNombre = 'L.I. Saúl Mendosa Mandujano';
            $cuatrimestre = 'SEP - DIC 2024';
            $carreraNombre = 'Tecnologías de la Información';
            $nombreGrupo = 'TIC-403';

            $alumnos = Alumno::with('grupo')
                ->whereHas('grupo', function ($query) use ($grupoId) {
                    $query->where('pk_grupo', $grupoId);
                })
                ->orderBy('nombre')
                ->get();

            $canalizaciones = Canalizacion::with(['alumno', 'motivo'])
                ->whereIn('fk_alumno', $alumnos->pluck('pk_alumno'))
                ->get();

            $bajas = Baja::with(['alumno', 'motivoBaja'])
                ->whereIn('fk_alumno', $alumnos->pluck('pk_alumno'))
                ->get();

            $actividadesTutoriales = Actividad::orderBy('fecha')->get();

            $sheet->setCellValue('C4', $cuatrimestre);
            $sheet->setCellValue('G4', 'T.I.C.');
            $sheet->setCellValue('C5', $carreraNombre);
            $sheet->setCellValue('G5', $nombreGrupo);
            $sheet->setCellValue('B6', $tutorNombre);


            $countRiesgoEconomico = $canalizaciones->filter(function ($c) {
                return str_contains(strtolower($c->motivo->nombre), 'económic');
            })->count();
            $sheet->setCellValue('C9', $countRiesgoEconomico);

            $countRiesgoSalud = $canalizaciones->filter(function ($c) {
                return str_contains(strtolower($c->motivo->nombre), 'salud');
            })->count();
            $sheet->setCellValue('C10', $countRiesgoSalud);

            $countDetectadosSalud = $canalizaciones->filter(function ($c) {
                return str_contains(strtolower($c->motivo->nombre), 'salud');
            })->unique('fk_alumno')->count();
            $sheet->setCellValue('C11', $countDetectadosSalud);

            $countDetectadosEconomico = $canalizaciones->filter(function ($c) {
                return str_contains(strtolower($c->motivo->nombre), 'económic');
            })->unique('fk_alumno')->count();
            $sheet->setCellValue('C12', $countDetectadosEconomico);


            $sheet->setCellValue('C8', 'N/A');
            $sheet->setCellValue('C13', 0);
            $sheet->setCellValue('C14', 0);
            $sheet->setCellValue('C15', $bajas->filter(fn($b) => empty($canalizaciones->firstWhere('fk_alumno', $b->fk_alumno)))->count());
            $sheet->setCellValue('C16', $bajas->filter(fn($b) => empty($canalizaciones->firstWhere('fk_alumno', $b->fk_alumno)))->count());

            $filaInicioAlumnos = 17;
            $filaActualAlumnos = $filaInicioAlumnos;
            foreach ($alumnos as $index => $alumno) {
                $sheet->setCellValue('A' . $filaActualAlumnos, $index + 1);
                $sheet->setCellValue('B' . $filaActualAlumnos, $alumno->nombre_completo);


                $tieneRiesgoAcademico = $canalizaciones->where('fk_alumno', $alumno->pk_alumno)
                    ->filter(function ($c) {
                        return str_contains(strtolower($c->motivo->nombre), 'académic');
                    })->isNotEmpty();
                $sheet->setCellValue('C' . $filaActualAlumnos, $tieneRiesgoAcademico ? 'X' : 'N/A');
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


            $filaInicioCanalizaciones = 39;
            $filaActualCanalizaciones = $filaInicioCanalizaciones;

            foreach ($canalizaciones as $index => $canalizacion) {
                $sheet->setCellValue('A' . $filaActualCanalizaciones, $index + 1);
                $sheet->setCellValue('B' . $filaActualCanalizaciones, $canalizacion->alumno->nombre_completo ?? 'N/A');
                $sheet->setCellValue('C' . $filaActualCanalizaciones, $canalizacion->motivo->nombre ?? 'N/A');
                $sheet->setCellValue('D' . $filaActualCanalizaciones, $canalizacion->estatus);
                $sheet->setCellValue('E' . $filaActualCanalizaciones, Carbon::parse($canalizacion->fecha_inicio)->format('d-m-Y'));
                $sheet->setCellValue('F' . $filaActualCanalizaciones, $canalizacion->fecha_final ? Carbon::parse($canalizacion->fecha_final)->format('d-m-Y') : 'N/A');
                $filaActualCanalizaciones++;
            }

            $filaInicioBajas = 51;
            $filaActualBajas = $filaInicioBajas;
            foreach ($bajas as $index => $baja) {
                $sheet->setCellValue('A' . $filaActualBajas, $index + 1);
                $sheet->setCellValue('B' . $filaActualBajas, $baja->alumno->nombre_completo ?? 'N/A');
                $sheet->setCellValue('C' . $filaActualBajas, $baja->motivoBaja->nombre ?? 'N/A');
                $sheet->setCellValue('E' . $filaActualBajas, Carbon::parse($baja->fecha)->format('d-m-Y'));
                $filaActualBajas++;
            }

            $filaInicioActividades = 58;
            $filaActualActividades = $filaInicioActividades;
            foreach ($actividadesTutoriales as $index => $actividad) {
                $sheet->setCellValue('A' . $filaActualActividades, $index + 1);
                $sheet->setCellValue('B' . $filaActualActividades, $actividad->nombre);
                $sheet->setCellValue('D' . $filaActualActividades, Carbon::parse($actividad->fecha)->format('d-m-Y'));
                $sheet->setCellValue('E' . $filaActualActividades, $actividad->asistencia);

                $filaActualActividades++;
            }


            $filaFinalReporte = $filaActualActividades + 3;

            $sheet->setCellValue('B' . $filaFinalReporte, $alumnos->count());
            $sheet->setCellValue('B' . ($filaFinalReporte + 1), $canalizaciones->count());
            $sheet->setCellValue('B' . ($filaFinalReporte + 2), 0);
            $sheet->setCellValue('B' . ($filaFinalReporte + 3), $bajas->count());

            $writer = new Xlsx($spreadsheet);

            $response = new StreamedResponse(function () use ($writer) {
                $writer->save('php://output');
            });

            $fileName = 'Informe_Final_Tutoria_' . Carbon::now()->format('Ymd_His') . '.xlsx';
            $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
            $response->headers->set('Cache-Control', 'max-age=0');
            $response->headers->set('Pragma', 'public');

            return $response;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al generar el reporte: ' . $e->getMessage());
        }
    }

    public function exportarFormatoPDF(Canalizacion $canalizacion)
    {
        $canalizacion->load('alumno.grupo', 'motivo');

        $formato = FormatoCanalizacion::where('fk_alumno', $canalizacion->fk_alumno)
            ->orderBy('fecha_canalizacion', 'desc')
            ->first();

        $pdf = Pdf::loadView('reportes.formato-canalizacion-pdf', [
            'canalizacion' => $canalizacion,
            'formato' => $formato
        ]);

        $fileName = 'Formato_Canalizacion_' . $canalizacion->alumno->pk_alumno . '.pdf';

        return $pdf->download($fileName);
    }
}
