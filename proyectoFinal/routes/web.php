<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TutorGestionController;
use App\Http\Controllers\UsuarioController;
use App\Models\Cita;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

//Route::middleware('auth:web')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('dashboard', function () {
        return view('dashboard');
        })->name('dashboard');

        Route::controller(ProfesionalController::class)->prefix('profesionales')->group(function () {
            Route::get('', 'index')->name('profesionales');
            Route::get('create', 'create')->name('profesionales.create');
            Route::post('store', 'store')->name('profesionales.store');
            Route::get('show/{id}', 'show')->name('profesionales.show');
            Route::get('edit/{id}', 'edit')->name('profesionales.edit');
            Route::put('edit/{id}', 'update')->name('profesionales.update');
            Route::delete('destroy/{id}', 'destroy')->name('profesionales.destroy');
            Route::get('assign-page/{id}', 'assignPage')->name('profesionales.assignPage');
            Route::get('assign/{idUsuario}/{idProfesional}', 'assign')->name('profesionales.assign');
            Route::delete('assign-destroy/{idUsuario}/{idProfesional}', 'assignDestroy')->name('profesionales.assignDestroy');
        });

        Route::controller(TutorController::class)->prefix('tutores')->group(function () {
            Route::get('', 'index')->name('tutores');
            Route::get('create', 'create')->name('tutores.create');
            Route::post('store', 'store')->name('tutores.store');
            Route::get('show/{id}', 'show')->name('tutores.show');
            Route::get('edit/{id}', 'edit')->name('tutores.edit');
            Route::put('edit/{id}', 'update')->name('tutores.update');
            Route::delete('destroy/{id}', 'destroy')->name('tutores.destroy');
        });

        Route::controller(UsuarioController::class)->prefix('usuarios')->group(function () {
            Route::get('', 'index')->name('usuarios');
            Route::get('create', 'create')->name('usuarios.create');
            Route::post('store', 'store')->name('usuarios.store');
            Route::get('show/{id}', 'show')->name('usuarios.show');
            Route::get('edit/{id}', 'edit')->name('usuarios.edit');
            Route::put('edit/{id}', 'update')->name('usuarios.update');
            Route::delete('destroy/{id}', 'destroy')->name('usuarios.destroy');
            Route::get('assign-page/{id}', 'assignPage')->name('usuarios.assignPage');
            Route::get('assign/{idUsuario}/{idProfesional}', 'assign')->name('usuarios.assign');
            Route::delete('assign-destroy/{idUsuario}/{idProfesional}', 'assignDestroy')->name('usuarios.assignDestroy');
        });
    });

    //Route::middleware('role:tutor')->group(function () {
    Route::controller(TutorGestionController::class)->prefix('tutorgestion')->group(function () {
        Route::get('tutordashboard', function () {return view('vistastutor.dashboard');})->name('vistastutor.dashboard');
        Route::get('crear-cita', 'crearCita')->name('vistastutor.crearCita');
        Route::post('citas/store', 'storeCita')->name('vistastutor.storeCita');
    });
        
    //});

    //Route::middleware('role:profesional')->group(function () {
        Route::get('profesionaldashboard', function () {
            return view('vistasprofesional.dashboard'); 
        })->name('vistasprofesional.dashboard');
    //});

    Route::get('/citas-eventos-tutores', [CitaController::class, 'getEventosTutores']);
    Route::get('/citas-eventos-profesionales', [CitaController::class, 'getEventosProfesionales']);
    Route::get('/citas-confirmar', [CitaController::class, 'confirmarCita'])->name('citas.confirmar');
    
    //Rutas para crear nueva cita
    Route::get('/api/usuarios/{id}/profesionales', [UsuarioController::class, 'getProfesionales']);

    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');  

    //Route::middleware(['auth'])->group(function () {
        Route::get('qrcodes/generate/{id}', [QrCodeController::class, 'generarQR'])->name('qrcodes.generate');
        Route::get('qrcodes/scan/{id}', [QrCodeController::class, 'scan'])->name('qrcodes.scan');
    //});
//});





