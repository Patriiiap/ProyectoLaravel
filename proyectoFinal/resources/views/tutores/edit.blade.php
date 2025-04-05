@extends('layouts.app')

@section('title', 'Editar Tutor')

@section('contents')
<h1 class="mb-0">Editar Tutor</h1>
<hr />
<form action="{{ route('tutores.update', $tutor->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nombre de Usuario</label>
            <input type="text" name="username" class="form-control" placeholder="username"
                value="{{ $tutor->username }}">
            @if ($errors->has('username'))
            <span class="text-danger">{{ $errors->first('username') }}</span>
            @endif
        </div>
        <div class="col mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $tutor->nombre }}">
            @if ($errors->has('nombre'))
            <span class="text-danger">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
        <div class="col mb-3">
            <label class="form-label">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos"
                value="{{ $tutor->apellidos }}">
            @if ($errors->has('apellidos'))
            <span class="text-danger">{{ $errors->first('apellidos') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">DNI</label>
            <input type="text" name="dni" class="form-control" placeholder="DNI" value="{{ $tutor->dni }}">
            @if ($errors->has('dni'))
            <span class="text-danger">{{ $errors->first('dni') }}</span>
            @endif
        </div>
        <div class="col mb-3">
            <label class="form-label">Teléfono</label>
            <input class="form-control" name="telefono" placeholder="Teléfono" value="{{ $tutor->telefono }}"></input>
            @if ($errors->has('telefono'))
            <span class="text-danger">{{ $errors->first('telefono') }}</span>
            @endif
        </div>
        <div class="col mb-3">
            <label class="form-label">Parentesco</label>
            <input class="form-control" name="parentesco" placeholder="Parentesco"
                value="{{ $tutor->parentesco }}"></input>
            @if ($errors->has('parentesco'))
            <span class="text-danger">{{ $errors->first('parentesco') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $tutor->email }}">
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="col mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" placeholder="Dirección"
                value="{{ $tutor->direccion }}">
            @if ($errors->has('direccion'))
            <span class="text-danger">{{ $errors->first('direccion') }}</span>
            @endif
        </div>
        <div class="col mb-3">
            <label class="form-label">Cuenta Corriente</label>
            <input class="form-control" name="cuenta_corriente" placeholder="Cuenta Corriente"
                value="{{$tutor->cuenta_corriente }}"></input>
            @if ($errors->has('cuenta_corriente'))
            <span class="text-danger">{{ $errors->first('username') }}</span>
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