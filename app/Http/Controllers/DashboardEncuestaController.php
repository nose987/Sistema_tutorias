<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Setting;

class DashboardEncuestaController extends Controller
{
    public function index(Request $request)
    {
        $setting = Setting::where('key', 'alumnos_esperados')->first();
        $total_esperados = $setting ? (int)$setting->value : 0;

        $respuestas_recibidas = Alumno::count();

        $alumnos_faltantes = $total_esperados - $respuestas_recibidas;
        if ($alumnos_faltantes < 0) {
            $alumnos_faltantes = 0;
        }

        $showAll = $request->has('show') && $request->query('show') == 'all';

        if ($showAll) {
            $ultimos_alumnos = Alumno::orderBy('pk_alumno', 'desc')->get();
        } else {
            $ultimos_alumnos = Alumno::orderBy('pk_alumno', 'desc')->limit(5)->get();
        }

        return view('encuestas', [
            'total_esperados' => $total_esperados,
            'respuestas_recibidas' => $respuestas_recibidas,
            'alumnos_faltantes' => $alumnos_faltantes,
            'ultimos_alumnos' => $ultimos_alumnos,
            'showing_all' => $showAll,
        ]);
    }

    public function updateAlumnosEsperados(Request $request)
    {
        $request->validate([
            'alumnos_esperados' => 'required|integer|min:0',
        ]);

        Setting::updateOrCreate(
            ['key' => 'alumnos_esperados'],
            ['value' => $request->input('alumnos_esperados')]
        );

        return redirect()->route('encuestas')->with('success', 'El número de alumnos esperados se ha guardado.');
    }

    public function show(Alumno $alumno)
    {
        $alumno->load([
            'antecedentesEscolares',
            'historialMedico',
            'informacionExtra',
            'personalidad',
            'potencialAprendizaje',
            'sociabilidad'
        ]);

        return view('encuesta.show', ['alumno' => $alumno]);
    }

    public function update(Request $request, Alumno $alumno)
    {
        $alumnoData = $request->only(['nombre', 'apellido_paterno', 'apellido_materno', 'fecha_nacimiento', 'carrera', 'direccion', 'telefono', 'celular', 'nombre_padre', 'padre_edad', 'padre_profesion', 'nombre_madre', 'madre_edad', 'madre_profesion', 'hermanos_info', 'tiene_hijos', 'trabaja', 'recibe_apoyo_familiar', 'tiene_beca', 'tipo_beca', 'contacto_emergencia_nombre', 'contacto_emergencia_telefono', 'contacto_emergencia_celular']);
        $alumno->update($alumnoData);

        if ($alumno->antecedentesEscolares) {
            $antecedentesData = $request->only(['institucion_preparatoria', 'ciclo_preparatoria', 'estudio_universidad_anterior', 'universidad_anterior_y_carrera_anterior', 'universidad_anterior_tiempo', 'universidad_anterior_motivo_salida', 'rendimiento_cuatris_anteriores', 'perdio_cuatrimestre_causa', 'rendimiento_cuatri_actual', 'necesita_apoyo_extra', 'atribucion_aprobacion', 'atribucion_suspension']);
            $alumno->antecedentesEscolares->update($antecedentesData);
        }

        if ($alumno->historialMedico) {
            $historialData = $request->only(['check_alergia', 'alergias', 'check_asma', 'asma_especifica', 'check_cancer', 'cancer_especifica', 'check_diabetes', 'diabetes_especifica', 'check_epilepsia', 'epilepsia_especifica', 'check_gripa_tos_frecuente', 'gripa_tos_especifica', 'check_leucemia', 'leucemia_especifica', 'check_migrana', 'migrana_especifica', 'check_anorexia', 'anorexia_especifica', 'check_bulimia', 'bulimia_especifica', 'check_crisis_ansiedad', 'crisis_ansiedad_especifica', 'check_afeccion_corazon', 'afeccion_corazon_especifica', 'check_depresion', 'depresion_especifica', 'check_otro_salud', 'otro_salud_especifica']);
            $alumno->historialMedico->update($historialData);
        }

        if ($alumno->informacionExtra) {
            $informacionExtraData = $request->only(['datos_adicionales']);
            $alumno->informacionExtra->update($informacionExtraData);
        }

        if ($alumno->personalidad) {
            $personalidadData = $request->only(['autodescripcion', 'como_lo_ven_demas', 'gusta_mas_de_si', 'gusta_menos_de_si', 'contento_ser_fisico', 'cambiaria_algo_ser_fisico']);
            $alumno->personalidad->update($personalidadData);
        }

        if ($alumno->potencialAprendizaje) {
            $potencialData = $request->only(['aspectos_propician_y_dificultan_aprendizaje', 'razones_para_estudiar', 'clima_clase_permite_aprender', 'clima_clase_especifica', 'contento_profesores_general', 'opinion_familia_estudios', 'apoyo_padres_estudiar', 'actividad_paraescolar_cual']);
            $alumno->potencialAprendizaje->update($potencialData);
        }

        if ($alumno->sociabilidad) {
            $sociabilidadData = $request->only(['relacion_padres', 'relacion_hermanos', 'gusta_tiempo_familia', 'agusto_en_casa', 'comprendido_familia', 'tiene_buenos_amigos', 'confia_amigos_detalle', 'preferencia_tiempo_libre', 'preocupacion_amigos', 'agusto_companeros_clase', 'integrado_clase_porque', 'normas_clase_respetan_detalle', 'enemistad_clase_motivo']);
            $alumno->sociabilidad->update($sociabilidadData);
        }

        return redirect()->route('encuesta.show', $alumno->pk_alumno)->with('success', 'Encuesta actualizada correctamente.');
    }
}
