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
                <h2 class="mb-3">Bienvenido al Panel de Administración</h2>
                <p class="lead mb-3">Desde aquí podrás gestionar los perfiles y asignaciones esenciales del sistema.</p>

                <p>Las principales funciones de administración son:</p>
                <ul class="text-left mx-auto" style="max-width: 600px;">
                    <li><strong>Gestionar perfiles:</strong> Crear, actualizar, eliminar y visualizar los perfiles de
                        profesionales,
                        tutores y usuarios.</li>
                    <li><strong>Control de acceso:</strong> Solo los tutores y profesionales tienen acceso para iniciar
                        sesión en el
                        sistema.</li>
                    <li><strong>Creación ordenada de usuarios y tutores:</strong>
                        <ul>
                            <li>Primero, crea el perfil del tutor.</li>
                            <li>Luego, al crear un usuario, se debe asignar un tutor existente.</li>
                        </ul>
                    </li>
                    <li><strong>Asignación de profesionales y tutores a usuarios:</strong>
                        Puedes asignar a cada usuario su tutor correspondiente y los profesionales que lo atenderán,
                        considerando el
                        tipo de profesional y si el usuario es menor de edad o no.
                    </li>
                    <li><strong>Relación entre perfiles:</strong> Dentro de los perfiles de usuario y profesional puedes
                        gestionar
                        sus asignaciones mutuas para mantener la correcta vinculación.</li>
                </ul>

                <p class="mt-3">Sigue esta guía para mantener una gestión clara y organizada de los perfiles y sus
                    relaciones en el
                    sistema.</p>
            </div>
        </div>
    </div>
</div>
@endsection