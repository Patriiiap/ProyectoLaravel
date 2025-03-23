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
        </div>
        <div class="col">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="dni">DNI</label>
            <input type="text" name="dni" class="form-control" placeholder="DNI">
        </div>
        <div class="col">
            <label for="direccion">Dirección</label>
            <input class="form-control" name="direccion" placeholder="Dirección"></input>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" name="fecha_nacimiento" placeholder="Fecha de Nacimiento"></input>
        </div>
        <div class="col">
            <label for="grado_discapacidad">Grado de Discapacidad</label>
            <input type="number" class="form-control" name="grado_discapacidad"
                placeholder="Grado de Discapacidad"></input>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <input class="form-checkbox-input" type="checkbox" name="esMenor" id="esMenor" value="1">
            <label for="esMenor">Es Menor</label>
        </div>
        <div class="col">
            <input class="form-checkbox-input" type="checkbox" name="tutoria_propia" id="tutoria_propia" value="1">
            <label for="tutoria_propia">Tutor de sí mismo</label>
        </div>
        <div class="col">
            <label for="id_tutor">Id del Tutor</label>
            <input type="number" name="id_tutor" class="form-control" placeholder="ID del Tutor">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" class="form-control" placeholder="Descripción">
        </div>
    </div>

    <div class="row">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection