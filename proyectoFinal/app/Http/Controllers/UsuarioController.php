<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Usuario::with('tutor');

        if ($request->has('campo') && $request->has('filtro') && $request->has('valor')) {
            $campo = $request->input('campo');
            $filtro = $request->input('filtro');
            $valor = $request->input('valor');

            if ($filtro === 'like') {
                $query->where($campo, 'LIKE', "%$valor%");
            } elseif ($filtro === 'start') {
                $query->where($campo, 'LIKE', "$valor%");
            } elseif ($filtro === 'end') {
                $query->where($campo, 'LIKE', "%$valor");
            }
        }

        $usuarios = $query->get();

        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
    try{
        $errores = [];
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'nullable|string|max:255|unique:usuarios',
            'direccion' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'grado_discapacidad' => 'required|integer',
            'descripcion' => 'required|string',
            'id_tutor' => 'required|integer'
        ]);

        if ($validator->fails()) {
            $errores = $validator->errors()->toArray();
        }

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

        if($data['esMenor'] && $data['tutoria_propia']) {
            $errores['tutoria_propia'] = 'No se puede asignar tutoría propia a un menor';
        }

        Usuario::create($data);
        return redirect()->route('usuarios')->with('success', 'Usuario añadido correctamente');
    }
    catch(Exception $e){
        return redirect()->back()->withErrors($errores)->withInput();
    }
        
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
