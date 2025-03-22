<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Carlos Sánchez',
                'apellidos' => 'González',
                'direccion' => 'Calle de la Paz, 5, Madrid',
                'dni' => '12345678A',
                'fecha_nacimiento' => '2000-01-01',
                'grado_discapacidad' => 50,
                'descripcion' => 'Usuario con discapacidad física leve.',
                'esMenor' => false,
                'tutoria_propia' => false,
                'id_tutor' => 1, // Relacionado con el tutor que tiene id 1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ana Pérez',
                'apellidos' => 'Morales',
                'direccion' => 'Avenida Siempre Viva, 12, Barcelona',
                'dni' => '23456789B',
                'fecha_nacimiento' => '1995-05-22',
                'grado_discapacidad' => 30,
                'descripcion' => 'Usuario con discapacidad auditiva.',
                'esMenor' => false,
                'tutoria_propia' => true,
                'id_tutor' => 2, // Relacionado con el tutor que tiene id 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'María López',
                'apellidos' => 'Fernández',
                'direccion' => 'Calle del Sol, 10, Valencia',
                'dni' => '34567890C',
                'fecha_nacimiento' => '2010-11-10',
                'grado_discapacidad' => 70,
                'descripcion' => 'Usuario con discapacidad intelectual moderada.',
                'esMenor' => true,
                'tutoria_propia' => false,
                'id_tutor' => 3, // Relacionado con el tutor que tiene id 3
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Luis García',
                'apellidos' => 'Ramírez',
                'direccion' => 'Plaza Mayor, 8, Sevilla',
                'dni' => '45678901D',
                'fecha_nacimiento' => '2005-07-30',
                'grado_discapacidad' => 40,
                'descripcion' => 'Usuario con discapacidad visual leve.',
                'esMenor' => false,
                'tutoria_propia' => true,
                'id_tutor' => 4, // Relacionado con el tutor que tiene id 4
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sofía Martínez',
                'apellidos' => 'Sánchez',
                'direccion' => 'Calle Luna, 15, Zaragoza',
                'dni' => '56789012E',
                'fecha_nacimiento' => '2012-04-12',
                'grado_discapacidad' => 60,
                'descripcion' => 'Usuario con discapacidad física moderada.',
                'esMenor' => true,
                'tutoria_propia' => false,
                'id_tutor' => 5, // Relacionado con el tutor que tiene id 5
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Pedro Fernández',
                'apellidos' => 'Jiménez',
                'direccion' => 'Calle Primavera, 30, Málaga',
                'dni' => '67890123F',
                'fecha_nacimiento' => '1997-02-18',
                'grado_discapacidad' => 50,
                'descripcion' => 'Usuario con discapacidad auditiva moderada.',
                'esMenor' => false,
                'tutoria_propia' => true,
                'id_tutor' => 6, // Relacionado con el tutor que tiene id 6
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Marta Álvarez',
                'apellidos' => 'López',
                'direccion' => 'Calle Norte, 25, Alicante',
                'dni' => '78901234G',
                'fecha_nacimiento' => '2008-09-05',
                'grado_discapacidad' => 80,
                'descripcion' => 'Usuario con discapacidad intelectual severa.',
                'esMenor' => true,
                'tutoria_propia' => false,
                'id_tutor' => 7, // Relacionado con el tutor que tiene id 7
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Luis Rodríguez',
                'apellidos' => 'Hernández',
                'direccion' => 'Calle del Mar, 40, Bilbao',
                'dni' => '89012345H',
                'fecha_nacimiento' => '2002-10-17',
                'grado_discapacidad' => 20,
                'descripcion' => 'Usuario con discapacidad visual leve.',
                'esMenor' => false,
                'tutoria_propia' => true,
                'id_tutor' => 8, // Relacionado con el tutor que tiene id 8
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Raúl Díaz',
                'apellidos' => 'García',
                'direccion' => 'Calle Oeste, 50, Salamanca',
                'dni' => '90123456I',
                'fecha_nacimiento' => '2000-03-22',
                'grado_discapacidad' => 40,
                'descripcion' => 'Usuario con discapacidad motriz leve.',
                'esMenor' => false,
                'tutoria_propia' => false,
                'id_tutor' => 9, // Relacionado con el tutor que tiene id 9
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Elena Jiménez',
                'apellidos' => 'Mora',
                'direccion' => 'Avenida del Río, 18, Madrid',
                'dni' => '01234567J',
                'fecha_nacimiento' => '2015-06-25',
                'grado_discapacidad' => 90,
                'descripcion' => 'Usuario con discapacidad intelectual severa.',
                'esMenor' => true,
                'tutoria_propia' => false,
                'id_tutor' => 10, // Relacionado con el tutor que tiene id 10
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
