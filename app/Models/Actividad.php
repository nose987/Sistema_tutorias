<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    // Basado en tu archivo laravel.sql
    protected $table = 'actividad';
    protected $primaryKey = 'pk_actividad';
    public $timestamps = false; // Tu tabla no tiene created_at/updated_at

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'fk_tipo_actividad',
        'nombre',
        'fecha',
        'estatus',
        'asistencia',
    ];
}
