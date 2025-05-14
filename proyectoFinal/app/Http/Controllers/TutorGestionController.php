<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorGestionController extends Controller
{
    public function index(Request $request)
    {
        // Aquí puedes implementar la lógica para mostrar la lista de tutores
        return view('tutores.index');
    }

    public function crearCita()
    {
        return view('vistastutor.crearCita');
    }

    public function storeCita(Request $request)
    {
        $citaController = new CitaController();
        return $citaController->storeCita($request);
    }

    public function proximaCita(){
        // Obtener tutor y los usuarios tutorizados
        $tutorController = new TutorController();
        $tutor = $tutorController->getTutor();

        // Obtener IDs de usuarios tutorizados
        $usuarioIds = $tutor->usuarios->pluck('id');

        // Obtener la próxima cita usando los IDs de los usuarios tutorizados
        $citaController = new CitaController();
        $proximaCita = $citaController->getProximaCita($usuarioIds->toArray());

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
