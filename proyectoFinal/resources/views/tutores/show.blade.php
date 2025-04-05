@extends('layouts.app')

@section('title', 'Ver Tutor')

@section('contents')
<h1 class="mb-0">Detalles del Tutor</h1>
<hr />
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $tutor->username }}"
            readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Email</label>
        <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $tutor->email }}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $tutor->nombre }}"
            readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" value="{{ $tutor->apellidos }}"
            readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">DNI</label>
        <input type="text" name="dni" class="form-control" placeholder="DNI" value="{{ $tutor->dni }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="{{ $tutor->telefono }}"
            readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Parentesco</label>
        <input type="text" name="parentesco" class="form-control" placeholder="Parentesco"
            value="{{ $tutor->parentesco }}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control" placeholder="Dirección" value="{{ $tutor->direccion }}"
            readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Cuenta Corriente</label>
        <input type="text" name="cuenta_corriente" class="form-control" placeholder="Cuenta Corriente"
            value="{{ $tutor->cuenta_corriente}}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Created At</label>
        <input type="text" name="created_at" class="form-control" placeholder="Created At"
            value="{{ $tutor->created_at }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Updated At</label>
        <input type="text" name="updated_at" class="form-control" placeholder="Updated At"
            value="{{ $tutor->updated_at }}" readonly>
    </div>
</div>
@endsection