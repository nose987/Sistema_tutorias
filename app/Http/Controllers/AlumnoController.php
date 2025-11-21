<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // <-- IMPORTAR Rule

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

        // Traer carreras para el select del modal de editar (si las hay)
        $carreras = Alumno::query()
            ->select('carrera')
            ->whereNotNull('carrera')
            ->distinct()
            ->orderBy('carrera')
            ->pluck('carrera');

        return view('detalle_alumno', compact('alumno', 'carreras'));
    }

    public function update(Request $request, Alumno $alumno)
    {
        $data = $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'fecha_nacimiento' => 'nullable|date',
            'carrera'          => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'celular'          => 'nullable|string|max:20',
            'direccion'        => 'nullable|string|max:255',
            'fk_grupo'         => ['required', Rule::exists('grupo','pk_grupo')],
            'estatus'          => 'required|in:Activo,Baja',

            // ahora con nombres alineados a la BD (se aceptan ambos formatos por compatibilidad)
            'nombre_padre'    => 'nullable|string|max:150',
            'padre_edad'      => 'nullable|string|max:50',
            'padre_profesion' => 'nullable|string|max:150',
            'padre_edad_profesion' => 'nullable|string|max:150', // si el form envía el combo compuesto

            'nombre_madre'    => 'nullable|string|max:150',
            'madre_edad'      => 'nullable|string|max:50',
            'madre_profesion' => 'nullable|string|max:150',
            'madre_edad_profesion' => 'nullable|string|max:150',

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

        // Si el formulario envía el campo compuesto, mapearlo a la columna real
        if (isset($data['padre_edad_profesion']) && !isset($data['padre_profesion'])) {
            $data['padre_profesion'] = $data['padre_edad_profesion'];
            unset($data['padre_edad_profesion']);
        }
        if (isset($data['madre_edad_profesion']) && !isset($data['madre_profesion'])) {
            $data['madre_profesion'] = $data['madre_edad_profesion'];
            unset($data['madre_edad_profesion']);
        }

        // Normaliza teléfonos (igual que en store)
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

        // Guardar
        $alumno->update($data);

        return redirect()->route('alumnos.show', $alumno->pk_alumno)
            ->with('status', 'Información del alumno actualizada correctamente.');
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

    public function create(Request $request)
    {
        $grupos    = Grupo::orderBy('nombre_grupo')->get(['pk_grupo','nombre_grupo']);
        $preselect = $request->integer('grupo'); // /alumnos/crear?grupo=2

        $carreras = Alumno::query()
            ->select('carrera')
            ->whereNotNull('carrera')
            ->distinct()
            ->orderBy('carrera')
            ->pluck('carrera'); // Collection de strings

        return view('agregar_alumno', compact('grupos','preselect','carreras'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'fecha_nacimiento' => 'nullable|date',
            'carrera'          => 'required|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'celular'          => 'nullable|string|max:20',
            'direccion'        => 'nullable|string|max:255',
            'fk_grupo'         => 'required|exists:grupo,pk_grupo',
            'estatus'          => 'required|in:Activo,Baja',
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

        // Mapear los campos compuestos a las columnas reales
        if (isset($data['padre_edad_profesion'])) {
            $data['padre_profesion'] = $data['padre_edad_profesion'];
            unset($data['padre_edad_profesion']);
        }
        if (isset($data['madre_edad_profesion'])) {
            $data['madre_profesion'] = $data['madre_edad_profesion'];
            unset($data['madre_edad_profesion']);
        }

        // Normaliza teléfonos...
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

        $alumno = Alumno::create($data);

        return redirect()->route('detalle_grupo', $data['fk_grupo'])
            ->with('status', 'Alumno creado correctamente.');
    }
}
