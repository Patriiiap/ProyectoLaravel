@extends('layouts.app')

@section('title', 'Usuario')

@section('contents')

<?php 
    use App\Http\Controllers\UsuarioController;
    $usuarioController = new UsuarioController();
    $profesionalesAptos = $usuarioController->getProfesionalesAptos($usuario->id, $usuario->esMenor);
?>

<h1 class="mb-4">Asignar Profesional</h1>

<div class="card shadow rounded">
    <div class="card-body">
        <div class="row mb-3">
            <strong>Usuario: &nbsp</strong>
            <p class="mb-2">{{ $usuario->nombre }} {{ $usuario->apellidos }}</p>
        </div>

        <div class="row mb-3">
            <div class="col-12">
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
                            <th>esPati</th>
                            <th>esPap</th>
                            <th>Ver Ficha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuario->profesionales as $profesional)
                        <tr>
                            <td>{{ $profesional->nombre }} {{ $profesional->apellidos }}</td>
                            <td>{{ $profesional->email }}</td>
                            <td>{{ $profesional->telefono }}</td>
                            <td>{{ $profesional->esPati ? 'Sí' : 'No'}}</td>
                            <td>{{ $profesional->esPap ? 'Sí' : 'No'}}</td>
                            <td><a href="{{ route('profesionales.show', $profesional->id) }}"
                                    class="btn btn-primary">Ver
                                    Ficha</a></td>
                            <td>
                                <form action="{{ route('usuarios.assignDestroy', ['idUsuario'=> $usuario->id, 'idProfesional' =>
                                    $profesional->id]) }}" method="POST" type="button" class="btn btn-danger p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Desasignar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>

        <div class="my-4">
            <hr style="border-top: 1px solid #ccc;">
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <strong>Profesionales Aptos para Asignar:</strong>
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>esPati</th>
                            <th>esPap</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($profesionalesAptos as $profesional)
                        <tr>
                            <td>{{ $profesional->nombre }} {{ $profesional->apellidos }}</td>
                            <td>{{ $profesional->email }}</td>
                            <td>{{ $profesional->telefono }}</td>
                            <td>{{ $profesional->esPati ? 'Sí' : 'No'}}</td>
                            <td>{{ $profesional->esPap ? 'Sí' : 'No'}}</td>
                            <td><a href="{{ route('usuarios.assign', ['idUsuario'=> $usuario->id, 'idProfesional' =>
                                    $profesional->id]) }}" class="btn btn-primary">Asignar</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection