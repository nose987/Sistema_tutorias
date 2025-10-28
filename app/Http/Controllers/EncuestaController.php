<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use App\Models\HistorialMedico;
use App\Models\AntecedentesEscolares;
use App\Models\PotencialAprendizaje;
use App\Models\Sociabilidad;
use App\Models\Personalidad;
use App\Models\InformacionExtra;

class EncuestaController extends Controller
{
    /**
     * Display the survey form.
     */
    public function create()
    {
        return view('encuesta');
    }

    /**
     * Store the survey data in the database.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $alumno = Alumno::create([
                'fk_grupo' => $request->input('fk_grupo'),
                'nombre' => $request->input('nombre'),
                'apellido_paterno' => $request->input('apellido_paterno'),
                'carrera' => $request->input('carrera'),
                'apellido_materno' => $request->input('apellido_materno'),
                'fecha_nacimiento' => $request->input('fecha_nacimiento'),
                'telefono' => $request->input('telefono'),
                'celular' => $request->input('celular'),
                'nombre_padre' => $request->input('nombre_padre'),
                'padre_edad' => $request->input('padre_edad'),
                'padre_profesion' => $request->input('padre_profesion'),
                'nombre_madre' => $request->input('nombre_madre'),
                'madre_edad' => $request->input('madre_edad'),
                'madre_profesion' => $request->input('madre_profesion'),
                'hermanos_info' => $request->input('hermanos_info'),
                'tiene_hijos' => $request->input('tiene_hijos'),
                'trabaja' => $request->input('trabaja'),
                'recibe_apoyo_familiar' => $request->input('recibe_apoyo_familiar'),
                'tiene_beca' => $request->input('tiene_beca'),
                'tipo_beca' => $request->input('tipo_beca'),
                'contacto_emergencia_nombre' => $request->input('contacto_emergencia_nombre'),
                'contacto_emergencia_telefono' => $request->input('contacto_emergencia_telefono'),
                'contacto_emergencia_celular' => $request->input('contacto_emergencia_celular'),
                'direccion' => $request->input('direccion'),
            ]);

            $alumno->historialMedico()->create($request->only([
                'tipo_sangre', 'check_alergia', 'alergias', 'check_asma', 'asma_especifica', 'check_cancer', 'cancer_especifica',
                'check_diabetes', 'diabetes_especifica', 'check_epilepsia', 'epilepsia_especifica', 'check_gripa_tos_frecuente', 'gripa_tos_especifica',
                'check_leucemia', 'leucemia_especifica', 'check_bulimia', 'bulimia_especifica', 'check_crisis_ansiedad', 'crisis_ansiedad_especifica',
                'check_migrana', 'migrana_especifica', 'check_anorexia', 'anorexia_especifica', 'check_afeccion_corazon', 'afeccion_corazon_especifica',
                'check_depresion', 'depresion_especifica', 'check_otro_salud', 'otro_salud_especifica'
            ]));

            $alumno->antecedentesEscolares()->create($request->only([
                'institucion_preparatoria', 'promedio', 'ciclo_preparatoria', 'estudio_universidad_anterior', 'universidad_anterior_nombre',
                'universidad_anterior_y_carrera_anterior', 'universidad_anterior_tiempo', 'universidad_anterior_motivo_salida', 'rendimiento_cuatris_anteriores',
                'perdio_cuatrimestre', 'perdio_cuatrimestre_causa', 'rendimiento_cuatri_actual', 'necesita_apoyo_extra', 'atribucion_aprobacion', 'atribucion_suspension'
            ]));

            $alumno->potencialAprendizaje()->create($request->only([
                'aspectos_propician_y_dificultan_aprendizaje', 'razones_para_estudiar', 'clima_clase_permite_aprender', 'clima_clase_especifica',
                'contento_profesores_general', 'opinion_familia_estudios', 'apoyo_padres_estudiar', 'actividad_paraescolar_cual'
            ]));

            $alumno->sociabilidad()->create($request->only([
                'relacion_padres', 'relacion_hermanos', 'gusta_tiempo_familia', 'agusto_en_casa', 'comprendido_familia', 'tiene_buenos_amigos',
                'confia_amigos_detalle', 'preferencia_tiempo_libre', 'preocupacion_amigos', 'agusto_companeros_clase', 'integrado_clase_porque',
                'normas_clase_respetan_detalle', 'enemistad_clase_motivo'
            ]));

            $alumno->personalidad()->create($request->only([
                'autodescripcion', 'como_lo_ven_demas', 'gusta_mas_de_si', 'gusta_menos_de_si', 'contento_ser_fisico', 'cambiaria_algo_ser_fisico'
            ]));

            $alumno->informacionExtra()->create($request->only(['datos_adicionales']));

            DB::commit();

            return redirect()->route('encuesta.create')->with('success', 'Encuesta guardada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            
            // It's a good practice to log the error for debugging
            // Log::error('Error saving survey: '.$e->getMessage());

            return redirect()->back()->with('error', 'Hubo un error al guardar la encuesta. Por favor, intente de nuevo.')->withInput();
        }
    }
}
