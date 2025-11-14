<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpcionEstadia;
use App\Models\Empresa;
use App\Models\Alumno; // <-- ¡Asegúrate de tener este!
use Illuminate\Support\Facades\DB;

class ReporteEstadiaController extends Controller
{
    /**
     * Muestra el dashboard de estadísticas generales de estadías.
     * (Este es el método que tú ya tenías)
     */
    public function index()
    {
        // --- 1. Calcular Conteos Generales ---
        $conteosPorEstatus = OpcionEstadia::select('estatus', DB::raw('count(*) as total'))
                                        ->groupBy('estatus')
                                        ->pluck('total', 'estatus');

        $totalOpciones = $conteosPorEstatus->sum();

        // Preparamos un array con los datos para las tarjetas
        $stats = [
            'Aceptado' => [
                'count' => $conteosPorEstatus->get('Aceptado', 0),
                'color' => 'text-green-600',
                'desc' => 'Con estadía confirmada'
            ],
            'Pendiente' => [
                'count' => $conteosPorEstatus->get('Pendiente', 0),
                'color' => 'text-yellow-500',
                'desc' => 'En espera de respuesta'
            ],
            'Contactado' => [
                'count' => $conteosPorEstatus->get('Contactado', 0),
                'color' => 'text-orange-500',
                'desc' => 'En proceso de contacto'
            ],
            'Rechazado' => [
                'count' => $conteosPorEstatus->get('Rechazado', 0),
                'color' => 'text-red-600',
                'desc' => 'Necesitan nueva opción'
            ],
            'No Contactado' => [
                'count' => $conteosPorEstatus->get('No Contactado', 0),
                'color' => 'text-gray-900',
                'desc' => 'Por gestionar'
            ],
        ];

        // Añadir porcentajes
        if ($totalOpciones > 0) {
            foreach ($stats as $key => $value) {
                $stats[$key]['percentage'] = round(($value['count'] / $totalOpciones) * 100);
            }
        } else {
            foreach ($stats as $key => $value) {
                $stats[$key]['percentage'] = 0;
            }
        }


        // --- 2. Calcular Ranking de Empresas ---
        $ranking = OpcionEstadia::select(
                            'fk_empresa',
                            DB::raw('count(*) as interesados'),
                            DB::raw('SUM(CASE WHEN estatus = "Aceptado" THEN 1 ELSE 0 END) as aceptados'),
                            DB::raw('SUM(CASE WHEN estatus = "Pendiente" THEN 1 ELSE 0 END) as pendientes'),
                            DB::raw('SUM(CASE WHEN estatus = "Contactado" THEN 1 ELSE 0 END) as contactados'),
                            DB::raw('SUM(CASE WHEN estatus = "Rechazado" THEN 1 ELSE 0 END) as rechazados')
                        )
                        ->groupBy('fk_empresa')
                        ->orderByDesc('interesados')
                        ->with('empresa:pk_empresa,nombre')
                        ->get();


        // --- 3. Pasar Datos a la Vista ---
        // Esta es la vista de tu DASHBOARD
        return view('layouts.reporte-estadias', [
            'stats' => $stats,
            'totalOpciones' => $totalOpciones,
            'empresasRankeadas' => $ranking,
        ]);
    }


    // ===================================================================
    //  MÉTODO PARA LA PÁGINA DE "REPORTES FINALES"
    // ===================================================================

    /**
     * Muestra la página de "Reportes Finales" con alumnos confirmados.
     * (Este es el método que tú ya tenías)
     */
    public function finales()
    {
        $alumnosConfirmados = Alumno::
            // 1. Busca alumnos que SÍ tengan al menos una opción ACEPTADA
            whereHas('opcionesEstadia', function ($query) {
                $query->where('estatus', 'Aceptado');
            })
            
            // 2. Y que ADEMÁS, NO TENGAN ninguna opción pendiente de revisión
            ->whereDoesntHave('opcionesEstadia', function ($query) {
                $query->whereIn('estatus', ['Pendiente', 'Contactado', 'No Contactado']);
            })
            
            // 3. Carga las relaciones (igual que antes)
            ->with([
                'opcionesEstadia' => function ($query) {
                    $query->whereIn('opcion_numero', [1, 2, 3])
                            ->with('empresa');
                },
            ])
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->orderBy('nombre')
            ->get();

        // 4. Manda los datos a la vista (igual que antes)
        return view('layouts.reporte-final', [
            'alumnosConfirmados' => $alumnosConfirmados
        ]);
    }


    // ===================================================================
    //            ¡NUEVO MÉTODO CORREGIDO!
    // ===================================================================

    /**
     * Confirma la estadía final de un alumno, especificando la opción ganadora.
     * Rechaza todas las demás opciones.
     *
     * @param Request $request
     * @param Alumno $alumno
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmarFinal(Request $request, Alumno $alumno)
    {
        // 1. Validar que nos enviaron el ID de la opción ganadora desde el JS
        $request->validate([
            'opcion_final_id' => 'required|integer|exists:opciones_estadia,pk_opcion_estadia'
        ], [
            'opcion_final_id.required' => 'No se especificó una opción final.'
        ]);

        $opcionFinalId = $request->input('opcion_final_id');

        // 2. Seguridad: Verificar que la opción pertenezca al alumno
        $opcionGanadora = OpcionEstadia::find($opcionFinalId);
        
        // Comprobamos que la opción es del alumno
        if ($opcionGanadora->fk_alumno != $alumno->pk_alumno) {
            return response()->json([
                'message' => 'Error: Esta opción no pertenece al alumno seleccionado.'
            ], 403); // 403 Forbidden
        }
        
        // Comprobamos que la opción estuviera 'Aceptada'
        if ($opcionGanadora->estatus != 'Aceptado') {
             return response()->json([
                'message' => 'Error: La opción seleccionada no tiene estatus Aceptado.'
            ], 400); // 400 Bad Request
        }

        // 3. Confirmar la opción ganadora (ya estaba 'Aceptado', pero lo aseguramos)
        $opcionGanadora->save(); // (No cambia estatus, solo por si acaso)

        // 4. Rechazar TODAS las OTRAS opciones del alumno (las que no son la ganadora)
        OpcionEstadia::where('fk_alumno', $alumno->pk_alumno)
                    ->where('pk_opcion_estadia', '!=', $opcionFinalId)
                    ->update(['estatus' => 'Rechazado']);

        // 5. Enviar respuesta de éxito
        return response()->json([
            'message' => '¡Estadía confirmada! El alumno ha sido finalizado y las demás opciones han sido rechazadas.'
        ]);
    }
}