<?php

namespace App\Models;

use App\Notifications\ProfesionalResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Profesional extends Authenticatable
{
    use SoftDeletes, HasRoles, Notifiable;

    protected $table = "profesionales";
    protected $guard_name = 'profesional';

    protected $fillable = [
        'username',
        'nombre',
        'apellidos',
        'email',
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

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'profesionales_usuarios');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ProfesionalResetPasswordNotification($token));
    }
}
