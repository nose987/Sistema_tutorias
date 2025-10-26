<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MotivoCanalizacion;
use App\Models\Canalizacion;
use Illuminate\Support\Facades\DB;
class CanalizacionController extends Controller
{
    public function index()
    {
        $canalizaciones = Canalizacion::with(['alumno.grupo', 'motivo'])
                            ->where('estatus', 'Activa') // Opcional: solo muestra las activas
                            ->get();


        $total_canalizaciones = $canalizaciones->count();

       $motivo_comun = Canalizacion::join('motivo_canalizacion', 'canalizacion.fk_motivo_canalizacion', '=', 'motivo_canalizacion.pk_motivo_canalizacion')
                            ->select('motivo_canalizacion.nombre', DB::raw('COUNT(*) as total'))
                            ->groupBy('motivo_canalizacion.pk_motivo_canalizacion', 'motivo_canalizacion.nombre')
                            ->orderByRaw('COUNT(*) DESC')
                            ->limit(1)
                            ->first();
        // 3. Pasamos los datos a la vista
        return view('canalizaciones', [
            'canalizaciones' => $canalizaciones,
            'total_canalizaciones' => $total_canalizaciones,
            'motivo_comun' => $motivo_comun
        ]);
    }

    

    public function motivo_comun(){

    }
}
