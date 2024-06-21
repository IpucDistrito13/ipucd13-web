<!-- resources/views/email/respuesta_solicitud.blade.php -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta solicitud</title>

    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: bold;
        }

        a {
            color: #337ab7;
            text-decoration: none;
        }

        /* Encabezado */
        .header {
            background-color: #fff;
            padding: 20px;
            text-align: center;
        }

        .logo {
            max-width: 200px;
            height: auto;
        }

        /* Contenido */
        .content {
            background-color: #fff;
            padding: 20px;
        }

        .saludo {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .informacion-cuenta {
            margin-bottom: 20px;
        }

        .informacion-cuenta label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .informacion-cuenta span {
            display: block;
        }

        .firma {
            font-size: 16px;
            margin-top: 20px;
        }

        /* Pie de página */
        .footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="https://ipucdistrito13.org/img/logo-colors@2x.png" alt="Logo colors" class="logo">
    </div>

    <div class="content">

        <h4><b>Respuesta solicitud</b></h4>

        <br>

        <p class="saludo">Estimado(a) {{ $solicitud->userSolicitud->nombre }},</p>

        <p>Una solicitud ha sido respondida</p>

        <br>

        <div class="informacion-cuenta">
            <label>Para descargar el archivo, debes iniciar sesión.</label>
            <span><a href="{{ $loginUrl }}">Iniciar sesión</a></span>
        </div>

        <br>

        <p class="firma">Atentamente,</p>
        <p><strong>Iglesia Pentecostal Unida de Colombia - Distrito 13</strong></p>
    </div>

    <div class="footer">
        <p>&copy; {{ $year }} Iglesia Pentecostal Unida de Colombia</p>
    </div>

</body>

</html>
