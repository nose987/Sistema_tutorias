<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class FormatoCanalizacion extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'formato_canalizacion'; //

    /**
     * La llave primaria asociada con la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'pk_formato_canalizacion'; //

    /**
     * Indica si el modelo debe tener timestamps (created_at y updated_at).
     * Tu tabla no los tiene.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'fk_alumno', //
        'fecha_canalizacion', //
        'tutor_nombre', //
        'carrera', //
        'motivo_reprobacion', //
        'motivo_constantes_faltas', //
        'motivo_no_participa', //
        'motivo_no_entrega_actividades', //
        'motivo_dificultad_asignatura', //
        'motivo_inasistencia_distancia', //
        'motivo_inasistencia_transporte', //
        'motivo_inasistencia_enfermedad', //
        'motivo_inasistencia_familiar', //
        'motivo_inasistencia_personal', //
        'motivo_salud_dolor_cabeza', //
        'motivo_salud_dolor_estomago', //
        'motivo_salud_dolor_muscular', //
        'motivo_salud_respiratorios', //
        'motivo_salud_vertigo', //
        'motivo_salud_vomito', //
        'motivo_adiccion_ojos_rojos', //
        'motivo_adiccion_somnolencia', //
        'motivo_adiccion_aliento_alcoholico', //
        'motivo_comportamiento_agresivo', //
        'motivo_comportamiento_indisciplina', //
        'motivo_comportamiento_desafiante', //
        'motivo_comportamiento_irrespetuoso', //
        'motivo_comportamiento_desinteres', //
        'motivo_estres_frustracion', //
        'motivo_estres_desmotivacion', //
        'motivo_estres_cansancio', //
        'motivo_estres_hiperactividad', //
        'motivo_estres_ansiedad', //
        'motivo_socioeconomico_matrimonio', //
        'motivo_socioeconomico_embarazo', //
        'motivo_socioeconomico_no_desea_estudiar', //
        'motivo_socioeconomico_decidio_trabajar', //
        'motivo_socioeconomico_horario_laboral', //
        'motivo_socioeconomico_pago_mensualidades', //
        'motivo_socioeconomico_transporte', //
        'motivo_socioeconomico_manutencion', //
        'motivo_faltas_ebrio', //
        'motivo_faltas_drogado', //
        'motivo_faltas_vandalismo', //
        'motivo_faltas_porta_armas_drogas', //
        'motivo_otros', //
        'observaciones_tutor', //
        'acciones_tutor', //
        'estatus', //
    ];

    /**
     * Define la relación: Un Formato pertenece a un Alumno.
     */
    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class, 'fk_alumno', 'pk_alumno');
    }
    public function seguimientos()
    {
        return $this->hasMany(CanalizacionSeguimiento::class, 'fk_formato_canalizacion', 'pk_formato_canalizacion');
    }
}