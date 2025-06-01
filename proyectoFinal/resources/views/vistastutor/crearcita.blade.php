<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Tutor</title>
    <link rel="stylesheet" href="{{ asset('css/vistas_tutor_css/crearcita.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vistas_tutor_css/dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
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

    <main class="dashboard">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="container mt-2">
            <div class="card shadow-lg rounded-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Crear Nueva Cita</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('vistastutor.storeCita') }}">
                        @csrf

                        <div class="form-group">
                            <label for="usuario">Seleccionar Usuario</label>
                            <select id="usuario" name="usuario" class="form-control" required>
                                <option value="">-- Selecciona un usuario --</option>
                                @foreach(Auth::guard('tutor')->user()->usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="profesional">Seleccionar Profesional</label>
                                <select id="profesional" name="profesional" class="form-control" required>
                                    <option value="">-- Selecciona un usuario primero --</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="hora_inicio">Hora de Inicio</label>
                                <input type="time" id="hora_inicio" name="hora_inicio" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hora_fin">Hora de Fin</label>
                                <input type="time" id="hora_fin" name="hora_fin" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="detalles">Detalles de la cita</label>
                            <textarea id="detalles" name="detalles" class="form-control" rows="3"
                                placeholder="Describe brevemente el objetivo o contenido de la cita..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="recurrente">Cita Recurrente Semanalmente</label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="recurrente" name="recurrente"
                                    value="1">
                                <label class="custom-control-label" for="recurrente">Marcar si la cita es recurrente
                                    semanalmente</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Guardar Cita</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="calendar">

        </div>

        <!-- Tarjeta flotante -->
        <div id="info-cita-popup" class="card shadow p-2" style="display: none; position: absolute; z-index: 999;">
            <div class="card-body p-2">
                <p id="info-cita" class="mb-2 small text-muted"></p>
                <a id="generarQRBtn" href="#" class="btn btn-primary btn-sm mb-1">Confirmar Cita</a>
                <a id="eliminarCitaBtn" href="#" class="btn btn-danger btn-sm mb-1">Eliminar Cita</a>
            </div>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/tutor_crear_cita.js') }}"></script>
    <script src="{{ asset('js/calendario_tutor.js') }}"></script>
</body>

</html>