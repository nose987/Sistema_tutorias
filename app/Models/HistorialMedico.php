<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $table = 'historial_medico';
    protected $primaryKey = 'pk_historial_medico';
    public $timestamps = false;

    protected $fillable = [
        'fk_alumno',
        'tipo_sangre',
        'check_alergia',
        'alergias',
        'check_asma',
        'asma_especifica',
        'check_cancer',
        'cancer_especifica',
        'check_diabetes',
        'diabetes_especifica',
        'check_epilepsia',
        'epilepsia_especifica',
        'check_gripa_tos_frecuente',
        'gripa_tos_especifica',
        'check_leucemia',
        'leucemia_especifica',
        'check_bulimia',
        'bulimia_especifica',
        'check_crisis_ansiedad',
        'crisis_ansiedad_especifica',
        'check_migrana',
        'migrana_especifica',
        'check_anorexia',
        'anorexia_especifica',
        'check_afeccion_corazon',
        'afeccion_corazon_especifica',
        'check_depresion',
        'depresion_especifica',
        'check_otro_salud',
        'otro_salud_especifica',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'fk_alumno', 'pk_alumno');
    }
}
