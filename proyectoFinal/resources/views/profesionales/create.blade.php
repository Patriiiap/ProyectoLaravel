@extends('layouts.app')

@section('title', 'Crear Profesional')

@section('contents')
<h1 class="mb-0">Añadir Profesional</h1>
<hr />
<form action="{{ route('profesionales.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <label for="username">Nombre de Usuario</label>
            <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <div class="col">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" placeholder="Contraseña">
        </div>
    </div>
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
            <label for="telefono">Teléfono</label>
            <input class="form-control" name="telefono" placeholder="Teléfono"></input>
        </div>
        <div class="col">

        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <input class="form-checkbox-input" type="checkbox" name="esPati" id="esPati" value="1">
            <label for="esPati">Es PATI</label>
        </div>
        <div class="col">
            <input class="form-checkbox-input" type="checkbox" name="esPap" id="esPap" value="1">
            <label for="esPap">Es PAP</label>
        </div>
    </div>

    <div class="row">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection