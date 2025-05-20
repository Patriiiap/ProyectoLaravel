<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<meta http-equiv="Permissions-Policy" content="camera=(self), microphone=(self)">-->
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuración del escáner
            const config = {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                },
                preferredCamera: "environment"
            };
            
            // Inicializar el escáner
            const html5QrCode = new Html5Qrcode("reader");
            
            // ID de la cita que estamos verificando (si viene de una cita específica)
            const citaIdActual = document.getElementById('cita_id_actual').value;
            
            // Estado de la cámara
            const cameraStatusEl = document.getElementById('camera-status');
            
            // Función para manejar cuando se escanea un QR exitosamente
            function onScanSuccess(decodedText, decodedResult) {
                // Mostrar el resultado
                const resultDiv = document.getElementById('result');
                resultDiv.classList.remove('d-none');
                
                const resultText = document.getElementById('resultText');
                resultText.innerText = "QR escaneado, verificando...";
                
                // Detener el escáner
                html5QrCode.stop().then(() => {
                    console.log("Escáner detenido");
                    
                    try {
                        // Interpretar el contenido del QR (que debería ser JSON)
                        const qrData = JSON.parse(decodedText);

                        console.log("Informacion en el decoded text:");
                        console.log(decodedText);
                        
                        // Verificar que el QR contiene los datos necesarios
                        if (!qrData.cita_id || !qrData.profesional_id || !qrData.token) {
                            mostrarError("El código QR no contiene información válida de una cita.");
                            return;
                        }
                        
                        // Si venimos de una cita específica, verificar que coincide
                        if (citaIdActual && qrData.cita_id != citaIdActual) {
                            mostrarError("Este QR no corresponde a la cita seleccionada.");
                            return;
                        }
                        
                        // Enviar datos al servidor para verificación y confirmación
                        confirmarCita(qrData);
                        
                    } catch (e) {
                        console.error("Error al procesar el QR", e);
                        mostrarError("El código QR escaneado no tiene un formato válido.");
                    }
                }).catch(err => {
                    console.error("Error al detener el escáner", err);
                });
            }
            
            // Función para manejar errores de escaneo
            function onScanError(error) {
                console.warn(`Error al escanear: ${error}`);
            }
            
            // Función para mostrar errores
            function mostrarError(mensaje) {
                document.getElementById('error-container').classList.remove('d-none');
                document.getElementById('errorText').innerText = mensaje;
                document.getElementById('result').classList.add('d-none');
            }
            
            // Función para confirmar la cita con el servidor
            function confirmarCita(qrData) {
                // Usar Fetch API para enviar los datos al servidor
                fetch('{{ route("citas.confirmar") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(qrData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Redirigir a la página de confirmación
                        window.location.href = data.redirect_url;
                    } else {
                        // Mostrar mensaje de error
                        mostrarError(data.message || "Error al confirmar la cita");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    mostrarError("Ha ocurrido un error al procesar la solicitud");
                });
            }
            
            // Comprobar si el navegador soporta MediaDevices
            async function verificarCamaras() {
                if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices) {
                    cameraStatusEl.innerText = "Tu navegador no soporta acceso a la cámara";
                    cameraStatusEl.className = "alert alert-danger mb-3 text-center";
                    return false;
                }
                
                try {
                    const devices = await navigator.mediaDevices.enumerateDevices();
                    const videoDevices = devices.filter(device => device.kind === 'videoinput');
                    
                    if (videoDevices.length === 0) {
                        cameraStatusEl.innerText = "No se detectó ninguna cámara en este dispositivo";
                        cameraStatusEl.className = "alert alert-warning mb-3 text-center";
                        return false;
                    }
                    
                    return true;
                } catch (error) {
                    console.error("Error al enumerar dispositivos:", error);
                    cameraStatusEl.innerText = "Error al detectar cámaras: " + error.message;
                    cameraStatusEl.className = "alert alert-danger mb-3 text-center";
                    return false;
                }
            }
            
            // Iniciar el escáner con la cámara al hacer clic en el botón
            document.getElementById('startButton').addEventListener('click', async function() {
                // Verificar primero si hay cámaras
                const hayCamaras = await verificarCamaras();
                if (!hayCamaras) {
                    return;
                }
                
                cameraStatusEl.innerText = "Solicitando acceso a la cámara...";
                
                // Primero solicitamos explícitamente el permiso
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                    // Si llegamos aquí, es que tenemos acceso a la cámara
                    stream.getTracks().forEach(track => track.stop()); // Cerramos este stream ya que el scanner abrirá uno nuevo
                    
                    cameraStatusEl.innerText = "Cámara activada. Apunte al código QR.";
                    cameraStatusEl.className = "alert alert-success mb-3 text-center";
                    
                    // Ocultar el botón
                    document.getElementById('startButton').style.display = 'none';
                    
                    // Iniciar el escáner con la cámara
                    html5QrCode.start(
                        { facingMode: "environment" }, // Usar cámara trasera
                        config,
                        onScanSuccess,
                        onScanError
                    ).catch(err => {
                        console.error("Error al iniciar el escáner", err);
                        cameraStatusEl.innerText = "Error al iniciar la cámara: " + err.message;
                        cameraStatusEl.className = "alert alert-danger mb-3 text-center";
                        document.getElementById('startButton').style.display = 'inline-block';
                    });
                    
                } catch (error) {
                    console.error("Error al solicitar acceso a la cámara:", error);
                    cameraStatusEl.innerText = "Permiso de cámara denegado o no disponible: " + error.message;
                    cameraStatusEl.className = "alert alert-danger mb-3 text-center";
                }
            });
            
            // Verificar cámaras al cargar la página
            verificarCamaras();
        });
    </script>
</body>

</html>