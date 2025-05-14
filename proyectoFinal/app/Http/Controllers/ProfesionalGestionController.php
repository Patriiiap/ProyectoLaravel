<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesionalGestionController extends Controller
{
    public function proximaCita(){
        // Obtener tutor y los usuarios tutorizados
        $profesionalController = new ProfesionalController();
        $profesional = $profesionalController->getProfesional();

        // Obtener la próxima cita usando los IDs de los usuarios tutorizados
        $citaController = new CitaController();
        $proximaCita = $citaController->getProximaCitaProfesional($profesional->id);

        // Verificar si hay una próxima cita
        if ($proximaCita) {
            // Obtener los detalles de la cita
            $usuarioProximaCita = $proximaCita->usuario;
            $profesionalProximaCita = $proximaCita->profesional;

            // Preparar los datos de la próxima cita
            $datosProximaCita = [
                'id' => $proximaCita->id,
                'cita' => $proximaCita->cita,
                'fecha_inicio' => $proximaCita->fecha_inicio,
                'fecha_fin' => $proximaCita->fecha_fin,
                'nombre_usuario' => $usuarioProximaCita->nombre . ' ' . $usuarioProximaCita->apellidos,
                'nombre_profesional' => $profesionalProximaCita->nombre . ' ' . $profesionalProximaCita->apellidos,
                'asistencia_realizada' => $proximaCita->asistencia_realizada,
            ];

            // Pasar los datos a la vista
            return $datosProximaCita;
        } else {
            // Si no hay cita próxima, pasar mensaje vacío o un valor alternativo
            return null;
        }
    }
}
