<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OpcionEstadia extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'opciones_estadia';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'pk_opcion_estadia';

    /**
     * Indicates if the model should be timestamped.
     * La tabla SÍ tiene timestamps (created_at/updated_at)
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fk_alumno',
        'fk_empresa',
        'opcion_numero',
        'estatus',
    ];

    /**
     * Relación: Una opción pertenece a un Alumno.
     */
    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Alumno::class, 'fk_alumno', 'pk_alumno');
    }

    /**
     * Relación: Una opción pertenece a una Empresa.
     */
    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'fk_empresa', 'pk_empresa');
    }
}
