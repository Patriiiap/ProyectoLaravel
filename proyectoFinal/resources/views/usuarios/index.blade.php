@extends('layouts.app')

@section('title', 'Usuarios')

@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Listado de Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Añadir Usuario</a>
</div>
<hr />
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif

<form method="GET" action="{{ route('usuarios') }}" class="mb-3">
    <div class="input-group">
        <!-- Selector para el campo -->
        <select name="campo" class="form-control" required>
            <option value="nombre" {{ request()->input('campo') == 'nombre' ? 'selected' : '' }}>Nombre</option>
            <option value="apellidos" {{ request()->input('campo') == 'apellidos' ? 'selected' : '' }}>Apellidos
            </option>
            <option value="dni" {{ request()->input('campo') == 'dni' ? 'selected' : '' }}>DNI</option>
        </select>

        <!-- Selector para el tipo de filtro -->
        <select name="filtro" class="form-control" required>
            <option value="like" {{ request()->input('filtro') == 'like' ? 'selected' : '' }}>Contiene</option>
            <option value="start" {{ request()->input('filtro') == 'start' ? 'selected' : '' }}>Empieza con</option>
            <option value="end" {{ request()->input('filtro') == 'end' ? 'selected' : '' }}>Termina con</option>
        </select>

        <!-- Campo de búsqueda -->
        <input type="text" name="valor" class="form-control" placeholder="Buscar"
            value="{{ request()->input('valor') }}">

        <button class="btn btn-primary" type="submit">Buscar</button>
    </div>
</form>

<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>DNI</th>
            <th>Fecha de Nacimiento</th>
            <th>Grado de Discapacidad</th>
            <th>Descripción</th>
            <th>esMenor</th>
            <th>Tutor</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($usuarios->count() > 0)
        @foreach($usuarios as $usuario)
        <tr>
            <td class="align-middle">{{ $usuario->id }}</td>
            <td class="align-middle">{{ $usuario->nombre }}</td>
            <td class="align-middle">{{ $usuario->apellidos }}</td>
            <td class="align-middle">{{ $usuario->direccion }}</td>
            <td class="align-middle">{{ $usuario->dni }}</td>
            <td class="align-middle">{{ $usuario->fecha_nacimiento }}</td>
            <td class="align-middle">{{ $usuario->grado_discapacidad . '%'}}</td>
            <td class="align-middle">{{ $usuario->descripcion }}</td>
            <td class="align-middle">{{ $usuario->esMenor ? 'Sí' : 'No'}}</td>
            <td class="align-middle">{{ $usuario->id_tutor}}</td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('usuarios.show', $usuario->id) }}" type="button"
                        class="btn btn-secondary">Detail</a>
                    <a href="{{ route('usuarios.edit', $usuario->id)}}" type="button" class="btn btn-warning">Edit</a>
                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" type="button"
                        class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger m-0">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="5">No hay Usuarios</td>
        </tr>
        @endif
    </tbody>
</table>
@endsection