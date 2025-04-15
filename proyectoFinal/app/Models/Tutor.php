<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Tutor extends Authenticatable
{
    use SoftDeletes, HasRoles;

    protected $table = "tutores";
    protected $guard_name = 'tutor';

    protected $fillable = [
        'username',
        'nombre',
        'apellidos',
        'email',
        'direccion',
        'password',
        'dni',
        'telefono',
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

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_tutor');
    }
}
