@extends('layouts.app')

@section('title', 'Profesionales')

@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Listado de Profesionales</h1>
    <a href="{{ route('profesionales.create') }}" class="btn btn-primary">Añadir Profesional</a>
</div>
<hr />
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif


<form method="GET" action="{{ route('profesionales') }}" class="mb-3">
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
            <th>Teléfono</th>
            <th>Es PATI</th>
            <th>Es PAP</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($profesionales->count() > 0)
        @foreach($profesionales as $profesional)
        <tr>
            <td class="align-middle">{{ $profesional->id }}</td>
            <td class="align-middle">{{ $profesional->username }}</td>
            <td class="align-middle">{{ $profesional->nombre . " " . $profesional->apellidos}}</td>
            <td class="align-middle">{{ $profesional->email }}</td>
            <td class="align-middle">{{ $profesional->telefono }}</td>
            <td class="align-middle">{{ $profesional->esPati ? 'Sí' : 'No'}}</td>
            <td class="align-middle">{{ $profesional->esPap ? 'Sí' : 'No'}}</td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('profesionales.show', $profesional->id) }}" type="button"
                        class="btn btn-secondary">Perfil</a>
                    <a href="{{ route('profesionales.edit', $profesional->id)}}" type="button"
                        class="btn btn-warning">Editar</a>
                    <form action="{{ route('profesionales.destroy', $profesional->id) }}" method="POST" type="button"
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
            <td class="text-center" colspan="5">No hay Profesionales</td>
        </tr>
        @endif
    </tbody>
</table>
@endsection