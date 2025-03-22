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
<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>DNI</th>
            <th>Teléfono</th>
            <th>Prentesco</th>
            <th>Cuenta Corriente</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>+
        @if($tutores->count() > 0)
        @foreach($tutores as $tutor)
        <tr>
            <td class="align-middle">{{ $tutor->id }}</td>
            <td class="align-middle">{{ $tutor->username }}</td>
            <td class="align-middle">{{ $tutor->nombre }}</td>
            <td class="align-middle">{{ $tutor->apellidos }}</td>
            <td class="align-middle">{{ $tutor->direccion }}</td>
            <td class="align-middle">{{ $tutor->dni }}</td>
            <td class="align-middle">{{ $tutor->telefono }}</td>
            <td class="align-middle">{{ $tutor->parentesco }}</td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('tutores.show', $tutor->id) }}" type="button" class="btn btn-secondary">Detail</a>
                    <a href="{{ route('tutores.edit', $tutor->id)}}" type="button" class="btn btn-warning">Edit</a>
                    <form action="{{ route('tutores.destroy', $tutor->id) }}" method="POST" type="button"
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
            <td class="text-center" colspan="5">No hay Tutores</td>
        </tr>
        @endif
    </tbody>
</table>
@endsection