<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoActividad extends Model
{
    use HasFactory;

    protected $table = 'tipo_actividad';
    protected $primaryKey = 'pk_tipo_actividad';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    public function actividades(): HasMany
    {
        return $this->hasMany(Actividad::class, 'fk_tipo_actividad', 'pk_tipo_actividad');
    }
}