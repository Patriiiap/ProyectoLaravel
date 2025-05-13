@extends('layouts.app')

@section('title', 'Profesional')

@section('contents')

<?php 
    use App\Http\Controllers\ProfesionalController;
    $profesionalController = new ProfesionalController();
    $usuariosAptos = $profesionalController->getUsuariosAptos($profesional->id, $profesional->esPati, $profesional->esPap);
?>

<h1 class="mb-4">Asignar Usuario</h1>

<div class="card shadow rounded">
    <div class="card-body">
        <div class="row mb-3">
            <strong>Profesional: &nbsp</strong>
            <p class="mb-2">{{ $profesional->nombre }} {{ $profesional->apellidos }}</p>
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
                            <th>Acción</th>
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
                            <td>
                                <form action="{{ route('profesionales.assignDestroy', ['idUsuario'=> $usuario->id, 'idProfesional' =>
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
                <strong>Usuarios Aptos para Asignar:</strong>
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Grado de Discapacidad</th>
                            <th>Descripción</th>
                            <th>Es Menor</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuariosAptos as $usuario)
                        <tr>
                            <td>{{ $usuario->nombre }} {{ $usuario->apellidos }}</td>
                            <td>{{ $usuario->grado_discapacidad }}</td>
                            <td>{{ $usuario->descripcion }}</td>
                            <td>{{ $usuario->esMenor ? 'Sí' : 'No' }}</td>
                            <td><a href="{{ route('profesionales.assign', ['idUsuario'=> $usuario->id, 'idProfesional' => $profesional->id]) }}"
                                    class="btn btn-primary">Asignar</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection