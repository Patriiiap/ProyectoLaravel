@extends('layouts.app')

@section('title', 'Editar Tutor')

@section('contents')
<h1 class="mb-0">Editar Tutor</h1>
<hr />
<form action="{{ route('tutores.update', $tutor->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nombre de Usuario</label>
            <input type="text" name="username" class="form-control" placeholder="username"
                value="{{ $tutor->username }}">
        </div>
        <div class="col mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $tutor->nombre }}">
        </div>
        <div class="col mb-3">
            <label class="form-label">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos"
                value="{{ $tutor->apellidos }}">
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">DNI</label>
            <input type="text" name="dni" class="form-control" placeholder="DNI" value="{{ $tutor->dni }}">
        </div>
        <div class="col mb-3">
            <label class="form-label">Teléfono</label>
            <input class="form-control" name="telefono" placeholder="Teléfono" value="{{ $tutor->telefono }}"></input>
        </div>
        <div class="col mb-3">
            <label class="form-label">Parentesco</label>
            <input class="form-control" name="parentesco" placeholder="Parentesco"
                value="{{ $tutor->parentesco }}"></input>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" placeholder="Dirección"
                value="{{ $tutor->direccion }}">
        </div>
        <div class="col mb-3">
            <label class="form-label">Cuenta Corriente</label>
            <input class="form-control" name="cuenta_corriente" placeholder="Cuenta Corriente"
                value="{{$tutor->cuenta_corriente }}"></input>
        </div>
    </div>
    <div class="row">
        <div class="d-grid">
            <button class="btn btn-warning">Update</button>
        </div>
    </div>
</form>
@endsection