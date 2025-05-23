<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use SoftDeletes;

    protected $table = "usuarios";

    protected $fillable = [
        'nombre',
        'apellidos',
        'direccion',
        'dni',
        'fecha_nacimiento',
        'grado_discapacidad',
        'descripcion',
        'esMenor',
        'tutoria_propia',
        'id_tutor',
        'parentesco',
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'id_tutor');
    }

    public function profesionales()
    {
        return $this->belongsToMany(Profesional::class, 'profesionales_usuarios');
    }
}
