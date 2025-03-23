@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('contents')
<h1 class="mb-0">Editar Usuario</h1>
<hr />
<form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $usuario->nombre }}">
        </div>
        <div class="col mb-3">
            <label class="form-label">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos"
                value="{{ $usuario->apellidos }}">
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Dirección</label>
            <input class="form-control" name="direccion" placeholder="Dirección"
                value="{{ $usuario->direccion }}"></input>
        </div>
        <div class="col mb-3">
            <label class="form-label">DNI</label>
            <input type="text" name="dni" class="form-control" placeholder="DNI" value="{{ $usuario->dni }}">
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Fecha de Nacimiento</label>
            <input class="form-control" name="fecha_nacimiento" placeholder="Fecha de Nacimiento"
                value="{{ $usuario->fecha_nacimiento }}"></input>
        </div>
        <div class="col mb-3">
            <label class="form-label">Grado de Discapacidad</label>
            <input type="text" name="grado_discapacidad" class="form-control" placeholder="Grado de Discapacidad"
                value="{{ $usuario->grado_discapacidad }}">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <input class="form-checkbox-input" type="checkbox" name="esMenor" id="esMenor" {{$usuario->esMenor ?
            'checked' : ''}}>
            <label for="esPati">Es Menor</label>
        </div>
        <div class="col">
            <input class="form-checkbox-input" type="checkbox" name="tutoria_propia" id="tutoria_propia"
                {{$usuario->tutoria_propia ?
            'checked'
            : ''}}>
            <label for="esPap">Tutoria Propia</label>
        </div>
        <div class="col">
            <label for="id_tutor">Id del Tutor</label>
            <input type="number" name="id_tutor" class="form-control" placeholder="ID del Tutor"
                value="{{ $usuario->id_tutor }}">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" class="form-control" placeholder="Descripción"
                value="{{ $usuario->descripcion }}">
        </div>
    </div> <br>
    <div class="row">
        <div class="d-grid">
            <button class="btn btn-warning">Update</button>
        </div>
    </div>
</form>
@endsection