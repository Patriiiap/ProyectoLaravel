<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
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

    public function verFacturas()
    {
        return view('vistasprofesional.facturas');
    }

    public function generarFactura(Request $request)
    {
        $request->validate([
            'mes' => ['required', 'regex:/^\d{4}-(0[1-9]|1[0-2])$/']
        ]);
        $fechaInput = $request->input('mes'); // Ej: '2025-04'
        [$anio, $mes] = explode('-', $fechaInput);

        $usuarioController = new UsuarioController();
        $profesionalController = new ProfesionalController();

        $usuario = $usuarioController->getUsuarioById($request->input('usuario'));
        $profesional = $profesionalController->getProfesional();


        $citaController = new CitaController();
        $citas = $citaController->citasParaFactura($profesional->id, $usuario->id, $mes, $anio);
        
        $pdf = Pdf::loadView('vistasprofesional.facturaGenerada', ['profesional' => $profesional, 
        'usuario' => $usuario, 'citas' => $citas, 'mes' => $mes, 'anio' => $anio]);
        return $pdf->stream("factura_{$mes}_{$profesional->nombre}_{$usuario->nombre}.pdf");
    }
}
