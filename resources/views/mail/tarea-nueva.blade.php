<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Tarea Creada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
        }

        p {
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>¡Nueva Tarea Asignada!</h1>
        <p>Hola,</p>
        <p>Queremos informarte que se ha creado una nueva tarea en el sistema:</p>
        <ul>
            <li><strong>Título:</strong> {{ $titulo }}</li>
            <li><strong>Descripción:</strong> {{ $descripcion }}</li>
            <li><strong>Fecha de entrega:</strong> {{ $fecha_entrega }}</li>
        </ul>
        <p>Por favor, asegúrate de revisarla y completarla a tiempo.</p>
        <a href="{{ $url }}" class="button">Ver Tarea</a>
        <p>Gracias,</p>
        <p>El equipo de {{ config('app.name') }}</p>
        <div class="footer">
            Este es un correo automático, por favor no respondas a este mensaje.
        </div>
    </div>
</body>

</html>
