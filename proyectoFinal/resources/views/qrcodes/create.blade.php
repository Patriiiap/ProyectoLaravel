<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/vistas_qr_css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vistas_profesional_css/dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
    <title>CareSchedule</title>
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

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>QR de Cita #{{ $cita->id }}</h2>
            </div>
            <div class="card-body text-center">
                <div class="mb-4">
                    <h3>Detalles de la Cita</h3>
                    <p><strong>Fecha:</strong> {{ $cita->fecha_inicio }}</p>
                    <p><strong>Hora:</strong> {{ $cita->fecha_fin }}</p>
                    <p><strong>Profesional:</strong> {{ $cita->profesional->nombre ?? 'N/A' }}</p>
                    <p><strong>Usuario:</strong> {{ $cita->usuario->nombre ?? 'N/A' }}</p>
                </div>

                <div class="qr-container mb-3">
                    {!! QrCode::size(250)->generate($qrContent) !!}
                </div>

                <div class="mt-4">
                    <button class="btn btn-primary" onclick="window.print()">Imprimir QR</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>