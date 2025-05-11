<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    // public function eventos(Request $request)
    // {
    //     $data = Cita::whereDate('fecha_inicio', '>=', $request->start)
    //         ->whereDate('fecha_fin', '<=', $request->end)
    //         ->get()
    //         ->map(function ($cita) {
    //             return [
    //                 'id'    => $cita->id,
    //                 'title' => $cita->cita,
    //                 'start' => $cita->fecha_inicio->toIso8601String(),
    //                 'end'   => $cita->fecha_fin->toIso8601String(),
    //             ];
    //         });

    //     return response()->json($data);
    // }

    /**
     * Maneja las acciones de tipo 'add', 'update' y 'delete' sobre los eventos.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    // public function ajax(Request $request): JsonResponse
    // {
    //     // Validación de los campos necesarios
    //     $request->validate([
    //         'title' => 'required|string',
    //         'start' => 'required|date',
    //         'end' => 'required|date',
    //         'id' => 'nullable|exists:citas,id',  // Solo se valida si el ID está presente
    //     ]);

    //     switch ($request->type) {
    //         case 'add':
    //             $event = Cita::create([
    //                 'cita'  => $request->title,  // Usamos 'cita' como campo para el título
    //                 'fecha_inicio' => $request->start,
    //                 'fecha_fin' => $request->end,
    //             ]);

    //             return response()->json(['status' => 'success', 'event' => $event]);

    //         case 'update':
    //             $event = Cita::find($request->id);
    //             if ($event) {
    //                 $event->update([
    //                     'cita' => $request->title,
    //                     'fecha_inicio' => $request->start,
    //                     'fecha_fin' => $request->end,
    //                 ]);

    //                 return response()->json(['status' => 'success', 'event' => $event]);
    //             } else {
    //                 return response()->json(['status' => 'error', 'message' => 'Evento no encontrado.'], 404);
    //             }

    //         case 'delete':
    //             $event = Cita::find($request->id);
    //             if ($event) {
    //                 $event->delete();

    //                 return response()->json(['status' => 'success', 'message' => 'Evento eliminado correctamente.']);
    //             } else {
    //                 return response()->json(['status' => 'error', 'message' => 'Evento no encontrado.'], 404);
    //             }

    //         default:
    //             return response()->json(['status' => 'error', 'message' => 'Acción no válida.'], 400);
    //     }
    // }
}
