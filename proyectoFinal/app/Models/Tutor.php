<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutor extends Model
{
    use SoftDeletes;

    protected $table = "tutores";

    protected $fillable = [
        'username',
        'nombre',
        'apellidos',
        'email',
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
