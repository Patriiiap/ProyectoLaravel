<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


class ProfesionalController extends Controller
{

    public function index(Request $request)
    {
        $query = Profesional::query();

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

        $profesionales = $query->get();

        return view('profesionales.index', compact('profesionales'));
    }

    public function create()
    {
        return view('profesionales.create');
    }

    public function store(Request $request)
    {
        try {
        $errores = [];

        // Validación de datos con Validator
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:profesionales',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:profesionales',
            'dni' => 'required|string|max:255|unique:profesionales',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Si hay errores en la validación, los agregamos
        if ($validator->fails()) {
            $errores = $validator->errors()->toArray();
        }

        // Procesar los valores booleanos
        $data = $request->only(['username', 'nombre', 'apellidos', 'email', 'dni', 'direccion', 'telefono', 'password']);
        $data['esPati'] = $request->has('esPati');
        $data['esPap'] = $request->has('esPap');

        // Verificar si se seleccionó al menos un tipo de profesional
        if (!$data['esPati'] && !$data['esPap']) {
            $errores['tipoProfesional'] = ['Debe seleccionar al menos un tipo de profesional.'];
        }

        // Si hay errores, redirigir con todos ellos
        if (!empty($errores)) {
            return redirect()->back()->withErrors($errores)->withInput();
        }

        // Crear el profesional
        Profesional::create($data);

        // Asignar el rol de profesional
        $profesionalRole = Role::firstOrCreate([
            'name' => 'profesional',
            'guard_name' => 'profesional',
        ]);
        Profesional::where('username', $data['username'])->first()->assignRole($profesionalRole);

        return redirect()->route('profesionales')->with('success', 'Profesional añadido correctamente.');

        } catch (\Exception) {
            return redirect()->back()->withErrors($errores)->withInput($data);
        }
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
        $errores = [];

        try{

            $profesional = Profesional::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255|unique:profesionales,username,' . $id,
                'nombre' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:profesionales,email,' . $id,
                'dni' => 'required|string|max:255|unique:profesionales,dni,' . $id,
                'direccion' => 'required|string|max:255',
                'telefono' => 'nullable|string|max:20',
            ]);

            if ($validator->fails()) {
                $errores = $validator->errors()->toArray();
            }

            // Procesar los valores booleanos
            $data = $request->only(['username', 'nombre', 'apellidos', 'email', 'dni', 'direccion', 'telefono']);
            $data['esPati'] = $request->has('esPati');
            $data['esPap'] = $request->has('esPap');

            // Verificar si se seleccionó al menos un tipo de profesional
            if (!$data['esPati'] && !$data['esPap']) {
                $errores['tipoProfesional'] = ['Debe seleccionar al menos un tipo de profesional.'];
            }

            // Si hay errores, redirigir con todos ellos
            if (!empty($errores)) {
                return redirect()->back()->withErrors($errores)->withInput();
            }
            
            // Actualizar el profesional
            $profesional->update($data);
            return redirect()->route('profesionales')->with('success', 'Profesional actualizado correctamente');

        } catch (Exception $e) {
            $errores['general'] = ['Error al actualizar el profesional: ' . $e->getMessage()];
        }
    }

    public function destroy(string $id)
    {
        $profesional = Profesional::findOrFail($id);
        $profesional->delete();
        return redirect()->route('profesionales')->with('success', 'Profesional borrado correctamente');
    }

    public function profesionalesAptos(bool $esMenor)
    {
        if ($esMenor) {
            return Profesional::where('esPati', true)->get();
        } 
        else{
            return Profesional::where('esPap', true)->get();
        }
    }

    public function getUsuariosAptos(string $idProfesional, bool $esPati, bool $esPap)
    {
        $usuarioController = new UsuarioController();
        $usuariosAptos = $usuarioController->usuariosAptos($esPati, $esPap);

        $profesional = Profesional::findOrFail($idProfesional);
        $usuariosAsignados = $profesional->usuarios()->pluck('id')->toArray();

        $usuariosAptosDisponibles = $usuariosAptos->filter(function ($usuario) use ($usuariosAsignados) {
            return !in_array($usuario->id, $usuariosAsignados);
        });
        return $usuariosAptosDisponibles->values();
    }

    public function assignPage(string $id)
    {
        $profesional = Profesional::findOrFail($id);
        return view('profesionales.assign', compact('profesional'));
    }

    public function assign(string $usuarioId, string $profesionalId)
    {
        $profesional = Profesional::findOrFail($profesionalId);
        $profesional->usuarios()->attach($usuarioId);
        return redirect()->route('profesionales.assignPage', $profesional->id)->with('success', 'Usuario asignado correctamente');
    }

    public function assignDestroy(string $usuarioId, string $profesionalId)
    {
        $profesional = Profesional::findOrFail($profesionalId);
        $profesional->usuarios()->detach($usuarioId);
        return redirect()->route('profesionales.assignPage', $profesional->id)->with('success', 'Usuario asignado correctamente');
    }
}
