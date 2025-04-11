@extends('layouts.app')

@section('title', 'Ver Tutor')

@section('contents')
<h1 class="mb-4">Detalles del Tutor</h1>

<div class="card shadow rounded">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Nombre</strong>
                <p class="mb-2">{{ $tutor->nombre }}</p>
            </div>
            <div class="col-md-6">
                <strong>Apellidos</strong>
                <p class="mb-2">{{ $tutor->apellidos }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Email</strong>
                <p class="mb-2">{{ $tutor->email }}</p>
            </div>
            <div class="col-md-6">
                <strong>Teléfono</strong>
                <p class="mb-2">{{ $tutor->telefono }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>DNI</strong>
                <p class="mb-2">{{ $tutor->dni }}</p>
            </div>
            <div class="col-md-6">
                <strong>Dirección</strong>
                <p class="mb-2">{{ $tutor->direccion }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Cuenta Corriente</strong>
                <p class="mb-2">{{ $tutor->cuenta_corriente }}</p>
            </div>
        </div>

        {{-- Tabla de usuarios --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <strong>Usuarios</strong>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Parentesco</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tutor->usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->nombre . " " . $usuario->apellidos }}</td>
                            <td>{{ $usuario->nombre . " " . $usuario->apellidos }}</td>
                            <td>
                                <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-primary btn-sm">Ver
                                    Ficha</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Línea separadora estilizada --}}
        <div class="my-4">
            <hr style="border-top: 1px solid #ccc;">
        </div>

        <div class="row">
            <div class="col-md-6">
                <strong>Fecha de Creación</strong>
                <p class="mb-2 text-muted">{{ $tutor->created_at }}</p>
            </div>
            <div class="col-md-6">
                <strong>Última Actualización</strong>
                <p class="mb-2 text-muted">{{ $tutor->updated_at }}</p>
            </div>
        </div>
    </div>
</div>
@endsection