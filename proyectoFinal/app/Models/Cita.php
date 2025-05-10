<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';

    protected $casts = [
    'fecha_inicio' => 'datetime',
    'fecha_fin' => 'datetime',
    ];

    protected $fillable = [
    'cita',
    'fecha_inicio',
    'fecha_fin',
    'id_usuario',
    'id_profesional',
    'asistencia_realizada'
    ];
}
