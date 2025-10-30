<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotencialAprendizaje extends Model
{
    use HasFactory;

    protected $table = 'potencial_aprendizaje';
    protected $primaryKey = 'pk_potencial_aprendizaje';
    public $timestamps = false;

    protected $fillable = [
        'fk_alumno',
        'aspectos_propician_y_dificultan_aprendizaje',
        'razones_para_estudiar',
        'clima_clase_permite_aprender',
        'clima_clase_especifica',
        'contento_profesores_general',
        'opinion_familia_estudios',
        'apoyo_padres_estudiar',
        'actividad_paraescolar_cual',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'fk_alumno', 'pk_alumno');
    }
}
