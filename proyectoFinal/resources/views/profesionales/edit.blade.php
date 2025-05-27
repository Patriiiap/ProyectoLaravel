@extends('layouts.app')

@section('title', 'Editar Profesional')

@section('contents')
<h1 class="mb-0">Editar Profesional</h1>
<hr />
<form action="{{ route('profesionales.update', $profesional->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nombre de Usuario</label>
            <input type="text" name="username" class="form-control" placeholder="username"
                value="{{ $profesional->username }}">
            @if ($errors->has('username'))
            <span class="text-danger">{{ $errors->first('username') }}</span>
            @endif
        </div>
        <div class="col mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre"
                value="{{ $profesional->nombre }}">
            @if ($errors->has('nombre'))
            <span class="text-danger">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
        <div class="col mb-3">
            <label class="form-label">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos"
                value="{{ $profesional->apellidos }}">
            @if ($errors->has('apellidos'))
            <span class="text-danger">{{ $errors->first('apellidos') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">DNI</label>
            <input type="text" name="dni" class="form-control" placeholder="DNI" value="{{ $profesional->dni }}">
            @if ($errors->has('dni'))
            <span class="text-danger">{{ $errors->first('dni') }}</span>
            @endif
        </div>
        <div class="col mb-3">
            <label class="form-label">Dirección</label>
            <input class="form-control" name="direccion" placeholder="Dirección"
                value="{{ $profesional->direccion }}"></input>
            @if ($errors->has('direccion'))
            <span class="text-danger">{{ $errors->first('direccion') }}</span>
            @endif
        </div>
        <div class="col mb-3">
            <label class="form-label">Teléfono</label>
            <input class="form-control" name="telefono" placeholder="Teléfono"
                value="{{ $profesional->telefono }}"></input>
            @if ($errors->has('telefono'))
            <span class="text-danger">{{ $errors->first('telefono') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label class="form-label">Email</label>
            <input class="form-control" name="email" placeholder="Email" value="{{ $profesional->email }}"></input>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="col">
            <label>Tipo de Profesional</label>
            <div class="col">
                <input class="form-checkbox-input" type="checkbox" name="esPati" id="esPati" {{$profesional->esPati
                ?
                'checked' : ''}}>
                <label for="esPati">Es PATI</label>
            </div>
            <div class="col">
                <input class="form-checkbox-input" type="checkbox" name="esPap" id="esPap" {{$profesional->esPap ?
                'checked'
                : ''}}>
                <label for="esPap">Es PAP</label>
            </div>
            @if ($errors->has('tipoProfesional'))
            <span class="text-danger">{{ $errors->first('tipoProfesional') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="d-grid">
            <button class="btn btn-warning">Actualizar</button>
        </div>
    </div>
</form>
@endsection