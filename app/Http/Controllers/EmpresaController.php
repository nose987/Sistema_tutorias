<?php

namespace App\Http\Controllers;

use App\Models\Empresa; // ¡Importa tu modelo!
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    // ... otros métodos ...

    /**
     * Actualiza la empresa especificada.
     */
    public function update(Request $request, Empresa $empresa)
    {
        // Validación (ajusta según tus reglas)
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'nombre_contacto' => 'nullable|string|max:200',
            'tel' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:100',
            'direccion' => 'nullable|string',
            'notas' => 'nullable|string',
            'estatus' => 'nullable|in:Activa,Inactiva',
        ]);

        $empresa->update($validated);

        // Respuesta JSON para AJAX
        return response()->json(['success' => true, 'message' => 'Empresa actualizada correctamente.']);
    }

    /**
     * Elimina la empresa especificada.
     */
    public function destroy(Empresa $empresa)
    {
        try {
            $empresa->delete();
            return response()->json(['success' => true, 'message' => 'Empresa eliminada correctamente.']);
        } catch (\Exception $e) {
            // Manejo de errores (ej. si la empresa tiene alumnos asociados y hay restricción FK)
            return response()->json(['success' => false, 'message' => 'No se pudo eliminar la empresa. Error: ' . $e->getMessage()], 500);
        }
    }
}