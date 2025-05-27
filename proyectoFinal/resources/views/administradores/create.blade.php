@extends('layouts.app')

@section('title', 'Crear Administrador')

@section('contents')
<h1 class="mb-0">Añadir Administrador</h1>
<hr />

<form action="{{ route('administradores.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <label for="name">Nombre de Administrador</label>
            <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ old('name') }}">
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="col">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" placeholder="Contraseña">
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="email">Email</label>
            <input class="form-control" name="email" placeholder="Email" value="{{ old('email') }}"></input>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <button type="submit" class="btn btn-primary">Crear</button>
        </div>
    </div>
</form>
@endsection