<?php

namespace Database\Seeders;

use App\Models\Cita;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $citas = [
            [
                'cita' => 'Consulta general',
                'fecha_inicio' => Carbon::parse('2025-05-05 09:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-05 10:00:00'),
                'id_usuario' => 1,
                'id_profesional' => 1,
                'asistencia_realizada' => false,
            ],
            [
                'cita' => 'Revisión médica',
                'fecha_inicio' => Carbon::parse('2025-05-06 11:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-06 12:00:00'),
                'id_usuario' => 2,
                'id_profesional' => 2,
                'asistencia_realizada' => false,
            ],
            [
                'cita' => 'Chequeo pediátrico',
                'fecha_inicio' => Carbon::parse('2025-05-07 08:30:00'),
                'fecha_fin' => Carbon::parse('2025-05-07 09:30:00'),
                'id_usuario' => 3,
                'id_profesional' => 3,
                'asistencia_realizada' => false,
            ],
            [
                'cita' => 'Control nutricional',
                'fecha_inicio' => Carbon::parse('2025-05-08 10:15:00'),
                'fecha_fin' => Carbon::parse('2025-05-08 11:00:00'),
                'id_usuario' => 4,
                'id_profesional' => 4,
                'asistencia_realizada' => false,
            ],
            [
                'cita' => 'Consulta psicológica',
                'fecha_inicio' => Carbon::parse('2025-05-09 15:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-09 16:00:00'),
                'id_usuario' => 5,
                'id_profesional' => 5,
                'asistencia_realizada' => false,
            ],
            [
                'cita' => 'Seguimiento post-operatorio',
                'fecha_inicio' => Carbon::parse('2025-05-10 14:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-10 15:00:00'),
                'id_usuario' => 1,
                'id_profesional' => 6,
                'asistencia_realizada' => false,
            ],
            [
                'cita' => 'Consulta dermatológica',
                'fecha_inicio' => Carbon::parse('2025-05-11 12:30:00'),
                'fecha_fin' => Carbon::parse('2025-05-11 13:15:00'),
                'id_usuario' => 2,
                'id_profesional' => 7,
                'asistencia_realizada' => false,
            ],
            [
                'cita' => 'Consulta dermatológica',
                'fecha_inicio' => Carbon::parse('2025-05-11 12:30:00'),
                'fecha_fin' => Carbon::parse('2025-05-11 13:15:00'),
                'id_usuario' => 4,
                'id_profesional' => 5,
                'asistencia_realizada' => false,
            ],
            [
                'cita' => 'Terapia de lenguaje',
                'fecha_inicio' => Carbon::parse('2025-05-12 09:45:00'),
                'fecha_fin' => Carbon::parse('2025-05-12 10:30:00'),
                'id_usuario' => 3,
                'id_profesional' => 8,
                'asistencia_realizada' => false,
            ],
            [
                'cita' => 'Evaluación cognitiva',
                'fecha_inicio' => Carbon::parse('2025-05-13 13:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-13 14:00:00'),
                'id_usuario' => 4,
                'id_profesional' => 9,
                'asistencia_realizada' => false,
            ],
            [
                'cita' => 'Consulta de rutina',
                'fecha_inicio' => Carbon::parse('2025-05-14 11:30:00'),
                'fecha_fin' => Carbon::parse('2025-05-14 12:30:00'),
                'id_usuario' => 5,
                'id_profesional' => 10,
                'asistencia_realizada' => false,
            ],
        ];

        foreach ($citas as $data) {
            Cita::create($data);
        }
    }
}
