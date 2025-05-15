<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
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
            'recurrente' => 'nullable|boolean',
            'frecuencia' => 'nullable|integer|7',
            'proxima_fecha_inicio' => 'nullable|date|default(null)',
            'proxima_fecha_fin' => 'nullable|date|default(null)',
        ]);

        $data = $validated; // Aquí tomas los datos validados
        $data['recurrente'] = isset($data['recurrente']) && $data['recurrente'] == '1' ? true : false;

        // $data['recurrente'] = $data['recurrente'] ?? false;

        //Unir fecha + hora para tener datetime
        $fecha_inicio = $data['fecha'] . ' ' . $data['hora_inicio'];
        $fecha_fin = $data['fecha'] . ' ' . $data['hora_fin'];
        $proxima_fecha_inicio = null;
        $proxima_fecha_fin = null;

        if($data['recurrente'] == true){
            $frecuencia = $data['frecuencia'] ?? 7;
            $proxima_fecha_inicio = Carbon::parse($fecha_inicio)->addDays($frecuencia);
            $proxima_fecha_fin = Carbon::parse($fecha_fin)->addDays($frecuencia);
        } else {
            $data['proxima_fecha_inicio'] = null;
            $data['proxima_fecha_fin'] = null;
        }

        try {
            Cita::create([
                'cita' => $data['detalles'] ?? 'Sin descripción',
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $fecha_fin,
                'id_usuario' => $data['usuario'],
                'id_profesional' => $data['profesional'],
                'asistencia_realizada' => 'pendiente',
                'recurrente' => $data['recurrente'], // No es recurrente por defecto
                'proxima_fecha_inicio' => $proxima_fecha_inicio ?? $data['proxima_fecha_inicio'], // No hay próxima cita por defecto
                'proxima_fecha_fin' => $proxima_fecha_fin ?? $data['proxima_fecha_fin'],
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

    public function storeCitaRecurrente(array $cita)
    {
        // Comprobar si ya existe una cita con los mismos datos
        $existe = Cita::where('id_usuario', $cita['id_usuario'])
        ->where('id_profesional', $cita['id_profesional'])
        ->where('fecha_inicio', $cita['proxima_fecha_inicio'])
        ->where('fecha_fin', $cita['proxima_fecha_fin'])
        ->exists();

        if ($existe) return;

        //Unir fecha + hora para tener datetime
        $proxima_fecha_inicio = Carbon::parse($cita['proxima_fecha_inicio'])->addDays($cita['frecuencia']);
        $proxima_fecha_fin = Carbon::parse($cita['proxima_fecha_fin'])->addDays($cita['frecuencia']);

            Cita::create([
                'cita' => $cita['cita'] ?? 'Sin descripción',
                'fecha_inicio' => $cita['proxima_fecha_inicio'],
                'fecha_fin' => $cita['proxima_fecha_fin'],
                'id_usuario' => $cita['id_usuario'],
                'id_profesional' => $cita['id_profesional'],
                'asistencia_realizada' => $cita['asistencia_realizada'] ?? 'pendiente',
                'recurrente' => $cita['recurrente'] ?? false,
                'frecuencia' => $cita['frecuencia'] ?? 7,
                'proxima_fecha_inicio' => $proxima_fecha_inicio,
                'proxima_fecha_fin' => $proxima_fecha_fin,
            ]);
    }

    public function getCita(string $id){
        return Cita::find($id);
    }
}
