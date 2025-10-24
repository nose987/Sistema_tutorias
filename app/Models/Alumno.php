<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Alumno extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'alumno'; // Especifica el nombre de tu tabla

    /**
     * La llave primaria asociada con la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'pk_alumno'; // Especifica tu llave primaria
    
    /**
     * Indica si el modelo debe tener timestamps (created_at y updated_at).
     * Tu tabla no los tiene.
     *
     * @var bool
     */
    public $timestamps = false;

    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class, 'fk_grupo', 'pk_grupo');
    }

    /**
     * Define un "Accessor" para obtener el nombre completo.
     * En la vista, podremos usar $alumno->nombre_completo
     */
    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => "{$attributes['nombre']} {$attributes['apellido_paterno']} {$attributes['apellido_materno']}"
        );
    }
}
