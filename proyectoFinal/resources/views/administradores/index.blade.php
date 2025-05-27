@extends('layouts.app')

@section('title', 'Administradores')

@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Listado de Administradores</h1>
    <a href="{{ route('administradores.create') }}" class="btn btn-primary">Añadir Administrador</a>
</div>
<hr />
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif

<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($administradores as $administrador)
        <tr>
            <td class="align-middle">{{ $administrador->id }}</td>
            <td class="align-middle">{{ $administrador->name }}</td>
            <td class="align-middle">{{ $administrador->email }}</td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('administradores.edit', $administrador->id)}}" type="button"
                        class="btn btn-warning">Editar</a>
                    <form action="{{ route('administradores.destroy', $administrador->id) }}" method="POST"
                        type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger m-0">Borrar</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection