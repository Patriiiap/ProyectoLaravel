@extends('layouts.app')

@section('title', 'Crear Tutor')

@section('contents')
<h1 class="mb-0">Añadir Tutor</h1>
<hr />
<form action="{{ route('tutores.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <label for="username">Nombre de Usuario</label>
            <input type="text" name="username" class="form-control" placeholder="Username"
                value="{{ old('username') }}">
            @if ($errors->has('username'))
            <span class="text-danger">{{ $errors->first('username') }}</span>
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
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ old('nombre') }}">
            @if ($errors->has('nombre'))
            <span class="text-danger">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
        <div class="col">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos"
                value="{{ old('apellidos') }}">
            @if ($errors->has('apellidos'))
            <span class="text-danger">{{ $errors->first('apellidos') }}</span>
            @endif
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="dni">DNI</label>
            <input type="text" name="dni" class="form-control" placeholder="DNI" value="{{ old('dni') }}">
            @if ($errors->has('dni'))
            <span class="text-danger">{{ $errors->first('dni') }}</span>
            @endif
        </div>
        <div class="col">
            <label for="direccion">Dirección</label>
            <input class="form-control" name="direccion" placeholder="Dirección" value="{{ old('direccion') }}"></input>
            @if ($errors->has('direccion'))
            <span class="text-danger">{{ $errors->first('direccion') }}</span>
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
        <div class="col">
            <label for="telefono">Teléfono</label>
            <input class="form-control" name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}"></input>
            @if ($errors->has('telefono'))
            <span class="text-danger">{{ $errors->first('telefono') }}</span>
            @endif
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="cuenta_corriente">Cuenta Corriente</label>
            <input class="form-control" name="cuenta_corriente" placeholder="Cuenta Corriente"
                value="{{ old('cuenta_corriente') }}"></input>
            @if ($errors->has('cuenta_corriente'))
            <span class="text-danger">{{ $errors->first('cuenta_corriente') }}</span>
            @endif
        </div>
        <div class="col">

        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <button type="submit" class="btn btn-primary">Crear</button>
        </div>
    </div>
</form>
@endsection