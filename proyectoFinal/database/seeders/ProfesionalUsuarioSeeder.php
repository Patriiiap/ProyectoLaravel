<?php

namespace Database\Seeders;

use App\Models\Profesional;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfesionalUsuarioSeeder extends Seeder
{
    public function run(): void
    {
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
