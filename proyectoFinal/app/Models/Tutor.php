<?php

namespace App\Models;

use App\Notifications\TutorResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Tutor extends Authenticatable
{
    use SoftDeletes, HasRoles, Notifiable;

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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new TutorResetPasswordNotification($token));
    }
    
}
