@extends('layouts.app')

@section('title', 'Ver Profesional')

@section('contents')
<h1 class="mb-4">Detalles del Profesional</h1>

<div class="card shadow rounded">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Nombre</strong>
                <p class="mb-2">{{ $profesional->nombre }}</p>
            </div>
            <div class="col-md-6">
                <strong>Apellidos</strong>
                <p class="mb-2">{{ $profesional->apellidos }}</p>
            </div>
        </div>

        <div class="row mb-3">
            {{-- <div class="col-md-6">
                <strong>Username</strong>
                <p class="mb-2">{{ $profesional->username }}</p>
            </div> --}}
            <div class="col-md-6">
                <strong>Email</strong>
                <p class="mb-2">{{ $profesional->email }}</p>
            </div>
            <div class="col-md-6">
                <strong>Teléfono</strong>
                <p class="mb-2">{{ $profesional->telefono }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>DNI</strong>
                <p class="mb-2">{{ $profesional->dni }}</p>
            </div>
            <div class="col-md-6">
                <strong>Dirección</strong>
                <p class="mb-2">{{ $profesional->direccion }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Es PATI</strong>
                <p class="mb-2">{{ $profesional->esPati ? 'Sí' : 'No' }}</p>
            </div>
            <div class="col-md-6">
                <strong>Es PAP</strong>
                <p class="mb-2">{{ $profesional->esPap ? 'Sí' : 'No' }}</p>
            </div>
        </div>

        {{-- Línea separadora estilizada --}}
        <div class="my-4">
            <hr style="border-top: 1px solid #ccc;">
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <strong>Fecha de Creación</strong>
                <p class="mb-2 text-muted">{{ $profesional->created_at }}</p>
            </div>
            <div class="col-md-6">
                <strong>Última Actualización</strong>
                <p class="mb-0 text-muted">{{ $profesional->updated_at }}</p>
            </div>
        </div>
    </div>
</div>
@endsection