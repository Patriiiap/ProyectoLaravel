<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $table = "tutores";

    protected $fillable = [
        'username',
        'nombre',
        'apellidos',
        'direccion',
        'password',
        'dni',
        'telefono',
        'parentesco',
        'cuenta_corriente',
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
