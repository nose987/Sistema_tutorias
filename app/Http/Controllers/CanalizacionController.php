<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MotivoCanalizacion;
use App\Models\Canalizacion;

class CanalizacionController extends Controller
{
    public function index()
    {
        $canalizaciones = Canalizacion::with(['alumno.grupo', 'motivo'])
                            ->where('estatus', 'Activa') // Opcional: solo muestra las activas
                            ->get();

        // 3. Pasamos los datos a la vista
        return view('canalizaciones', [
            'canalizaciones' => $canalizaciones
        ]);
    }
}
