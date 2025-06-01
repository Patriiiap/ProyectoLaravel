<?php
  
namespace App\Http\Controllers;
  
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
  
class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }
  
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();
  
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Admin'
        ]);
  
        return redirect()->route('login');
    }
  
    public function login()
    {
        return view('auth/login');
    }
  
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        $credentials = $request->only('email', 'password');

        // Intentar login con 'web' (admin por defecto)
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('dashboard');  // Redirigir al dashboard del admin
        }

        // Intentar login con 'tutor'
        if (Auth::guard('tutor')->attempt($credentials)) {
            return redirect()->route('vistastutor.dashboard');  // Redirigir al dashboard del tutor
        }

        // Intentar login con 'profesional'
        if (Auth::guard('profesional')->attempt($credentials)) {
            return redirect()->route('vistasprofesional.dashboard');  // Redirigir al dashboard del profesional
        }

        // Si las credenciales no son correctas
        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }
  
    public function logout(Request $request)
    {
        // Auth::guard('web')->logout();
  
        // $request->session()->invalidate();
  
        // return redirect('/');
        Auth::logout();  // Logout para cualquier guard
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
 
    public function profile()
    {
        return view('profile');
    }

    public function forgotPassword(){
        return view('auth.forgotpass');
    }
}
