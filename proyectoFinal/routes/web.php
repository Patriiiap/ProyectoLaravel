<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
        });
    });

    Route::middleware('role:tutor')->group(function () {
        Route::get('tutordashboard', function () {
            return view('vistastutor.dashboard');  // Esta es la vista para el dashboard del tutor
        })->name('vistastutor.dashboard');
    });

    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');  
//});





