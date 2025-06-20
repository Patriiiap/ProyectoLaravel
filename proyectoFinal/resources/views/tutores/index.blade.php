@extends('layouts.app')

@section('title', 'Tutores')

@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Listado de Tutores</h1>
    <a href="{{ route('tutores.create') }}" class="btn btn-primary">Añadir Tutor</a>
</div>
<hr />
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif

<form method="GET" action="{{ route('tutores') }}" class="mb-3">
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
            <th>Username</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>DNI</th>
            <th>Teléfono</th>
            <th>Usuarios</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($tutores->count() > 0)
        @foreach($tutores as $tutor)
        <tr>
            <td class="align-middle">{{ $tutor->id }}</td>
            <td class="align-middle">{{ $tutor->username }}</td>
            <td class="align-middle">{{ $tutor->nombre . " " . $tutor->apellidos}}</td>
            <td class="align-middle">{{ $tutor->email }}</td>
            <td class="align-middle">{{ $tutor->dni }}</td>
            <td class="align-middle">{{ $tutor->telefono }}</td>
            <td class="align-middle">
                <ul>
                    @foreach($tutor->usuarios as $usuario)
                    <li><a href="{{ route('usuarios.show', $usuario->id) }}">{{ $usuario->nombre . " " .
                            $usuario->apellidos}}</a></li>
                    @endforeach
                </ul>
            </td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('tutores.show', $tutor->id) }}" type="button" class="btn btn-secondary">Perfil</a>
                    <a href="{{ route('tutores.edit', $tutor->id)}}" type="button" class="btn btn-warning">Editar</a>
                    <form action="{{ route('tutores.destroy', $tutor->id) }}" method="POST" type="button"
                        class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger m-0">Borrar</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="5">No hay Tutores</td>
        </tr>
        @endif
    </tbody>
</table>
@endsection