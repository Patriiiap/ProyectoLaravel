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
    'asistencia_realizada',
    'recurrente',
    'frecuencia',
    'proxima_fecha_inicio',
    'proxima_fecha_fin',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
