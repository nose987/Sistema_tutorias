<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividad';
    protected $primaryKey = 'pk_actividad';
    public $timestamps = false;

    protected $fillable = [
        'fk_tipo_actividad',
        'nombre',
        'fecha',
        'estatus',
        'asistencia',
    ];

    public function tipoActividad(): BelongsTo
    {
        return $this->belongsTo(TipoActividad::class, 'fk_tipo_actividad', 'pk_tipo_actividad');
    }
}