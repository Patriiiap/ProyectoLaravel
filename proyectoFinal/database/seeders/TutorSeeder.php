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
                'direccion' => 'Calle Falsa 123, Madrid',
                'password' => bcrypt('password123'), // Usa una contraseña fija o generada
                'dni' => '12345678A',
                'telefono' => '600123456',
                'parentesco' => 'Padre',
                'cuenta_corriente' => 'ES1234567890123456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'mariagomez',
                'nombre' => 'María',
                'apellidos' => 'Gómez',
                'direccion' => 'Avenida Siempre Viva 456, Barcelona',
                'password' => bcrypt('password123'),
                'dni' => '87654321B',
                'telefono' => '600987654',
                'parentesco' => 'Madre',
                'cuenta_corriente' => 'ES9876543210987654321098',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'pedroluna',
                'nombre' => 'Pedro',
                'apellidos' => 'Luna',
                'direccion' => 'Calle Real 789, Valencia',
                'password' => bcrypt('password123'),
                'dni' => '23456789C',
                'telefono' => '600112233',
                'parentesco' => 'Tío',
                'cuenta_corriente' => 'ES1234567890123456789087',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'carlogarcia',
                'nombre' => 'Carlos',
                'apellidos' => 'García',
                'direccion' => 'Plaza Mayor 321, Sevilla',
                'password' => bcrypt('password123'),
                'dni' => '34567890D',
                'telefono' => '600445566',
                'parentesco' => 'Hermano',
                'cuenta_corriente' => 'ES7654321098765432109876',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'lorenadiaz',
                'nombre' => 'Loren',
                'apellidos' => 'Díaz',
                'direccion' => 'Calle Sol 654, Zaragoza',
                'password' => bcrypt('password123'),
                'dni' => '45678901E',
                'telefono' => '600778899',
                'parentesco' => 'Madre',
                'cuenta_corriente' => 'ES5432109876543210987654',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'albafernandez',
                'nombre' => 'Alba',
                'apellidos' => 'Fernández',
                'direccion' => 'Calle Luna 852, Málaga',
                'password' => bcrypt('password123'),
                'dni' => '56789012F',
                'telefono' => '600223344',
                'parentesco' => 'Tía',
                'cuenta_corriente' => 'ES2345678901234567890123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'pedroalvarez',
                'nombre' => 'Pedro',
                'apellidos' => 'Álvarez',
                'direccion' => 'Calle Mar 963, Alicante',
                'password' => bcrypt('password123'),
                'dni' => '67890123G',
                'telefono' => '600667788',
                'parentesco' => 'Padre',
                'cuenta_corriente' => 'ES8765432109876543210981',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'sofiagomez',
                'nombre' => 'Sofía',
                'apellidos' => 'Gómez',
                'direccion' => 'Avenida de la Paz 135, Bilbao',
                'password' => bcrypt('password123'),
                'dni' => '78901234H',
                'telefono' => '600556677',
                'parentesco' => 'Madre',
                'cuenta_corriente' => 'ES1234567890123456789045',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'antoniohernandez',
                'nombre' => 'Antonio',
                'apellidos' => 'Hernández',
                'direccion' => 'Calle Castilla 246, Salamanca',
                'password' => bcrypt('password123'),
                'dni' => '89012345I',
                'telefono' => '600889900',
                'parentesco' => 'Tío',
                'cuenta_corriente' => 'ES6543210987654321098767',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'raquelmartinez',
                'nombre' => 'Raquel',
                'apellidos' => 'Martínez',
                'direccion' => 'Calle Nueva 741, Valladolid',
                'password' => bcrypt('password123'),
                'dni' => '90123456J',
                'telefono' => '600445566',
                'parentesco' => 'Hermana',
                'cuenta_corriente' => 'ES9876543210987654321099',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
