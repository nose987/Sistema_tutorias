<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumno';
    protected $primaryKey = 'pk_alumno';
    public $timestamps = false;

    protected $fillable = [
        'fk_grupo','nombre','apellido_paterno','apellido_materno',
        'fecha_nacimiento','telefono','celular','correo','direccion','estatus'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'fk_grupo', 'pk_grupo');
    }

    public function observaciones()
    {
    return $this->hasMany(\App\Models\Observacion::class, 'fk_alumno', 'pk_alumno');
    }

    // Ejemplos para después (cuando crees los modelos):
    // public function observaciones() { return $this->hasMany(Observacion::class, 'fk_alumno', 'pk_alumno'); }
    // public function historialMedico() { return $this->hasOne(HistorialMedico::class, 'fk_alumno', 'pk_alumno'); }
}
