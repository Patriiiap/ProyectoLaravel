<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tutores')->insert([
            [
                'username' => 'juanperez',
                'nombre' => 'Juan',
                'apellidos' => 'Pérez',
                'email' => 'juanperez@example.com',
                'direccion' => 'Calle Falsa 123, Madrid',
                'password' => bcrypt('password123'), // Usa una contraseña fija o generada
                'dni' => '12345678A',
                'telefono' => '600123456',
                'cuenta_corriente' => 'ES1234567890123456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'mariagomez',
                'nombre' => 'María',
                'apellidos' => 'Gómez',
                'email' => 'mariagomez@example.com',
                'direccion' => 'Avenida Siempre Viva 456, Barcelona',
                'password' => bcrypt('password123'),
                'dni' => '87654321B',
                'telefono' => '600987654',
                'cuenta_corriente' => 'ES9876543210987654321098',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'pedroluna',
                'nombre' => 'Pedro',
                'apellidos' => 'Luna',
                'email' => 'pedroluna@example.com',
                'direccion' => 'Calle Real 789, Valencia',
                'password' => bcrypt('password123'),
                'dni' => '23456789C',
                'telefono' => '600112233',
                'cuenta_corriente' => 'ES1234567890123456789087',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'carlogarcia',
                'nombre' => 'Carlos',
                'apellidos' => 'García',
                'email' => 'carlosgarcia@example.com',
                'direccion' => 'Plaza Mayor 321, Sevilla',
                'password' => bcrypt('password123'),
                'dni' => '34567890D',
                'telefono' => '600445566',
                'cuenta_corriente' => 'ES7654321098765432109876',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'lorenadiaz',
                'nombre' => 'Loren',
                'apellidos' => 'Díaz',
                'email' => 'lorendiaz@example.com',
                'direccion' => 'Calle Sol 654, Zaragoza',
                'password' => bcrypt('password123'),
                'dni' => '45678901E',
                'telefono' => '600778899',
                'cuenta_corriente' => 'ES5432109876543210987654',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'albafernandez',
                'nombre' => 'Alba',
                'apellidos' => 'Fernández',
                'email' => 'albafernandez@example.com',
                'direccion' => 'Calle Luna 852, Málaga',
                'password' => bcrypt('password123'),
                'dni' => '56789012F',
                'telefono' => '600223344',
                'cuenta_corriente' => 'ES2345678901234567890123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'pedroalvarez',
                'nombre' => 'Pedro',
                'apellidos' => 'Álvarez',
                'email' => 'pedroalvarez@example.com',
                'direccion' => 'Calle Mar 963, Alicante',
                'password' => bcrypt('password123'),
                'dni' => '67890123G',
                'telefono' => '600667788',
                'cuenta_corriente' => 'ES8765432109876543210981',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'sofiagomez',
                'nombre' => 'Sofía',
                'apellidos' => 'Gómez',
                'email' => 'sofiagomez@example.com',
                'direccion' => 'Avenida de la Paz 135, Bilbao',
                'password' => bcrypt('password123'),
                'dni' => '78901234H',
                'telefono' => '600556677',
                'cuenta_corriente' => 'ES1234567890123456789045',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'antoniohernandez',
                'nombre' => 'Antonio',
                'apellidos' => 'Hernández',
                'email' => 'antoniohernandez@example.com',
                'direccion' => 'Calle Castilla 246, Salamanca',
                'password' => bcrypt('password123'),
                'dni' => '89012345I',
                'telefono' => '600889900',
                'cuenta_corriente' => 'ES6543210987654321098767',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'raquelmartinez',
                'nombre' => 'Raquel',
                'apellidos' => 'Martínez',
                'email' => 'raquelmartinez@example.com',
                'direccion' => 'Calle Nueva 741, Valladolid',
                'password' => bcrypt('password123'),
                'dni' => '90123456J',
                'telefono' => '600445566',
                'cuenta_corriente' => 'ES9876543210987654321099',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
