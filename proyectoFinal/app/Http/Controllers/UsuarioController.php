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
            'id_tutor' => 'required|integer',
            'parentesco' => 'required|string|max:255',
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
            'id_tutor',
            'parentesco'
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
        $usuario = Usuario::with('tutor')->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, string $id)
    {
        $errores = [];

        try{

            $usuario = Usuario::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'dni' => 'nullable|string|max:255|unique:usuarios,dni,' . $usuario->id,
                'direccion' => 'required|string|max:255',
                'fecha_nacimiento' => 'required|date',
                'grado_discapacidad' => 'required|integer',
                'descripcion' => 'required|string',
                'id_tutor' => 'required|integer',
                'parentesco' => 'required|string|max:255',
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
                'id_tutor',
                'parentesco'
            ]);
            $data['esMenor'] = $request->has('esMenor') ? true : false; // Si está marcado, true; si no, false
            $data['tutoria_propia'] = $request->has('tutoria_propia') ? true : false;
            if($data['esMenor'] && $data['tutoria_propia']) {
                $errores['tutoria_propia'] = 'No se puede asignar tutoría propia a un menor';
            }
            // Si hay errores, redirigir con todos ellos
            if (!empty($errores)) {
                return redirect()->back()->withErrors($errores)->withInput();
            }
            // Actualizar el usuario
            $usuario->update($data);
            return redirect()->route('usuarios')->with('success', 'Usuario actualizado correctamente');

        } catch (Exception $e) {
            return redirect()->back()->withErrors($errores)->withInput();
        }
    }

    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios')->with('success', 'Usuario borrado correctamente');
    }

    public function usuariosAptos(bool $esPati, bool $esPap)
    {
        $usuarios = collect();

        if ($esPati) {
            $usuarios = $usuarios->merge(Usuario::where('esMenor', true)->get());
        }

        if ($esPap) {
            $usuarios = $usuarios->merge(Usuario::where('esMenor', false)->get());
        }

        return $usuarios->unique('id')->values();
    }

    public function getProfesionalesAptos(string $idUsuario, bool $esMenor)
    {
        $profesionalController = new ProfesionalController();
        $profesionalesAptos = $profesionalController->profesionalesAptos($esMenor);

        $usuario = Usuario::findOrFail($idUsuario);
        $profesionalesAsignados = $usuario->profesionales()->pluck('id')->toArray();

        $profesionalesAptosDisponibles = $profesionalesAptos->filter(function ($profesional) use ($profesionalesAsignados) {
            return !in_array($profesional->id, $profesionalesAsignados);
        });
        return $profesionalesAptosDisponibles->values();
    }

    public function assignPage(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.assign', compact('usuario'));
    }

    public function assign(string $usuarioId, string $profesionalId)
    {
        $usuario = Usuario::findOrFail($usuarioId);
        $usuario->profesionales()->attach($profesionalId);
        return redirect()->route('usuarios.assignPage', $usuario->id)->with('success', 'Profesional asignado correctamente');
    }

    public function assignDestroy(string $usuarioId, string $profesionalId)
    {
        $usuario = Usuario::findOrFail($usuarioId);
        $usuario->profesionales()->detach($profesionalId);
        return redirect()->route('usuarios.assignPage', $usuario->id)->with('success', 'Profesional eliminado correctamente');
    }

    public function getProfesionales($id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario->profesionales()->select('id', 'nombre', 'apellidos')->get());
    }

    public function getAllTutores()
    {
        $tutorController = new TutorController();
        return $tutorController->getAllTutores();
    }

    public function getUsuarioById(string $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            abort(404, 'Profesional no encontrado');
        }
        return $usuario;
    }

}
