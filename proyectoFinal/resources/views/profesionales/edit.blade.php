@extends('layouts.app')

@section('title', 'Editar Profesional')

@section('contents')
<h1 class="mb-0">Editar Profesional</h1>
<hr />
<form action="{{ route('profesionales.update', $profesional->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nombre de Usuario</label>
            <input type="text" name="username" class="form-control" placeholder="username"
                value="{{ $profesional->username }}">
        </div>
        <div class="col mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre"
                value="{{ $profesional->nombre }}">
        </div>
        <div class="col mb-3">
            <label class="form-label">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos"
                value="{{ $profesional->apellidos }}">
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">DNI</label>
            <input type="text" name="dni" class="form-control" placeholder="DNI" value="{{ $profesional->dni }}">
        </div>
        <div class="col mb-3">
            <label class="form-label">Dirección</label>
            <input class="form-control" name="direccion" placeholder="Dirección"
                value="{{ $profesional->direccion }}"></input>
        </div>
        <div class="col mb-3">
            <label class="form-label">Teléfono</label>
            <input class="form-control" name="telefono" placeholder="Teléfono"
                value="{{ $profesional->telefono }}"></input>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <input class="form-checkbox-input" type="checkbox" name="esPati" id="esPati" {{$profesional->esPati ?
            'checked' : ''}}>
            <label for="esPati">Es PATI</label>
        </div>
        <div class="col">
            <input class="form-checkbox-input" type="checkbox" name="esPap" id="esPap" {{$profesional->esPap ? 'checked'
            : ''}}>
            <label for="esPap">Es PAP</label>
        </div>
    </div>
    <div class="row">
        <div class="d-grid">
            <button class="btn btn-warning">Update</button>
        </div>
    </div>
</form>
@endsection