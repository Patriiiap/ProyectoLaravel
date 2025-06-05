<?php

namespace Database\Seeders;

use App\Models\Usuario;
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

        // Usuario 4 (mayor) con profesionales 4 y 8
        $usuario4 = Usuario::find(4);

        if ($usuario4) {
            $usuario4->profesionales()->sync([4, 8]);
        }

        // Usuario 5 (menor) con profesionales 5 y 7
        $usuario5 = Usuario::find(5);

        if ($usuario5) {
            $usuario5->profesionales()->sync([5, 7]);
        }

        // Usuario 6 (mayor) con profesional 6
        $usuario6 = Usuario::find(6);

        if ($usuario6) {
            $usuario6->profesionales()->sync([6]);
        }

        // Usuario 7 (menor) con profesionales 3, 9 y 10
        $usuario7 = Usuario::find(7);

        if ($usuario7) {
            $usuario7->profesionales()->sync([3, 9, 10]);
        }

        // Usuario 8 (mayor) con profesionales 2 y 5
        $usuario8 = Usuario::find(8);

        if ($usuario8) {
            $usuario8->profesionales()->sync([2, 5]);
        }

        // Usuario 9 (mayor) con profesional 8
        $usuario9 = Usuario::find(9);

        if ($usuario9) {
            $usuario9->profesionales()->sync([8]);
        }

        // Usuario 10 (menor) con profesionales 1 y 5
        $usuario10 = Usuario::find(10);

        if ($usuario10) {
            $usuario10->profesionales()->sync([1, 5]);
        }

        // Usuario 11 (menor) con profesionales 9 y 10
        $usuario11 = Usuario::find(11);

        if ($usuario11) {
            $usuario11->profesionales()->sync([9, 10]);
        }
    }
}
