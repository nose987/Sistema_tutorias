<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoCanalizacion extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'motivo_canalizacion'; // Especifica el nombre de tu tabla

    /**
     * La llave primaria asociada con la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'pk_motivo_canalizacion'; // Especifica tu llave primaria
    
    /**
     * Indica si el modelo debe tener timestamps (created_at y updated_at).
     * Tu tabla no los tiene.
     *
     * @var bool
     */
    public $timestamps = false;
}
