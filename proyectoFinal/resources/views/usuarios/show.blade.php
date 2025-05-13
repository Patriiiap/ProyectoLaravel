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

        <div class="my-4">
            <hr style="border-top: 1px solid #ccc;">
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Profesionales Asignados:</strong>
                @if($usuario->profesionales->isEmpty())
                <p class="text-muted">No hay profesionales asignados.</p>
                @else
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Ver Ficha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuario->profesionales as $profesional)
                        <tr>
                            <td>{{ $profesional->nombre }} {{ $profesional->apellidos }}</td>
                            <td>{{ $profesional->email }}</td>
                            <td>{{ $profesional->telefono }}</td>
                            <td><a href="{{ route('profesionales.show', $profesional->id) }}"
                                    class="btn btn-primary">Ver
                                    Ficha</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

                <div class="mb-3">
                    <a href="{{ route('usuarios.assignPage', $usuario->id) }}" class="btn btn-primary">
                        Asignar Profesional
                    </a>
                </div>
            </div>
        </div>

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