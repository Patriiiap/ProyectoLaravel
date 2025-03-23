<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('id')->get();
        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        /*$request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'nullable|string|max:255|unique:usuarios',
            'direccion' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'grado_discapacidad' => 'required|integer',
            'descripcion' => 'required|string',
            'id_tutor' => 'required|integer'
        ]);*/

        $data = $request->only([
            'nombre',
            'apellidos',
            'dni',
            'direccion',
            'fecha_nacimiento',
            'grado_discapacidad',
            'descripcion',
            'id_tutor'
        ]);

        $data['esMenor'] = $request->has('esMenor') ? true : false; // Si está marcado, true; si no, false
        $data['tutoria_propia'] = $request->has('tutoria_propia') ? true : false;

        Usuario::create($data);
        return redirect()->route('usuarios')->with('success', 'Usuario añadido correctamente');
    }

    public function show(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->update([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'direccion' => $request->direccion,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'grado_discapacidad' => $request->grado_discapadidad,
            'descripcion' => $request->descripcion,
            'esMenor' => $request->has('esMenor'), // Convierte checkbox en booleano
            'tutoria_propia' => $request->has('tutoria_propia'),
            'id_tutor' => $request->id_tutor
        ]);

        return redirect()->route('usuarios')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios')->with('success', 'Usuario borrado correctamente');
    }
}
