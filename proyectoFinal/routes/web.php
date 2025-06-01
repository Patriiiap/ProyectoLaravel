<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\ProfesionalGestionController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TutorGestionController;
use App\Http\Controllers\UserController;
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

    Route::get('forgot/password', 'forgotPassword')->name('forgot.password');
});

// Recuperación de contraseña para profesionales
Route::prefix('profesional')->group(function () {
    Route::get('password/reset', [\App\Http\Controllers\Auth\ProfesionalForgotPasswordController::class, 'showLinkRequestForm'])->name('profesional.password.request');
    Route::post('password/email', [\App\Http\Controllers\Auth\ProfesionalForgotPasswordController::class, 'sendResetLinkEmail'])->name('profesional.password.email');
    Route::get('password/reset/{token}', [\App\Http\Controllers\Auth\ProfesionalResetPasswordController::class, 'showResetForm'])->name('profesional.password.reset');
    Route::post('password/reset', [\App\Http\Controllers\Auth\ProfesionalResetPasswordController::class, 'reset'])->name('profesional.password.update');
});

// Recuperación de contraseña para tutores
Route::prefix('tutor')->group(function () {
    Route::get('password/reset', [\App\Http\Controllers\Auth\TutorForgotPasswordController::class, 'showLinkRequestForm'])->name('tutor.password.request');
    Route::post('password/email', [\App\Http\Controllers\Auth\TutorForgotPasswordController::class, 'sendResetLinkEmail'])->name('tutor.password.email');
    Route::get('password/reset/{token}', [\App\Http\Controllers\Auth\TutorResetPasswordController::class, 'showResetForm'])->name('tutor.password.reset');
    Route::post('password/reset', [\App\Http\Controllers\Auth\TutorResetPasswordController::class, 'reset'])->name('tutor.password.update');
});

// Recuperación de contraseña para administradores
Route::prefix('admin')->group(function () {
    Route::get('password/reset', [\App\Http\Controllers\Auth\AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email', [\App\Http\Controllers\Auth\AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset/{token}', [\App\Http\Controllers\Auth\AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('password/reset', [\App\Http\Controllers\Auth\AdminResetPasswordController::class, 'reset'])->name('admin.password.update');
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

        Route::controller(UserController::class)->prefix('administradores')->group(function () {
            Route::get('', 'index')->name('administradores');
            Route::get('create', 'create')->name('administradores.create');
            Route::post('store', 'store')->name('administradores.store');
            Route::get('edit/{id}', 'edit')->name('administradores.edit');
            Route::put('edit/{id}', 'update')->name('administradores.update');
            Route::delete('destroy/{id}', 'destroy')->name('administradores.destroy');
        });
    });

    //Route::middleware('role:tutor')->group(function () {
    Route::controller(TutorGestionController::class)->prefix('tutorgestion')->group(function () {
        Route::get('tutordashboard', function () {return view('vistastutor.dashboard');})->name('vistastutor.dashboard');
        Route::get('crear-cita', 'crearCita')->name('vistastutor.crearCita');
        Route::post('citas/store', 'storeCita')->name('vistastutor.storeCita');
        Route::get('vistastutor/verFacturas', 'verFacturas')->name('vistastutor.verFacturas');
        Route::post('vistastutor/generarFactura', 'generarFactura')->name('vistastutor.generarFactura');
    });
    //});

    //Route::middleware('role:profesional')->group(function () {
        Route::controller(ProfesionalGestionController::class)->prefix('profesionalgestion')->group(function () {
            Route::get('profesionaldashboard', function () {return view('vistasprofesional.dashboard'); })->name('vistasprofesional.dashboard');
            Route::get('vistasprofesional/verFacturas', 'verFacturas')->name('vistasprofesional.verFacturas');
            Route::post('vistasprofesional/generarFactura', 'generarFactura')->name('vistasprofesional.generarFactura');
        });
    //});
    

    Route::controller(CitaController::class)->prefix('citas')->group(function () {
        // Route::get('/eventos-tutores', 'getEventosTutores');
        // Route::get('/eventos-profesionales', 'getEventosProfesionales');
        Route::get('/eventos-borrar/{idCita}', 'destroyCita')->name('citas.destroy');
        Route::get('/confirmar', 'confirmarCita')->name('citas.confirmar');
        Route::get('/confirmar-boton-tutor/{idCita}', 'confirmarCitaByButtonTutor')->name('citas.confirmar.boton.tutor');
        Route::get('/confirmar-boton-profesional/{idCita}', 'confirmarCitaByButtonProfesional')->name('citas.confirmar.boton.profesional');
    });
    Route::get('/citas-eventos-tutores', [CitaController::class, 'getEventosTutores']);
    Route::get('/citas-eventos-profesionales', [CitaController::class, 'getEventosProfesionales']);
    
    //Rutas para crear nueva cita
    Route::get('/api/usuarios/{id}/profesionales', [UsuarioController::class, 'getProfesionales']);

    //Ruta al perfil
    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');  

    //Route::middleware(['auth'])->group(function () {
        Route::get('qrcodes/generate/{id}', [QrCodeController::class, 'generarQR'])->name('qrcodes.generate');
        Route::get('qrcodes/scan/{id}', [QrCodeController::class, 'scan'])->name('qrcodes.scan');
    //});
//});





