<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpcionEstadia;
use App\Models\Empresa;
use App\Models\Alumno; // <--- ¡IMPORTANTE! Añade este modelo
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
    //  AÑADE ESTE NUEVO MÉTODO PARA LA PÁGINA DE "REPORTES FINALES"
    // ===================================================================

    /**
     * Muestra la página de "Reportes Finales" con alumnos confirmados.
     */
// ... en ReporteEstadiaController.php
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
}