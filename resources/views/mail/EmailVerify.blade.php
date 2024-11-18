<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>App Salón</h1>
    <h4>Verifica tu cuenta</h4>

    <p>Hola {{ $name }}, has creado una cuenta en App Salón a countinuación presiona el siguiente enlace para
        verificar tu cuenta y puedas empezar a usar la aplicación </p>

    <a href="{{ url('verify', $token) }}">Verificar Cuenta</a>

</body>

</html>
