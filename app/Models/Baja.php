<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baja extends Model
{
    protected $table = 'bajas';
    protected $primaryKey = 'pk_bajas';
    public $timestamps = false; // Tu tabla no tiene created_at/updated_at

    protected $fillable = [
        'fk_alumno',
        'fk_motivo_baja',
        'fecha',
        'estatus',
    ];

    /**
     * Obtiene el alumno asociado con esta baja.
     */
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'fk_alumno', 'pk_alumno');
    }

    /**
     * Obtiene el motivo de la baja.
     */
    public function motivoBaja()
    {
        return $this->belongsTo(MotivoBaja::class, 'fk_motivo_baja', 'pk_motivo_baja');
    }
}
