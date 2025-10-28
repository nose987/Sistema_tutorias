<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personalidad extends Model
{
    use HasFactory;

    protected $table = 'personalidad';
    protected $primaryKey = 'pk_personalidad';
    public $timestamps = false;

    protected $fillable = [
        'fk_alumno',
        'autodescripcion',
        'como_lo_ven_demas',
        'gusta_mas_de_si',
        'gusta_menos_de_si',
        'contento_ser_fisico',
        'cambiaria_algo_ser_fisico',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'fk_alumno', 'pk_alumno');
    }
}
