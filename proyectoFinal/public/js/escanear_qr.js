document.addEventListener('DOMContentLoaded', function () {
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
    document.getElementById('startButton').addEventListener('click', async function () {
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