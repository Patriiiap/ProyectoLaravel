<?php

namespace Database\Seeders;

use App\Models\Profesional;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ProfesionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el rol 'profesional' si no existe
        $profesionalRole = Role::firstOrCreate([
            'name' => 'profesional',
            'guard_name' => 'profesional',
        ]);

        $profesionales = [
            [
                'username' => 'prof1',
                'nombre' => 'Laura',
                'apellidos' => 'Martínez',
                'email' => 'prof1@example.com',
                'direccion' => 'Calle de la Salud, 12, Madrid',
                'password' => bcrypt('password123'),
                'dni' => '12345678A',
                'telefono' => '612345678',
                'esPati' => true,
                'esPap' => false,
            ],
            [
                'username' => 'prof2',
                'nombre' => 'Juan',
                'apellidos' => 'García',
                'email' => 'prof2@example.com',
                'direccion' => 'Avenida de la Paz, 5, Barcelona',
                'password' => bcrypt('password123'),
                'dni' => '23456789B',
                'telefono' => '623456789',
                'esPati' => false,
                'esPap' => true,
            ],
            [
                'username' => 'prof3',
                'nombre' => 'Carlos',
                'apellidos' => 'Rodríguez',
                'email' => 'prof3@example.com',
                'direccion' => 'Calle del Sol, 18, Valencia',
                'password' => bcrypt('password123'),
                'dni' => '34567890C',
                'telefono' => '634567890',
                'esPati' => true,
                'esPap' => false,
            ],
            [
                'username' => 'prof4',
                'nombre' => 'Ana',
                'apellidos' => 'López',
                'email' => 'prof4@example.com',
                'direccion' => 'Calle del Mar, 20, Sevilla',
                'password' => bcrypt('password123'),
                'dni' => '45678901D',
                'telefono' => '645678901',
                'esPati' => false,
                'esPap' => true,
            ],
            [
                'username' => 'prof5',
                'nombre' => 'Pedro',
                'apellidos' => 'Fernández',
                'email' => 'prof5@example.com',
                'direccion' => 'Calle de la Luna, 7, Zaragoza',
                'password' => bcrypt('password123'),
                'dni' => '56789012E',
                'telefono' => '656789012',
                'esPati' => true,
                'esPap' => true,
            ],
            [
                'username' => 'prof6',
                'nombre' => 'Elena',
                'apellidos' => 'Sánchez',
                'email' => 'prof6@example.com',
                'direccion' => 'Avenida Siempre Viva, 5, Málaga',
                'password' => bcrypt('password123'),
                'dni' => '67890123F',
                'telefono' => '667890123',
                'esPati' => false,
                'esPap' => true,
            ],
            [
                'username' => 'prof7',
                'nombre' => 'Luis',
                'apellidos' => 'Gómez',
                'email' => 'prof7@example.com',
                'direccion' => 'Plaza Mayor, 3, Alicante',
                'password' => bcrypt('password123'),
                'dni' => '78901234G',
                'telefono' => '678901234',
                'esPati' => true,
                'esPap' => false,
            ],
            [
                'username' => 'prof8',
                'nombre' => 'María',
                'apellidos' => 'Hernández',
                'email' => 'prof8@example.com',
                'direccion' => 'Calle Norte, 15, Bilbao',
                'password' => bcrypt('password123'),
                'dni' => '89012345H',
                'telefono' => '689012345',
                'esPati' => false,
                'esPap' => true,
            ],
            [
                'username' => 'prof9',
                'nombre' => 'José',
                'apellidos' => 'Jiménez',
                'email' => 'prof9@example.com',
                'direccion' => 'Calle Oeste, 10, Salamanca',
                'password' => bcrypt('password123'),
                'dni' => '90123456I',
                'telefono' => '690123456',
                'esPati' => true,
                'esPap' => false,
            ],
            [
                'username' => 'prof10',
                'nombre' => 'Isabel',
                'apellidos' => 'Díaz',
                'email' => 'prof10@example.com',
                'direccion' => 'Calle Río, 12, Madrid',
                'password' => bcrypt('password123'),
                'dni' => '01234567J',
                'telefono' => '701234567',
                'esPati' => true,
                'esPap' => false,
            ]
        ];

        foreach ($profesionales as $data) {
            $profesional = Profesional::create($data);
            $profesional->assignRole($profesionalRole);
        }
    }
}
