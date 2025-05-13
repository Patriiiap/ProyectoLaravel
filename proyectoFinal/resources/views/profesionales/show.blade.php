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

        <div class="my-4">
            <hr style="border-top: 1px solid #ccc;">
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <strong>Usuarios Asignados:</strong>
                @if($profesional->usuarios->isEmpty())
                <p class="text-muted">No hay usuarios asignados.</p>
                @else
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Grado de Discapacidad</th>
                            <th>Descripción</th>
                            <th>Es Menor</th>
                            <th>Ver Ficha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($profesional->usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->nombre }} {{ $usuario->apellidos }}</td>
                            <td>{{ $usuario->grado_discapacidad }}</td>
                            <td>{{ $usuario->descripcion }}</td>
                            <td>{{ $usuario->esMenor ? 'Sí' : 'No' }}</td>
                            <td><a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-primary">Ver
                                    Ficha</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

                <div class="mb-3">
                    <a href="{{ route('profesionales.assignPage', $profesional->id) }}" class="btn btn-primary">
                        Asignar Usuario
                    </a>
                </div>
            </div>
        </div>

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