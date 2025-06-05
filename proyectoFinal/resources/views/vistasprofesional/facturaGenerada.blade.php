<?php
use Carbon\Carbon;

// Cálculo de fechas y días del mes
$diasMes = Carbon::create($anio, $mes)->daysInMonth;
$totalSegundos = 0;
$citasPorDia = $citas->groupBy(function($cita) {
    return Carbon::parse($cita->fecha_inicio)->day;
});

// Función para calcular duración en formato hh:mm:ss (siempre positiva)
function calcularTiempoTotal($segundos) {
    $segundosAbs = abs($segundos);
    $horas = floor($segundosAbs / 3600);
    $minutos = floor(($segundosAbs % 3600) / 60);
    $segundosRestantes = $segundosAbs % 60;
    return sprintf('%d:%02d:%02d', $horas, $minutos, $segundosRestantes);
}

// Horas estándar a realizar (32 horas)
$horasEstandar = 32 * 3600; // 32 horas en segundos

// Variables para resultados finales
$tiempoTotal = '0:00:00';
$desviacionFormato = '0:00:00';

// Valores para desviaciones previas (puedes ajustar o eliminar)
$desviacionAnterior = '##############';
$desviacionTotal = '##################';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>PLANTILLA DE REGISTRO DE HORAS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            line-height: 1.3;
        }

        h1 {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .info-table {
            margin-bottom: 15px;
        }

        .info-table td {
            border: 1px solid #000;
            width: 25%;
            padding: 5px;
        }

        .info-table td:nth-child(odd) {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .hours-table {
            margin-bottom: 15px;
        }

        .footer-table {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .footer-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        .totals {
            font-weight: bold;
            margin: 10px 0;
            text-align: right;
        }

        .signature-table {
            margin-top: 30px;
            border: none;
        }

        .signature-table td {
            border: none;
            padding: 5px;
            text-align: center;
            height: 60px;
            vertical-align: bottom;
        }

        .legal-note {
            font-size: 10px;
            margin: 20px 0;
            font-style: italic;
        }
    </style>
</head>

<body>
    <h1>PLANTILLA DE REGISTRO DE HORAS</h1>

    <!-- Tabla de información -->
    <table class="info-table">
        <tr>
            <td>PACIENTE</td>
            <td>{{ $usuario->nombre }} {{ $usuario->apellidos }}</td>
            <td>DNI</td>
            <td>{{ $usuario->dni ?? '' }}</td>
        </tr>
        <tr>
            <td>TRABAJADORA/PATI</td>
            <td>{{ $profesional->nombre }} {{ $profesional->apellidos }}</td>
            <td>DNI</td>
            <td>{{ $profesional->dni ?? '' }}</td>
        </tr>
        <tr>
            <td>FAMILIA</td>
            <td>{{ $usuario->tutor->nombre }} {{ $usuario->tutor->apellidos }}</td>
            <td>DNI</td>
            <td>{{ $usuario->tutor->dni ?? '' }}</td>
        </tr>
        <tr>
            <td>MES</td>
            <td colspan="3">{{ $mes . "/" . $anio }}</td>
        </tr>
    </table>

    <!-- Tabla de registro de horas -->
    <table class="hours-table">
        <thead>
            <tr>
                <th>DÍA</th>
                <th>HORA ENTRADA</th>
                <th>HORA SALIDA</th>
                <th>TOTAL</th>
                <th>FIRMA TRABAJADORA</th>
            </tr>
        </thead>
        <tbody>
            @for ($dia = 1; $dia <= $diasMes; $dia++) @php $entrada='' ; $salida='' ; $duracion='0:00:00' ; if
                ($citasPorDia->has($dia)) {
                $citasDelDia = $citasPorDia[$dia];
                $segundosDia = 0;

                $primeraEntrada = null;
                $ultimaSalida = null;

                foreach ($citasDelDia as $cita) {
                $inicioTime = Carbon::parse($cita->fecha_inicio);
                $finTime = Carbon::parse($cita->fecha_fin);

                if ($primeraEntrada === null || $inicioTime->lt($primeraEntrada)) {
                $primeraEntrada = $inicioTime;
                }
                if ($ultimaSalida === null || $finTime->gt($ultimaSalida)) {
                $ultimaSalida = $finTime;
                }

                $segundosCita = $finTime->diffInSeconds($inicioTime);
                $segundosDia += $segundosCita;
                }

                $entrada = $primeraEntrada->format('H:i:s');
                $salida = $ultimaSalida->format('H:i:s');
                $duracion = calcularTiempoTotal($segundosDia);
                $totalSegundos += $segundosDia;
                }
                @endphp
                <tr>
                    <td>{{ $dia }}</td>
                    <td>{{ $entrada }}</td>
                    <td>{{ $salida }}</td>
                    <td>{{ $duracion }}</td>
                    <td></td>
                </tr>
                @endfor
        </tbody>
    </table>

    @php
    // Calcular totales y desviaciones después del bucle
    $tiempoTotal = calcularTiempoTotal($totalSegundos);
    $desviacionSegundos = $totalSegundos - $horasEstandar;
    $signo = $desviacionSegundos >= 0 ? '+' : '-';
    $desviacionAbs = abs($desviacionSegundos);
    $desviacionFormato = $signo . calcularTiempoTotal($desviacionAbs);
    @endphp

    <div class="totals">
        HORAS TOTALES MENSUALES: {{ $tiempoTotal }}
    </div>

    <!-- Nota legal -->
    <p class="legal-note">
        * En cumplimiento de la obligación establecida en el Art. 12.4 c) del Real Decreto Legislativo 2/2015 de 23 de
        Octubre, por el que se aprueba el texto refundido del la Ley del Estatuto de los Trabajadores
    </p>

    <!-- Tabla de firmas -->
    <table class="signature-table">
        <tr>
            <td width="40%"><strong>FIRMA TRABAJADORA</strong></td>
            <td width="20%"></td>
            <td width="40%"><strong>FIRMA EMPRESA</strong></td>
        </tr>
    </table>
</body>

</html>