<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\OpcionEstadia; // Necesitamos este modelo
    use App\Models\Empresa;       // Y este
    use Illuminate\Support\Facades\DB; // Para cálculos más directos

    class ReporteEstadiaController extends Controller
    {
        /**
         * Muestra la vista del reporte con datos calculados.
         */
        public function index()
        {
            // --- 1. Calcular Conteos Generales ---
            $conteosPorEstatus = OpcionEstadia::select('estatus', DB::raw('count(*) as total'))
                                            ->groupBy('estatus')
                                            ->pluck('total', 'estatus'); // Crea un array ['Estatus' => total]

            $totalOpciones = $conteosPorEstatus->sum(); // Suma total para porcentajes

            // Preparamos un array con los datos para las tarjetas
            $stats = [
                'Aceptado' => [
                    'count' => $conteosPorEstatus->get('Aceptado', 0), // Usa 0 si no hay
                    'color' => 'text-green-600',
                    'desc' => 'Con estadía confirmada'
                ],
                'Pendiente' => [
                    'count' => $conteosPorEstatus->get('Pendiente', 0) + $conteosPorEstatus->get('Contactado', 0), // Sumamos Pendiente y Contactado
                    'color' => 'text-orange-500',
                    'desc' => 'En proceso de contacto'
                ],
                 'Rechazado' => [
                    'count' => $conteosPorEstatus->get('Rechazado', 0),
                    'color' => 'text-red-600',
                    'desc' => 'Necesitan nueva opción'
                 ],
                'Sin Contactar' => [
                    'count' => $conteosPorEstatus->get('No Contactado', 0),
                     // Podríamos asignar un color gris, pero el original usa negro
                    'color' => 'text-gray-900',
                    'desc' => 'Por gestionar'
                ],
            ];

            // Añadir porcentajes (si hay opciones)
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
                                DB::raw('count(*) as interesados'), // Total de veces que aparece la empresa
                                DB::raw('SUM(CASE WHEN estatus = "Aceptado" THEN 1 ELSE 0 END) as aceptados'),
                                // Sumamos Pendiente y Contactado para el ranking también
                                DB::raw('SUM(CASE WHEN estatus IN ("Pendiente", "Contactado") THEN 1 ELSE 0 END) as pendientes'),
                                DB::raw('SUM(CASE WHEN estatus = "Rechazado" THEN 1 ELSE 0 END) as rechazados')
                                // Podríamos añadir 'No Contactado' si fuera necesario
                            )
                            ->groupBy('fk_empresa')
                            ->orderByDesc('interesados') // Ordenar por más interesados
                            ->with('empresa:pk_empresa,nombre') // Cargar solo el ID y nombre de la empresa relacionada
                            ->get();


            // --- 3. Pasar Datos a la Vista ---
            return view('layouts.reporte-estadias', [
                'stats' => $stats,
                'totalOpciones' => $totalOpciones,
                'empresasRankeadas' => $ranking,
            ]);
        }

        // Podrías añadir aquí el método para generar el PDF después
        // public function generarPdf() { ... }
    }
  
