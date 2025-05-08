<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index(Request $request)
    {
  
        if($request->ajax()) {
       
             $data = Cita::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);
  
             return response()->json($data);
        }
  
        return view('fullcalender');
    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request): JsonResponse
    {
        switch ($request->type) {
           case 'add':
              $event = Cita::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Cita::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Cita::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }

        return response()->json(['status' => 'success']);
    }
}
