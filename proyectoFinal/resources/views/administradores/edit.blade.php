@extends('layouts.app')

@section('title', 'Editar Administrador')

@section('contents')
<h1 class="mb-0">Editar Administrador</h1>
<hr />
<form action="{{ route('administradores.update', $administrador->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nombre de Administrador</label>
            <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ $administrador->name }}">
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label class="form-label">Email</label>
            <input class="form-control" name="email" placeholder="Email" value="{{ $administrador->email }}"></input>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="d-grid">
            <button class="btn btn-warning">Update</button>
        </div>
    </div>
</form>
@endsection