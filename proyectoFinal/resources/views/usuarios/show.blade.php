@extends('layouts.app')

@section('title', 'Ver Usuario')

@section('contents')
<h1 class="mb-0">Detalles del Usuario</h1>
<hr />
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $usuario->nombre }}"
            readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" placeholder="Apellidos"
            value="{{ $usuario->apellidos }}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control" placeholder="Dirección"
            value="{{ $usuario->direccion }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">DNI</label>
        <input type="text" name="dni" class="form-control" placeholder="DNI" value="{{ $usuario->dni }}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" class="form-control" placeholder="Fecha de Nacimiento"
            value="{{ $usuario->fecha_nacimiento }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Grado de Discapacidad</label>
        <input type="integer" name="grado_discapacidad" class="form-control" placeholder="Grado de discapacidad"
            value="{{ $usuario->grado_discapacidad}}%" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Descripción</label>
        <input type="text" name="descripcion" class="form-control" placeholder="Descripción"
            value="{{ $usuario->descripcion }}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Created At</label>
        <input type="text" name="created_at" class="form-control" placeholder="Created At"
            value="{{ $usuario->created_at }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Updated At</label>
        <input type="text" name="updated_at" class="form-control" placeholder="Updated At"
            value="{{ $usuario->updated_at }}" readonly>
    </div>
</div>
@endsection