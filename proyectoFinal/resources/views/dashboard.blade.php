@extends('layouts.app')

@section('contents')
<div class="row justify-content-center">
    <!-- Tarjeta de bienvenida -->
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="card shadow-lg border-0">
            <div class="card-header text-center">
                <h4 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-calendar-check"></i> ¡Bienvenido a CareScheduler!
                </h4>
            </div>
            <div class="card-body text-center">
                <p class="lead">¡Estamos encantados de que estés aquí!</p>
                <p>Desde este panel podrás gestionar todas las citas y profesionales de CareScheduler, asegurando un
                    servicio accesible y eficiente para las personas con discapacidad y sus tutores.</p>
                <p>Explora nuestras opciones y aprovecha todas las herramientas disponibles.</p>
            </div>
        </div>
    </div>
</div>
@endsection