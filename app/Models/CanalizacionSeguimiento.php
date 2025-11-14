<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CanalizacionSeguimiento extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'canalizacion_seguimiento';

    /**
     * El nombre de la llave primaria.
     *
     * @var string
     */
    protected $primaryKey = 'pk_canalizacion_seguimiento';

    /**
     * Indica si el modelo debe tener timestamps (created_at y updated_at).
     *
     * @var bool
     */
    public $timestamps = false; // Tu tabla no tiene created_at/updated_at

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fk_formato_canalizacion',
        'fecha_seguimiento',
        'modalidad_seguimiento',
        'responsable_atencion',
        'diagnostico_otorgado',
        'seguimiento_tutorias',
        'seguimiento_medico',
        'seguimiento_psicologo',
        'seguimiento_trabajo_social',
    ];

    /**
     * Define la relación inversa con FormatoCanalizacion.
     */
    public function formatoCanalizacion()
    {
        return $this->belongsTo(FormatoCanalizacion::class, 'fk_formato_canalizacion', 'pk_formato_canalizacion');
    }

    
}