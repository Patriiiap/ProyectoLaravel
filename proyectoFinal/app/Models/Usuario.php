<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
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
        'id_tutor'
    ];
}
