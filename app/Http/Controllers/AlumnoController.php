<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Grupo;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Muestra el perfil detallado de un alumno.
     */
    public function show(Alumno $alumno)
    {
        $alumno->load([
            'grupo',
            'observaciones' => function($q) { 
                $q->orderByDesc('pk_observacion'); 
            },
        ]);

        return view('detalle_alumno', compact('alumno'));
    }

    /**
     * Actualiza el estatus (Activo/Baja) de un alumno.
     */
    public function updateStatus(Request $request, Alumno $alumno)
    {
        $data = $request->validate([
            'estatus' => 'required|in:Activo,Baja',
        ]);

        $alumno->update(['estatus' => $data['estatus']]);

        return back()->with('status', 'Estatus actualizado correctamente.');
    }

    /* ==================== NUEVO ==================== */

    /** Formulario de creación (con grupo preseleccionado si viene ?grupo=ID) */
    public function create(Request $request)
{
    $grupos    = Grupo::orderBy('nombre_grupo')->get(['pk_grupo','nombre_grupo']);
    $preselect = $request->integer('grupo'); // /alumnos/crear?grupo=2
    return view('agregar_alumno', compact('grupos','preselect'));
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'fecha_nacimiento' => 'nullable|date',
            'correo'           => 'nullable|email|max:150',
            'telefono'         => 'nullable|string|max:20',
            'celular'          => 'nullable|string|max:20',
            'direccion'        => 'nullable|string|max:255',

            // 👇 aquí estaba el error (tabla correcta: grupo)
            'fk_grupo'         => 'required|exists:grupo,pk_grupo',

            'estatus'          => 'required|in:Activo,Baja',

            // opcionales
            'nombre_padre'                 => 'nullable|string|max:150',
            'padre_edad_profesion'         => 'nullable|string|max:150',
            'nombre_madre'                 => 'nullable|string|max:150',
            'madre_edad_profesion'         => 'nullable|string|max:150',
            'hermanos_info'                => 'nullable|string|max:500',
            'tipo_beca'                    => 'nullable|string|max:150',
            'contacto_emergencia_nombre'   => 'nullable|string|max:150',
            'contacto_emergencia_telefono' => 'nullable|string|max:20',
            'contacto_emergencia_celular'  => 'nullable|string|max:20',
            'tiene_hijos'                  => 'nullable|boolean',
            'trabaja'                      => 'nullable|boolean',
            'recibe_apoyo_familiar'        => 'nullable|boolean',
            'tiene_beca'                   => 'nullable|boolean',
        ]);

        // Normaliza teléfonos
        foreach (['telefono','celular','contacto_emergencia_telefono','contacto_emergencia_celular'] as $f) {
            if (!empty($data[$f])) {
                $data[$f] = substr(preg_replace('/\D+/', '', $data[$f]), 0, 20);
            }
        }

        // Checkboxes a 0/1
        $data['tiene_hijos']           = $request->boolean('tiene_hijos');
        $data['trabaja']               = $request->boolean('trabaja');
        $data['recibe_apoyo_familiar'] = $request->boolean('recibe_apoyo_familiar');
        $data['tiene_beca']            = $request->boolean('tiene_beca');

        // Solo se guardarán los campos que están en $fillable del modelo Alumno
        $alumno = Alumno::create($data);

        return redirect()->route('detalle_grupo', $data['fk_grupo'])
            ->with('status', 'Alumno creado correctamente.');
    }

}
