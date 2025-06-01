<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/email.css') }}">
</head>

<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-11 col-lg-9 mx-auto">

                <h1 class=" text-center mb-4">Restablecer Contraseña</h1>

                @if (session('status'))
                <p class="text-success text-center fw-semibold">{{ session('status') }}</p>
                @endif

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <form method="POST" action="{{ route('admin.password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Correo electrónico:</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $email) }}" required
                            class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Nueva contraseña:</label>
                        <input type="password" name="password" id="password" required class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirmar contraseña:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="form-control" />
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold">Restablecer Contraseña</button>
                </form>

            </div>
        </div>
    </div>

</body>

</html>