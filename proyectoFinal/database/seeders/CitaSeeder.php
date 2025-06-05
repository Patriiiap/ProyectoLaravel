<?php
namespace Database\Seeders;

use App\Models\Cita;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        $citas = [
            // Usuario 3 con profesional 1 (menor)
            [
                'cita' => 'Evaluación pediátrica',
                'fecha_inicio' => Carbon::parse('2025-05-05 09:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-05 10:00:00'),
                'id_usuario' => 3,
                'id_profesional' => 1,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => true,
            ],
            [
                'cita' => 'Seguimiento escolar',
                'fecha_inicio' => Carbon::parse('2025-06-10 11:00:00'),
                'fecha_fin' => Carbon::parse('2025-06-10 12:00:00'),
                'id_usuario' => 3,
                'id_profesional' => 1,
                'asistencia_realizada' => 'pendiente',
                'confirma_tutor' => false,
                'confirma_profesional' => true,
            ],
            [
                'cita' => 'Consulta infantil',
                'fecha_inicio' => Carbon::parse('2025-06-24 08:30:00'),
                'fecha_fin' => Carbon::parse('2025-06-24 09:15:00'),
                'id_usuario' => 3,
                'id_profesional' => 1,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => false,
            ],

            // Usuario 4 con profesionales 4 y 8 (mayor)
            [
                'cita' => 'Revisión general',
                'fecha_inicio' => Carbon::parse('2025-05-06 10:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-06 10:45:00'),
                'id_usuario' => 4,
                'id_profesional' => 4,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => false,
                'confirma_profesional' => true,
            ],
            [
                'cita' => 'Control metabólico',
                'fecha_inicio' => Carbon::parse('2025-06-12 12:00:00'),
                'fecha_fin' => Carbon::parse('2025-06-12 12:45:00'),
                'id_usuario' => 4,
                'id_profesional' => 8,
                'asistencia_realizada' => 'pendiente',
                'confirma_tutor' => false,
                'confirma_profesional' => false,
            ],
            [
                'cita' => 'Seguimiento médico',
                'fecha_inicio' => Carbon::parse('2025-06-26 14:00:00'),
                'fecha_fin' => Carbon::parse('2025-06-26 14:45:00'),
                'id_usuario' => 4,
                'id_profesional' => 4,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => false,
            ],

            // Usuario 5 (menor) con profesionales 5 y 7
            [
                'cita' => 'Consulta nutricional',
                'fecha_inicio' => Carbon::parse('2025-05-08 09:30:00'),
                'fecha_fin' => Carbon::parse('2025-05-08 10:30:00'),
                'id_usuario' => 5,
                'id_profesional' => 5,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => false,
                'confirma_profesional' => true,
            ],

            // Usuario 7 (menor) con 3, 9, 10
            [
                'cita' => 'Terapia infantil',
                'fecha_inicio' => Carbon::parse('2025-06-03 09:00:00'),
                'fecha_fin' => Carbon::parse('2025-06-03 09:45:00'),
                'id_usuario' => 7,
                'id_profesional' => 3,
                'asistencia_realizada' => 'pendiente',
                'confirma_tutor' => true,
                'confirma_profesional' => true,
            ],

            // Usuario 8 (mayor) con 2 y 5
            [
                'cita' => 'Chequeo rutina',
                'fecha_inicio' => Carbon::parse('2025-06-18 11:00:00'),
                'fecha_fin' => Carbon::parse('2025-06-18 11:45:00'),
                'id_usuario' => 8,
                'id_profesional' => 2,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => false,
                'confirma_profesional' => true,
            ],

            // Usuario 10 (menor) con 1, 5
            [
                'cita' => 'Consulta pediátrica',
                'fecha_inicio' => Carbon::parse('2025-06-20 09:00:00'),
                'fecha_fin' => Carbon::parse('2025-06-20 09:45:00'),
                'id_usuario' => 10,
                'id_profesional' => 5,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => false,
            ],
            [
                'cita' => 'Control pediátrico',
                'fecha_inicio' => Carbon::parse('2025-05-15 10:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-15 10:45:00'),
                'id_usuario' => 3,
                'id_profesional' => 1,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => true,
            ],
            [
                'cita' => 'Revisión desarrollo',
                'fecha_inicio' => Carbon::parse('2025-05-20 09:30:00'),
                'fecha_fin' => Carbon::parse('2025-05-20 10:15:00'),
                'id_usuario' => 3,
                'id_profesional' => 1,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => true,
            ],
        
            // Usuario 4 (mayor) con profesionales 4 y 8
            [
                'cita' => 'Consulta cardiológica',
                'fecha_inicio' => Carbon::parse('2025-05-16 11:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-16 11:45:00'),
                'id_usuario' => 4,
                'id_profesional' => 4,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => true,
            ],
            [
                'cita' => 'Consulta endocrinológica',
                'fecha_inicio' => Carbon::parse('2025-05-22 14:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-22 14:45:00'),
                'id_usuario' => 4,
                'id_profesional' => 8,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => true,
            ],
            [
                'cita' => 'Evaluación psicológica',
                'fecha_inicio' => Carbon::parse('2025-05-17 08:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-17 09:30:00'), // 1.5 horas
                'id_usuario' => 3,
                'id_profesional' => 1,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => true,
            ],
            [
                'cita' => 'Sesión de terapia',
                'fecha_inicio' => Carbon::parse('2025-05-18 14:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-18 16:30:00'), // 2.5 horas
                'id_usuario' => 3,
                'id_profesional' => 1,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => true,
            ],
            [
                'cita' => 'Consulta seguimiento',
                'fecha_inicio' => Carbon::parse('2025-05-19 10:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-19 11:00:00'), // 1 hora
                'id_usuario' => 3,
                'id_profesional' => 1,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => true,
            ],
        
            // Usuario 4 (mayor) con profesionales 4 y 8
            [
                'cita' => 'Consulta cardiológica avanzada',
                'fecha_inicio' => Carbon::parse('2025-05-18 09:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-18 12:00:00'), // 3 horas
                'id_usuario' => 4,
                'id_profesional' => 4,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => true,
            ],
            [
                'cita' => 'Consulta endocrinológica seguimiento',
                'fecha_inicio' => Carbon::parse('2025-05-19 13:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-19 14:30:00'), // 1.5 horas
                'id_usuario' => 4,
                'id_profesional' => 8,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => true,
            ],
            [
                'cita' => 'Evaluación general',
                'fecha_inicio' => Carbon::parse('2025-05-20 15:00:00'),
                'fecha_fin' => Carbon::parse('2025-05-20 16:30:00'), // 1.5 horas
                'id_usuario' => 4,
                'id_profesional' => 4,
                'asistencia_realizada' => 'realizada',
                'confirma_tutor' => true,
                'confirma_profesional' => true,
            ],
        ];

        foreach ($citas as $data) {
            Cita::create($data);
        }
    }
}
