<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Empresa;
use App\Models\OpcionEstadia; // <-- ¡Importar el nuevo modelo!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Para depuración

class EstadiaController extends Controller
{
    /**
     * Muestra la página principal de gestión de estadías.
     */
    public function index()
    {
        // ========================================================
        // ¡IMPORTANTE! Cargar la relación 'opcionesEstadia.empresa'
        // ========================================================
        $alumnos = Alumno::with('opcionesEstadia.empresa')
                         ->where('estatus', 'Activo') // O la lógica que uses
                         ->get();
                         
        $empresas = Empresa::where('estatus', 'Activa')->get();

        return view('estadias.index', [ // Asegúrate que el nombre de tu vista sea correcto
            'alumnos' => $alumnos,
            'empresas' => $empresas
        ]);
    }

    /**
     * Actualiza las empresas asignadas a un alumno (lógica del MODAL).
     */
    public function updateOpciones(Request $request, Alumno $alumno)
    {
        $validated = $request->validate([
            'opcion_1_id' => 'nullable|integer|exists:empresa,pk_empresa',
            'opcion_2_id' => 'nullable|integer|exists:empresa,pk_empresa',
            'opcion_3_id' => 'nullable|integer|exists:empresa,pk_empresa',
        ]);

        try {
            // Usamos un array para iterar
            $opciones = [
                1 => $validated['opcion_1_id'] ?? null,
                2 => $validated['opcion_2_id'] ?? null,
                3 => $validated['opcion_3_id'] ?? null,
            ];

            foreach ($opciones as $num => $empresa_id) {
                if ($empresa_id) {
                    // Si hay ID de empresa, actualiza o crea el registro
                    OpcionEstadia::updateOrCreate(
                        [
                            'fk_alumno' => $alumno->pk_alumno,
                            'opcion_numero' => $num
                        ],
                        [
                            'fk_empresa' => $empresa_id,
                            'estatus' => 'Pendiente' // Se resetea a Pendiente al cambiar la empresa
                        ]
                    );
                } else {
                    // Si el ID es nulo, elimina el registro (si existía)
                    OpcionEstadia::where('fk_alumno', $alumno->pk_alumno)
                                 ->where('opcion_numero', $num)
                                 ->delete();
                }
            }
            
            return response()->json(['success' => true, 'message' => 'Opciones de estadía actualizadas.']);

        } catch (\Exception $e) {
            Log::error('Error al actualizar opciones: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error del servidor al actualizar opciones.'], 500);
        }
    }


    /**
     * Actualiza el ESTATUS de una opción de estadía (lógica del DROPDOWN).
     */
    public function updateStatus(Request $request, OpcionEstadia $opcion)
    {
        // El {opcion} en la ruta (Route Model Binding) encuentra la OpcionEstadia por su PK
        
        $validated = $request->validate([
            'estatus' => 'required|string|in:Pendiente,Contactado,No Contactado,Aceptado,Rechazado',
        ]);

        try {
            $opcion->update(['estatus' => $validated['estatus']]);
            
            return response()->json(['success' => true, 'message' => 'Estatus actualizado.']);

        } catch (\Exception $e) {
            Log::error('Error al actualizar estatus: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error del servidor al actualizar estatus.'], 500);
        }
    }
}
