<?php 
    $profesionalGestionController = new App\Http\Controllers\ProfesionalGestionController();
    $proximaCita = $profesionalGestionController->proximaCita();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CareSchedule Profesional</title>
    <link rel="stylesheet" href="{{ asset('css/vistas_profesional_css/dashboard.css') }}">
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
                <span class="mr-2">{{ Auth::guard('profesional')->user()->nombre }}</span>
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
    </header>

    <main class="dashboard container mt-4">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="acciones">
            <a href="{{ route('vistasprofesional.verFacturas') }}" class="btn btn-primary">Ver Facturas</a>
        </div>

        <section class="next-appointment">
            <h2>Próxima cita
                @if($proximaCita)
                <span class="status">{{ $proximaCita['asistencia_realizada'] }}</span>
                @endif
            </h2>
            @if($proximaCita)
            <ul>
                <li><strong>📅</strong> {{ \Carbon\Carbon::parse($proximaCita['fecha_inicio'])->format('d \d\e F \d\e
                    Y') }}</li>
                <li><strong>⏰</strong> {{ \Carbon\Carbon::parse($proximaCita['fecha_inicio'])->format('H:i') }} - {{
                    \Carbon\Carbon::parse($proximaCita['fecha_fin'])->format('H:i') }}</li>
                <li><strong>👤 Profesional:</strong> {{ $proximaCita['nombre_profesional'] }}</li>
                <li><strong>👤 Usuario:</strong> {{ $proximaCita['nombre_usuario'] }}</li>
            </ul>
            @else
            <p>No tienes próximas citas.</p>
            @endif
        </section>

        <div id="calendar"></div>

        <!-- Tarjeta flotante -->
        <div id="qr-popup" class="card shadow p-2" style="display: none; position: absolute; z-index: 999;">
            <div class="card-body p-2">
                <p id="info-cita" class="mb-2 small text-muted"></p>
                <a id="generarQRBtn" href="#" class="btn btn-primary">Confirmar Cita</a>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="{{ asset('js/calendario_profesional.js') }}"></script>
</body>

</html>