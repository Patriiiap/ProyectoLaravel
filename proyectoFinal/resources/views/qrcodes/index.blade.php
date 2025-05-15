<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CareSchedule</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Códigos QR Escaneados</span>
                        <a href="{{ route('qrcodes.create') }}" class="btn btn-primary btn-sm">Escanear Nuevo</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Contenido</th>
                                    <th>Tipo</th>
                                    <th>Escaneado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @forelse ($qrCodes as $qrCode)
                                <tr>
                                    <td>{{ $qrCode->id }}</td>
                                    <td>{{ Str::limit($qrCode->content, 30) }}</td>
                                    <td>{{ $qrCode->type }}</td>
                                    <td>{{ $qrCode->scanned_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('qrcodes.show', $qrCode) }}"
                                            class="btn btn-info btn-sm">Ver</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay códigos QR escaneados</td>
                                </tr>
                                @endforelse --}}
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {{-- {{ $qrCodes->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>