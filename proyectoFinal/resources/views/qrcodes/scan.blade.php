<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<meta http-equiv="Permissions-Policy" content="camera=(self), microphone=(self)">-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/vistas_qr_css/scan.css') }}">
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

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Confirmar Cita #{{ $cita->id }}</h2>
            </div>
            <div class="card-body text-center">
                <div class="mb-4">
                    <h3>Detalles de la Cita</h3>
                    <p><strong>Fecha:</strong> {{ $cita->fecha_inicio }}</p>
                    <p><strong>Hora:</strong> {{ $cita->fecha_fin }}</p>
                    <p><strong>Profesional:</strong> {{ $cita->profesional->nombre ?? 'N/A' }}</p>
                    <p><strong>Usuario:</strong> {{ $cita->usuario->nombre ?? 'N/A' }}</p>
                    <p><strong>Estado:
                            @if($cita->asistencia_realizada === 'realizada')
                            <span style="color: green;">Realizada</span>
                            @else
                            <span style="color: red;">Pendiente</span>
                            @endif
                        </strong></p>
                </div>

                <div>
                    <a href="{{ route('citas.confirmar.boton.tutor', $cita->id) }}" class="btn btn-primary">Confirmar
                        Cita</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Escanear Código QR de Cita</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="text-center mb-4">
                            <p class="lead">Apunte la cámara al código QR para confirmar la asistencia</p>
                        </div>

                        <!-- Si hay un ID de cita en la URL, lo almacenamos para validación -->
                        <input type="hidden" id="cita_id_actual" value="{{ $cita->id ?? '' }}">

                        <!-- Botón para iniciar cámara explícitamente -->
                        <div class="text-center mb-3">
                            <button id="startButton" class="btn btn-primary">Iniciar Cámara</button>
                        </div>

                        <!-- Estado de permisos -->
                        <div id="camera-status" class="alert alert-info mb-3 text-center">
                            Haga clic en "Iniciar Cámara" y permita el acceso cuando se solicite
                        </div>

                        <div id="reader" class="mx-auto" style="width:100%; max-width:500px;"></div>

                        <div id="result" class="mt-4 d-none">
                            <div class="alert alert-info">
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border text-primary me-2" role="status">
                                        <span class="visually-hidden">Procesando...</span>
                                    </div>
                                    <span id="resultText">Verificando QR...</span>
                                </div>
                            </div>
                        </div>

                        <!-- Contenedor para mostrar errores -->
                        <div id="error-container" class="mt-4 d-none">
                            <div class="alert alert-danger">
                                <span id="errorText"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script src="{{ asset('js/escanear_qr.js') }}"></script>
</body>

</html>