@extends('layouts.app')

@section('title', 'Ver Usuario')

@section('contents')
<h1 class="mb-4">Detalles del Usuario</h1>

<div class="card shadow rounded">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Nombre</strong>
                <p class="mb-2">{{ $usuario->nombre }}</p>
            </div>
            <div class="col-md-6">
                <strong>Apellidos</strong>
                <p class="mb-2">{{ $usuario->apellidos }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Dirección</strong>
                <p class="mb-2">{{ $usuario->direccion }}</p>
            </div>
            <div class="col-md-6">
                <strong>DNI</strong>
                <p class="mb-2">{{ $usuario->dni }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Fecha de Nacimiento</strong>
                <p class="mb-2">{{ $usuario->fecha_nacimiento }}</p>
            </div>
            <div class="col-md-6">
                <strong>Grado de Discapacidad</strong>
                <p class="mb-2">{{ $usuario->grado_discapacidad }}%</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Tutor</strong>
                <p class="mb-2"><strong>Nombre: </strong>{{ $usuario->tutor->nombre . " " . $usuario->tutor->apellidos}}
                </p>
                <p class="mb-2"><strong>Teléfono: </strong>{{ $usuario->tutor->telefono}}
                </p>
                <p class="mb-2"><strong>Email: </strong>{{ $usuario->tutor->email}}
                </p>
                <div class="mb-3">
                    <a href="{{ route('tutores.show', $usuario->tutor->id) }}" class="btn btn-primary">
                        Ver Ficha del Tutor
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <strong>Descripción</strong>
                <p class="mb-2">{{ $usuario->descripcion }}</p>
            </div>
        </div>


        {{-- Línea separadora estilizada --}}
        <div class="my-4">
            <hr style="border-top: 1px solid #ccc;">
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Fecha de Creación</strong>
                <p class="mb-2 text-muted">{{ $usuario->created_at }}</p>
            </div>
            <div class="col-md-6">
                <strong>Última Actualización</strong>
                <p class="mb-0 text-muted">{{ $usuario->updated_at }}</p>
            </div>
        </div>
    </div>
</div>
@endsection