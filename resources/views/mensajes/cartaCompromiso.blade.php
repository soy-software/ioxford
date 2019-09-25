<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carta de compromiso</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%
        }
            
        table, th, td {
        border: 1px solid black;
        }
    </style>
</head>
<body>
    <i>Detalle del mensaje:</i>
    <table>
        <thead>
            <tr>
                
                <th scope="col">Estudiante</th>
                <th scope="col">Identificacíon</th>
                <th scope="col">Representante</th>
                <th scope="col">Identificación representante</th>
                <th scope="col">Email representante</th>
                <th scope="col">Celular representante</th>
                <th scope="col">Tipo de comunicado</th>
                <th scope="col">Fecha y hora</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ $msg->estudiante->user->name }}
                </td>
                <td>
                    {{ $msg->estudiante->user->identificacion }}
                </td>
                <td>
                    {{ $msg->estudiante->user->nombres_representante }}
                </td>
                <td>
                    {{ $msg->estudiante->user->identificacion_representante }}
                </td>
                <td>
                    {{ $msg->estudiante->user->email_representante }}
                </td>
                <td>
                    {{ $msg->estudiante->user->celular_representante }}
                </td>
                <td>
                    {{ $msg->tipo }}
                </td>
                <td>
                    {{ $msg->created_at }}
                </td>
            </tr>
        </tbody>
        
    </table>
</body>
</html>