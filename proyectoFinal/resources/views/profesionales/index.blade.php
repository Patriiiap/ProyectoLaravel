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
            <td class="align-middle">{{ $profesional->nombre }}</td>
            <td class="align-middle">{{ $profesional->apellidos }}</td>
            <td class="align-middle">{{ $profesional->direccion }}</td>
            <td class="align-middle">{{ $profesional->dni }}</td>
            <td class="align-middle">{{ $profesional->telefono }}</td>
            <td class="align-middle">{{ $profesional->esPati ? 'Sí' : 'No'}}</td>
            <td class="align-middle">{{ $profesional->esPap ? 'Sí' : 'No'}}</td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('profesionales.show', $profesional->id) }}" type="button"
                        class="btn btn-secondary">Detail</a>
                    <a href="{{ route('profesionales.edit', $profesional->id)}}" type="button"
                        class="btn btn-warning">Edit</a>
                    <form action="{{ route('profesionales.destroy', $profesional->id) }}" method="POST" type="button"
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
            <td class="text-center" colspan="5">No hay Profesionales</td>
        </tr>
        @endif
    </tbody>
</table>
@endsection