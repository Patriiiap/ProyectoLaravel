<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'patricia',
                'email' => 'patri@patri.es',
                'password' => bcrypt('123456789'), // Usa una contraseña fija o generada
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
