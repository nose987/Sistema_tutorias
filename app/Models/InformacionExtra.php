<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionExtra extends Model
{
    use HasFactory;

    protected $table = 'informacion_extra';
    protected $primaryKey = 'pk_informacion_extra';
    public $timestamps = false;

    protected $fillable = [
        'fk_alumno',
        'datos_adicionales',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'fk_alumno', 'pk_alumno');
    }
}
