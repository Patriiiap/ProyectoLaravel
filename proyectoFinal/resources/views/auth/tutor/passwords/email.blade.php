<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/email.css') }}">
</head>

<body class="bg-gradient-primary d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="reset-card p-4">
        <h1 class="text-center mb-4 h4 text-gray-900">¿Olvidaste tu contraseña?</h1>

        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('tutor.password.email') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="form-control form-control-user" placeholder="Correo electrónico">
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-user">
                Enviar enlace de recuperación
            </button>
        </form>

        <div class="text-center mt-3">
            <a class="small" href="{{ route('login') }}">Volver al login</a>
        </div>
    </div>

</body>

</html>