<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Observacion;
use Illuminate\Http\Request;

class ObservacionController extends Controller
{
    /**
     * Almacena una nueva observación para un alumno.
     */
    public function store(Request $request, Alumno $alumno)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:150',
            'observacion' => 'required|string',
        ]);

        // Crea la observación asociada al alumno
        $alumno->observaciones()->create([
            'nombre'      => $data['nombre'],
            'observacion' => $data['observacion'],
        ]);

        return back()->with('status', 'Observación registrada correctamente.');
    }

    /**
     * Elimina una observación específica.
     */
    public function destroy(Observacion $observacion)
    {
        // Guarda el ID del alumno *antes* de borrar la observación
        $alumnoId = $observacion->fk_alumno;
        
        $observacion->delete();

        // Redirige de vuelta al perfil del alumno
        return redirect()->route('detalle_alumno', $alumnoId)
            ->with('status', 'Observación eliminada.');
    }
}