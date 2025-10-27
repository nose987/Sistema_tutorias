<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- Importar HasMany

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumno';
    protected $primaryKey = 'pk_alumno';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fk_grupo',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'telefono',
        'celular',
        // ... (otros campos)
        'correo',
        'direccion',
        'estatus',
        
        // ========================================================
        // ¡CAMPOS DE OPCIONES ELIMINADOS DE $fillable!
        // Ya no están en esta tabla.
        // ========================================================
    ];

    /**
     * Relación: Un alumno pertenece a un Grupo.
     * (Esta probablemente ya la tenías o la necesitas)
     */
    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class, 'fk_grupo', 'pk_grupo');
    }

    // ========================================================
    // ¡NUEVA RELACIÓN!
    // Un alumno tiene MUCHAS opciones de estadía.
    // ========================================================
    public function opcionesEstadia(): HasMany
    {
        return $this->hasMany(OpcionEstadia::class, 'fk_alumno', 'pk_alumno');
    }

    // ========================================================
    // ¡RELACIONES ANTIGUAS ELIMINADAS!
    // public function opcion1(): BelongsTo { ... }
    // public function opcion2(): BelongsTo { ... }
    // public function opcion3(): BelongsTo { ... }
    // ========================================================
}
