<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Detalles del Código QR</span>
                        <a href="{{ route('qrcodes.index') }}" class="btn btn-secondary btn-sm">Volver</a>
                    </div>

                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">ID:</dt>
                            {{-- <dd class="col-sm-9">{{ $qrCode->id }}</dd> --}}

                            <dt class="col-sm-3">Contenido:</dt>
                            <dd class="col-sm-9">
                                <div class="border p-2 bg-light">
                                    {{-- {{ $qrCode->content }} --}}
                                </div>
                            </dd>
                            <dt class="col-sm-3">Tipo:</dt>
                            {{-- <dd class="col-sm-9">{{ $qrCode->type ?: 'No especificado' }}</dd> --}}

                            <dt class="col-sm-3">Descripción:</dt>
                            {{-- <dd class="col-sm-9">{{ $qrCode->description ?: 'Sin descripción' }}</dd> --}}

                            <dt class="col-sm-3">Escaneado el:</dt>
                            {{-- <dd class="col-sm-9">{{ $qrCode->scanned_at->format('d/m/Y H:i:s') }}</dd> --}}

                            <dt class="col-sm-3">Creado el:</dt>
                            {{-- <dd class="col-sm-9">{{ $qrCode->created_at->format('d/m/Y H:i:s') }}</dd> --}}
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>