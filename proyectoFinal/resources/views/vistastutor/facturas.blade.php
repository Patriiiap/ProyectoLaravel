<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/vistas_tutor_css/facturas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vistas_tutor_css/dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>CareSchedule</title>
</head>

<body>
    <header class="header">
        <div class="user-profile dropdown">
            <a href="#" id="userDropdown" class="dropdown-toggle d-flex align-items-center text-white"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2">{{ Auth::guard('tutor')->user()->nombre }}</span>
                <img src="https://cdn-icons-png.flaticon.com/128/149/149995.png" alt="Icono" class="rounded-circle"
                    width="32" height="32" />
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </div>
        <div>
            <a href="{{ route('vistastutor.dashboard') }}" class="btn btn-light btn-sm">← Volver</a>
        </div>
    </header>

    <div class="dashboard">
        <div class="next-appointment">
            <h2>Generar factura por mes</h2>
            <form action="{{ route('vistastutor.generarFactura') }}" method="POST" class="factura-form">
                @csrf

                <div class="form-group">
                    <label for="usuario">Seleccionar Usuario</label>
                    <select id="usuario" name="usuario" class="form-control" required>
                        <option value="">-- Selecciona un usuario --</option>
                        @foreach(Auth::guard('tutor')->user()->usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="profesional">Seleccionar Profesional</label>
                    <select id="profesional" name="profesional" class="form-control" required>
                        <option value="">-- Selecciona un usuario primero --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="mes">Selecciona el mes:</label>
                    <input type="month" id="mes" name="mes" class="form-control" required />
                </div>

                <button type="submit" class="btn btn-primary">Generar Factura</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
                $('#usuario').on('change', function () {
                    const usuarioId = $(this).val();
                    $('#profesional').empty().append('<option value="">Cargando...</option>');
        
                    if (usuarioId) {
                        $.ajax({
                            url: `/api/usuarios/${usuarioId}/profesionales`,
                            method: 'GET',
                            success: function (data) {
                                $('#profesional').empty().append('<option value="">-- Selecciona un profesional --</option>');
                                data.forEach(function (profesional) {
                                    $('#profesional').append(`<option value="${profesional.id}">${profesional.nombre} ${profesional.apellidos}</option>`);
                                });
                            },
                            error: function () {
                                $('#profesional').empty().append('<option value="">Error al cargar profesionales</option>');
                            }
                        });
                    } else {
                        $('#profesional').empty().append('<option value="">-- Selecciona un usuario primero --</option>');
                    }
                });
            });
    </script>
</body>

</html>