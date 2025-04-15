<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Creamos el rol (si no existe)
    $adminRole = Role::firstOrCreate(['name' => 'admin']);

    // Creamos el usuario con Eloquent
    $user = User::create([
        'name' => 'patricia',
        'email' => 'patri@patri.es',
        'password' => bcrypt('123456789'),
    ]);

    // Le asignamos el rol de admin
    $user->assignRole($adminRole);
    }
}
