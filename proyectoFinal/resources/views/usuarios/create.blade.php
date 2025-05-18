<?php 
    use app\Http\Controllers\UsuarioController;
    $usuarioController = new UsuarioController();
    $tutores = $usuarioController->getAllTutores();
?>

@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('contents')
<h1 class="mb-0">Añadir Usuario</h1>
<hr />
<form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre">
            @if ($errors->has('nombre'))
            <span class="text-danger">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
        <div class="col">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos">
            @if ($errors->has('apellidos'))
            <span class="text-danger">{{ $errors->first('apellidos') }}</span>
            @endif
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="dni">DNI</label>
            <input type="text" name="dni" class="form-control" placeholder="DNI">
            @if ($errors->has('dni'))
            <span class="text-danger">{{ $errors->first('dni') }}</span>
            @endif
        </div>
        <div class="col">
            <label for="direccion">Dirección</label>
            <input class="form-control" name="direccion" placeholder="Dirección"></input>
            @if ($errors->has('direccion'))
            <span class="text-danger">{{ $errors->first('direccion') }}</span>
            @endif
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" name="fecha_nacimiento" placeholder="Fecha de Nacimiento"></input>
            @if ($errors->has('fecha_nacimiento'))
            <span class="text-danger">{{ $errors->first('fecha_nacimiento') }}</span>
            @endif
        </div>
        <div class="col">
            <label for="grado_discapacidad">Grado de Discapacidad</label>
            <input type="number" class="form-control" name="grado_discapacidad"
                placeholder="Grado de Discapacidad"></input>
            @if ($errors->has('grado_discapacidad'))
            <span class="text-danger">{{ $errors->first('grado_discapacidad') }}</span>
            @endif
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="parentesco">Parentesco</label>
            <input type="text" name="parentesco" class="form-control" placeholder="Parentesco">
            @if ($errors->has('parentesco'))
            <span class="text-danger">{{ $errors->first('parentesco') }}</span>
            @endif
        </div>
        <div class="col">
            <label for="id_tutor">Tutor</label>
            <select name="id_tutor" class="form-control">
                <option value="">-- Selecciona un tutor --</option>
                @foreach ($tutores as $tutor)
                <option value="{{ $tutor->id }}">
                    {{ $tutor->nombre }} {{ $tutor->apellidos }}
                </option>
                @endforeach
            </select>
            @if ($errors->has('id_tutor'))
            <span class="text-danger">{{ $errors->first('id_tutor') }}</span>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label>Información Extra</label>
            <div class="col">
                <input class="form-checkbox-input" type="checkbox" name="esMenor" id="esMenor" value="1">
                <label for="esMenor">Es Menor</label>
            </div>
            <div class="col">
                <input class="form-checkbox-input" type="checkbox" name="tutoria_propia" id="tutoria_propia" value="1">
                <label for="tutoria_propia">Tutor de sí mismo</label>
            </div>
            @if ($errors->has('tutoria_propia'))
            <span class="text-danger">{{ $errors->first('tutoria_propia') }}</span>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" class="form-control" placeholder="Descripción">
            @if ($errors->has('descripcion'))
            <span class="text-danger">{{ $errors->first('descripcion') }}</span>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection