@extends('layouts.app')

@section('title', 'Ver Profesional')

@section('contents')
<h1 class="mb-0">Detalles del Profesional</h1>
<hr />
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" placeholder="Username"
            value="{{ $profesional->username }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $profesional->nombre }}"
            readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" placeholder="Apellidos"
            value="{{ $profesional->apellidos }}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">DNI</label>
        <input type="text" name="dni" class="form-control" placeholder="DNI" value="{{ $profesional->dni }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control" placeholder="Dirección"
            value="{{ $profesional->direccion }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" placeholder="Teléfono"
            value="{{ $profesional->telefono }}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Es PATI</label>
        <input type="text" name="esPati" class="form-control" placeholder="Es PATI"
            value="{{ $profesional->esPati ? 'Sí' : 'No'}}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Es PAP</label>
        <input type="text" name="esPap" class="form-control" placeholder="Es PAP"
            value="{{ $profesional->esPap ? 'Sí' : 'No'}}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Created At</label>
        <input type="text" name="created_at" class="form-control" placeholder="Created At"
            value="{{ $profesional->created_at }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Updated At</label>
        <input type="text" name="updated_at" class="form-control" placeholder="Updated At"
            value="{{ $profesional->updated_at }}" readonly>
    </div>
</div>
@endsection