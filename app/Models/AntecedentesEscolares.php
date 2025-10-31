<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntecedentesEscolares extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_escolares';
    protected $primaryKey = 'pk_antecedentes_escolares';
    public $timestamps = false;

    protected $fillable = [
        'fk_alumno',
        'institucion_preparatoria',
        'promedio',
        'ciclo_preparatoria',
        'estudio_universidad_anterior',
        'universidad_anterior_nombre',
        'universidad_anterior_carrera',
        'universidad_anterior_tiempo',
        'universidad_anterior_motivo_salida',
        'rendimiento_cuatris_anteriores',
        'perdio_cuatrimestre',
        'perdio_cuatrimestre_causa',
        'rendimiento_cuatri_actual',
        'necesita_apoyo_extra',
        'atribucion_aprobacion',
        'atribucion_suspension',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'fk_alumno', 'pk_alumno');
    }
}
