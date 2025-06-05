<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
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
        return view('vistastutor.crearcita');
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
        $proximaCita = $citaController->getProximaCitaTutor($usuarioIds->toArray());

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
                'id_usuario' => $proximaCita->id_usuario,
                'id_profesional' => $proximaCita->id_profesional,
                'asistencia_realizada' => $proximaCita->asistencia_realizada,
                'recurrente' => $proximaCita->recurrente,
                'frecuencia' => $proximaCita->frecuencia,
                'proxima_fecha_inicio' => $proximaCita->proxima_fecha_inicio,
                'proxima_fecha_fin' => $proximaCita->proxima_fecha_fin,
            ];

            // Pasar los datos a la vista
            return $datosProximaCita;
        } else {
            // Si no hay cita próxima, pasar mensaje vacío o un valor alternativo
            return null;
        }
        
    }

    public function storeCitaRecurrente(array $cita)
    {
        $citaController = new CitaController();
        return $citaController->storeCitaRecurrente($cita);
    }

    public function verFacturas()
    {
        return view('vistastutor.facturas');
    }

    public function generarFactura(Request $request)
    {
        $request->validate([
            'mes' => ['required', 'regex:/^\d{4}-(0[1-9]|1[0-2])$/']
        ]);
        $fechaInput = $request->input('mes'); // Ej: '2025-04'
        [$anio, $mes] = explode('-', $fechaInput);

        $tutorController = new TutorController();
        $usuarioController = new UsuarioController();
        $profesionalController = new ProfesionalController();

        $tutor = $tutorController->getTutor();
        $usuario = $usuarioController->getUsuarioById($request->input('usuario'));
        $profesional = $profesionalController->getProfesionalById($request->input('profesional'));

        $citaController = new CitaController();
        $citas = $citaController->citasParaFactura($profesional->id, $usuario->id, $mes, $anio);
        
        $pdf = Pdf::loadView('vistastutor.facturaGenerada', ['profesional' => $profesional, 
        'usuario' => $usuario, 'tutor' => $tutor, 'citas' => $citas, 'mes' => $mes, 'anio' => $anio]);
        return $pdf->stream("factura_{$mes}_{$profesional->nombre}_{$usuario->nombre}.pdf");
    }
}
