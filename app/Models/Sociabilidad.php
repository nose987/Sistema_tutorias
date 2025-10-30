<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sociabilidad extends Model
{
    use HasFactory;

    protected $table = 'sociabilidad';
    protected $primaryKey = 'pk_sociabilidad';
    public $timestamps = false;

    protected $fillable = [
        'fk_alumno',
        'relacion_padres',
        'relacion_hermanos',
        'gusta_tiempo_familia',
        'agusto_en_casa',
        'comprendido_familia',
        'tiene_buenos_amigos',
        'confia_amigos_detalle',
        'preferencia_tiempo_libre',
        'preocupacion_amigos',
        'agusto_companeros_clase',
        'integrado_clase_porque',
        'normas_clase_respetan_detalle',
        'enemistad_clase_motivo',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'fk_alumno', 'pk_alumno');
    }
}
