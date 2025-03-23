<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Http\Request;

class ProfesionalController extends Controller
{

    public function index()
    {
        $profesionales = Profesional::orderBy('id')->get();
        return view('profesionales.index', ['profesionales' => $profesionales]);
    }

    public function create()
    {
        return view('profesionales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:profesionales',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|string|max:255|unique:profesionales',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'password' => 'required|string|min:8', // Asegúrate de que la contraseña esté presente y tenga una longitud mínima
        ]);

        // Procesar los valores booleanos (esPati y esPap)
        $data = $request->only(['username', 'nombre', 'apellidos', 'dni', 'direccion', 'telefono', 'password']);

        // Asignar valores booleanos a 'esPati' y 'esPap' (false si no están marcados)
        $data['esPati'] = $request->has('esPati') ? true : false; // Si está marcado, true; si no, false
        $data['esPap'] = $request->has('esPap') ? true : false;   // Lo mismo para 'esPap'

        Profesional::create($data);
        return redirect()->route('profesionales')->with('success', 'Profesional añadido correctamente');
    }

    public function show(string $id)
    {
        $profesional = Profesional::findOrFail($id);
        return view('profesionales.show', compact('profesional'));
    }

    public function edit(string $id)
    {
        $profesional = Profesional::findOrFail($id);
        return view('profesionales.edit', compact('profesional'));
    }

    public function update(Request $request, string $id)
    {
        /*$request->validate([
            'username' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|string|max:255|unique:profesionales,dni,' . $id,
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);*/

        $profesional = Profesional::findOrFail($id);

        $profesional->update([
            'username' => $request->username,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'esPati' => $request->has('esPati'), // Convierte checkbox en booleano
            'esPap' => $request->has('esPap'),
        ]);

        return redirect()->route('profesionales')->with('success', 'Profesional actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $profesional = Profesional::findOrFail($id);
        $profesional->delete();
        return redirect()->route('profesionales')->with('success', 'Profesional borrado correctamente');
    }
}
