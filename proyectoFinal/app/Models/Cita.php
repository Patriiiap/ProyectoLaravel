<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';

    protected $fillable = [
    'cita',
    'fecha_inicio',
    'fecha_fin',
    'id_usuario',
    'id_profesional',
    'asistencia_realizada'
    ];
}
