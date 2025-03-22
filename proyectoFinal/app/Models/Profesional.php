<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    protected $table = "profesionales";

    protected $fillable = [
        'username',
        'nombre',
        'apellidos',
        'direccion',
        'password',
        'dni',
        'telefono',
        'esPati',
        'esPap',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }
}
