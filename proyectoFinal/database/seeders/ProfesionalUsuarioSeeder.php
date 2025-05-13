<?php

namespace Database\Seeders;

use App\Models\Profesional;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfesionalUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Suponiendo que ya existen usuarios y profesionales en la base de datos
        // $usuario = Usuario::first(); // toma el primer usuario
        // $profesionales = Profesional::take(3)->pluck('id'); // toma los primeros 3 profesionales

        // // Asigna los profesionales al usuario
        // $usuario->profesionales()->sync($profesionales); // agrega y sincroniza los 3

        //Usuario 1 los profesionales 2, 3 y 4
        $usuario = Usuario::find(1);

        if ($usuario) {
            $usuario->profesionales()->sync([2, 3, 4]);
        }

        // Usuario 2 con profesionales 5 y 6
        $usuario2 = Usuario::find(2);

        if ($usuario2) {
            $usuario2->profesionales()->sync([5, 6]);
        }

        // Usuario 3 con profesional 1
        $usuario3 = Usuario::find(3);

        if ($usuario3) {
            $usuario3->profesionales()->sync([1]);
        }
    }
}
