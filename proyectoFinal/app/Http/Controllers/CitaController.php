<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function getEventosTutores()
    {
        if (Auth::guard('tutor')->check()) {
            $tutorController = new TutorController();
            $tutor = $tutorController->getTutor();
            $userIds = $tutor->usuarios->pluck('id'); // tutor -> usuarios -> ids
            $citas = Cita::whereIn('id_usuario', $userIds)->get();
        } 
        else {
            abort(403, 'No autorizado');
        }

        $events = [];

        foreach ($citas as $event) {
            $events[] = [
                'id'   => $event->id,
                'title' => $event->cita,
                'start' => $event->fecha_inicio->toIso8601String(),
                'end'   => $event->fecha_fin->toIso8601String(),
            ];
        }
        return response()->json($events);
    }

    public function getEventosProfesionales()
    {
        
        if (Auth::guard('profesional')->check()) {
            $profesional = Auth::guard('profesional')->user();
            $citas = Cita::where('id_profesional', $profesional->id)->get();
        } 
        else {
            abort(403, 'No autorizado');
        }

        $events = [];

        foreach ($citas as $event) {
            $events[] = [
                'id'   => $event->id,
                'title' => $event->cita,
                'start' => $event->fecha_inicio->toIso8601String(),
                'end'   => $event->fecha_fin->toIso8601String(),
            ];
        }
        return response()->json($events);
    }

    public function storeCita(Request $request)
    {
        $validated = $request->validate([
            'usuario' => 'required|exists:usuarios,id',
            'profesional' => 'required|exists:profesionales,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'detalles' => 'nullable|string|max:1000',
        ]);

        //Unir fecha + hora para tener datetime
        $fecha_inicio = $validated['fecha'] . ' ' . $validated['hora_inicio'];
        $fecha_fin = $validated['fecha'] . ' ' . $validated['hora_fin'];

        try {
            Cita::create([
                'cita' => $validated['detalles'] ?? 'Sin descripción',
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
                'id_usuario' => $validated['usuario'],
                'id_profesional' => $validated['profesional'],
                'asistencia_realizada' => 'pendiente',
            ]);

            return redirect()->route('vistastutor.dashboard')->with('success', 'Cita guardada correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()->withErrors(['error' => 'Ya existe una cita con esos datos. Revisa el calendario abajo.']);
            }

            return back()->withErrors(['error' => 'Error al guardar la cita: ' . $e->getMessage()]);
        }
    }

    public function getProximaCitaTutor(array $ids)
    {
        return Cita::with(['usuario', 'profesional'])
        ->whereIn('id_usuario', $ids)
        ->where('fecha_inicio', '>', now())
        ->orderBy('fecha_inicio', 'asc')
        ->first();
        
    }

    public function getProximaCitaProfesional(string $id)
    {
        return Cita::with(['profesional', 'usuario'])
        ->where('id_profesional', $id)
        ->where('fecha_inicio', '>', now())
        ->orderBy('fecha_inicio', 'asc')
        ->first();
    }
}
