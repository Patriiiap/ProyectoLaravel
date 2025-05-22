<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $administradores = User::all();
        return view('administradores.index', compact('administradores'));
    }

    public function create()
    {
        return view('administradores.create');
    }

    public function store(Request $request)
    {
    try{
        $errores = [];
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            $errores = $validator->errors()->toArray();
        }

        $data = $request->only([
            'name',
            'email',
            'password'
        ]);

        // Asignar el rol de admin (tabla users)
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        
        User::create($data);

        User::where('email', $data['email'])->first()->assignRole($adminRole);
        return redirect()->route('administradores')->with('success', 'Administrador añadido correctamente');
    }
    catch(Exception $e){
        return redirect()->back()->withErrors($errores)->withInput();
    }
        
    }

    public function edit(string $id)
    {
        $administrador = User::findOrFail($id);
        return view('administradores.edit', compact('administrador'));
    }

    public function update(Request $request, string $id)
    {
        $errores = [];

        try{

            $administrador = User::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users'
            ]);
            
            if ($validator->fails()) {
                $errores = $validator->errors()->toArray();
            }
            
            $data = $request->only([
                'name',
                'email',
            ]);
            
            // Si hay errores, redirigir con todos ellos
            if (!empty($errores)) {
                return redirect()->back()->withErrors($errores)->withInput();
            }
            // Actualizar el usuario
            $administrador->update($data);
            return redirect()->route('administradores')->with('success', 'Administrador actualizado correctamente');

        } catch (Exception $e) {
            return redirect()->back()->withErrors($errores)->withInput();
        }
    }

    public function destroy(string $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('administradores')->with('success', 'Administrador borrado correctamente');
    }
}
