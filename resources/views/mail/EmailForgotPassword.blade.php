<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
</head>

<body>
    <h1>App Salón</h1>
    <h4>Recupera tu contraseña</h4>

    <p>Hola {{ $name }}, has solicitado recuperar tu contraseña en App Salón a continuación presiona el
        siguiente enlace para
        poder recuperarla </p>

    <a href="{{ route('verify-password-reset-token', $token) }}">Recuperar Contraseña</a>

</body>

</html>
