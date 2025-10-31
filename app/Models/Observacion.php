<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    protected $table = 'observacion';
    protected $primaryKey = 'pk_observacion';
    public $timestamps = false;

    protected $fillable = [
        'fk_alumno', 'nombre', 'observacion',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'fk_alumno', 'pk_alumno');
    }
}
