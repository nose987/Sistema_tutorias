<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Canalizacion extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'canalizacion'; //

    /**
     * La llave primaria asociada con la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'pk_canalizacion'; //

    /**
     * Indica si el modelo debe tener timestamps (created_at y updated_at).
     * Tu tabla no los tiene, así que lo ponemos en false.
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
        'fk_alumno',
        'fk_motivo_canalizacion',
        'fecha_inicio',
        'fecha_final',
        'estatus',
    ];

    public function alumno(): BelongsTo
    {
        //              ModeloRelacionado,   LlaveForánea,       LlavePrimariaDeLaOtraTabla
        return $this->belongsTo(Alumno::class, 'fk_alumno', 'pk_alumno');
    }

    /**
     * Define la relación: Una Canalización pertenece a un Motivo.
     */
    public function motivo(): BelongsTo
    {
        return $this->belongsTo(MotivoCanalizacion::class, 'fk_motivo_canalizacion', 'pk_motivo_canalizacion');
    }
}
