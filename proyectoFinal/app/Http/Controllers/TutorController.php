<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class TutorController extends Controller
{
    public function index(Request $request)
    {
        $query = Tutor::with('usuarios');

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

        $tutores = $query->get();

        return view('tutores.index', ['tutores' => $tutores]);
    }

    public function create()
    {
        return view('tutores.create');
    }

    public function store(Request $request)
    {
        try {
        $errores = [];

        // Validación de datos con Validator
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:tutores',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tutores',
            'direccion' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'dni' => 'required|string|max:255|unique:profesionales',
            'telefono' => 'required|string|max:255',
            'cuenta_corriente' => 'required|string|max:255',
        ]);

        // Si hay errores en la validación, los agregamos
        if ($validator->fails()) {
            $errores = $validator->errors()->toArray();
        }

        // Procesar los valores booleanos
        $data = $request->only(['username', 'nombre', 'apellidos', 'email', 'dni', 'direccion', 'telefono', 'parentesco', 'cuenta_corriente', 'password']);

        // Si hay errores, redirigir con todos ellos
        if (!empty($errores)) {
            return redirect()->back()->withErrors($errores)->withInput($data);
        }

        // Crear el tutor
        Tutor::create($data);

        //Asignar el rol de tutor
        $tutorRole = Role::firstOrCreate([
            'name' => 'tutor',
            'guard_name' => 'tutor',
        ]);
        Tutor::where('email', $data['email'])->first()->assignRole($tutorRole);
        
        return redirect()->route('tutores')->with('success', 'Tutor añadido correctamente.');

        } catch (\Exception) {
            return redirect()->back()->withErrors($errores);
        }
    }

    public function show(string $id)
    {
        $tutor = Tutor::with('usuarios')->findOrFail($id);
        return view('tutores.show', compact('tutor'));
    }

    public function edit(string $id)
    {
        $tutor = Tutor::findOrFail($id);
        return view('tutores.edit', compact('tutor'));
    }

    public function update(Request $request, string $id)
    {
        $errores = [];
        try{
            $tutor = Tutor::findOrFail($id);

        // Validación de datos con Validator
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:tutores,username,' . $tutor->id,
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tutores,email,' . $tutor->id,
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'dni' => 'required|string|max:255|unique:tutores,dni,' . $tutor->id,
            'cuenta_corriente' => 'required|string|max:255',
        ]);
        // Si hay errores en la validación, los agregamos
        if ($validator->fails()) {
            $errores = $validator->errors()->toArray();
        }

        $data = $request->only(['username', 'nombre', 'apellidos', 'email', 'dni', 'direccion', 'telefono', 'parentesco', 'cuenta_corriente']);
        // Si hay errores, redirigir con todos ellos
        if (!empty($errores)) {
            return redirect()->back()->withErrors($errores)->withInput($data);
        }

        $tutor->update($data);
        return redirect()->route('tutores')->with('success', 'Tutor actualizado correctamente');
        } catch (\Exception) {
            return redirect()->back()->withErrors($errores);
        }
    }

    public function destroy(string $id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->delete();
        return redirect()->route('tutores')->with('success', 'Tutor borrado correctamente');
    }

    public function getTutor()
    {
        $tutor = Auth::guard('tutor')->user();

        if ($tutor instanceof \App\Models\Tutor) {
            $tutor->load('usuarios');
            return $tutor;
        }
    }
}
