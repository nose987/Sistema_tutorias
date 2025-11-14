<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $table = 'grupo';
    protected $primaryKey = 'pk_grupo';
    public $timestamps = false;

    protected $fillable = ['nombre_grupo','estatus','cuatrimestre'];

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'fk_grupo', 'pk_grupo');
    }
}
