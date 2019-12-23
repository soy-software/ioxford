<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTE DE MENSAJES</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%
        }
            
        table, th, td {
        border: 1px solid black;
        }
        .noBorder {
            border:none !important;
        }
    </style>
</head>
<body>

        <table style="border-collapse: collapse; border: none;">
            <td class="noBorder">
                <img src="{!! public_path('img/logo.png') !!}" alt="" width="120px;" style="text-align: right;">
                    {{--  <img src="{!! public_path('img/oxford.png') !!}" alt="" width="120px;" style="text-align: left;">  --}}
            </td>
            <td class="noBorder">
                <h4 style="text-align: center;">
                    UNIDAD EDUCATIVA OXFORD <br>
                    DEPARTAMENTO DE CONSEJERÍA ESTUDIANTIL
                </h4>
            </td>
            <td class="noBorder">
                
                <img src="{!! public_path('img/ministerio.jpg') !!}" alt="" width="120px;" style="text-align: right;">
            </td>
        </table>
        <h3 style="text-align: center">LISTADO DE MENSAJES</h3>
        <p style="text-align: right">
            Salcedo {{ Carbon\Carbon::now() }}
        </p>
        @if (count($fecha->mensajes)>0)
                        
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="tableMensaje">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Estudiante</th>
                        <th scope="col">Tipo de comunicado</th>
                        <th scope="col">Fecha y hora</th>
                        <th scope="col">Enviado por</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=0)
                    @foreach ($fecha->mensajes as $msg)
                    @php($i++)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>
                            {{ $msg->estudiante->user->name }}
                        </td>
                        <td>
                            {{ $msg->tipo }}
                        </td>
                        <td>
                            {{ $msg->created_at }}
                        </td>
                        <td>
                            {{ $msg->enviadoX->email }}
                        </td>
                        
                    </tr>
                    @endforeach



                </tbody>
            </table>
        </div>
        
        @else
            <div class="alert alert-primary" role="alert">
                <strong>No existe mensajes</strong>
            </div>
        @endif
</body>
</html>