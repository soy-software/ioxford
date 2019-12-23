<!DOCTYPE html>
<html lang="en">
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
        .noBorder {
            border:none !important;
        }
    </style>
</head>
<body>

        <table style="border-collapse: collapse; border: none;">
            <td class="noBorder">
                    <img src="{!! public_path('img/logo.png') !!}" alt="" width="120px;" style="text-align: right;">
            </td>
            <td class="noBorder">
                <h4 style="text-align: center;">
                    UNIDAD EDUCATIVA SAN FRANCISCO DE ASÍS <br>
                    DEPARTAMENTO DE CONSEJERÍA ESTUDIANTIL <br>
                    {{ $estudiante->paralelo->cursoPeriodo->periodo->fecha_inicio }} - {{ $estudiante->paralelo->cursoPeriodo->periodo->fecha_final }}
                </h4>
            </td>
            <td class="noBorder">
                
                <img src="{!! public_path('img/ministerio.jpg') !!}" alt="" width="120px;" style="text-align: right;">
            </td>
        </table>
        <h3 style="text-align: center">PROCESO DE MEJORA CONTINUA</h3>
        <p style="text-align: right">
            Salcedo {{ Carbon\Carbon::now() }} <br>
           Curso: <strong>{{ $estudiante->paralelo->cursoPeriodo->curso->nombre }}</strong>, Paralelo: <strong>{{ $estudiante->paralelo->nombre }}</strong>
            
        </p>
        <h2 style="text-align: center"><strong>CARTA DE COMPROMISO</strong></h2>
        <h3><strong>DIMENSIÓN A: </strong> ACOMPAÑAMIENTO INTEGRAL</h3>
        <table>
            <tr>
                <th>
                    ESTANDAR A.2
                </th>
                <td>
                    A.2  El funcionario del DECE retroalimenta e informa acerca de los procesos de aprendizaje de los estudiantes.
                </td>
            </tr>
            <tr>
                <th>
                    PARA:
                </th>
                <th>
                    DECE
                </th>
            </tr>
            <tr>
                <th>
                    DE: 
                </th>
                <th>
                    VICERRECTORADO 
                </th>
            </tr>
            <tr>
                <th>
                    PROCEDIMIENTO: A.2.3
                </th>
                <td>
                    Informa a los padres de familia o representantes legales, docentes y directivos de manera oportuna y periódica acerca del progreso y los resultados educativos y de intervención de los estudiantes previamente remitidos.
                </td>
            </tr>
        </table>
        <h3><strong>BASE LEGAL:</strong></h3>
        <p style="text-align: justify">
            Capítulo IV de las acciones de evaluación, retroalimentación y refuerzo académico <strong>Art. 207.- Reuniones con los representantes legales de los estudiantes.</strong> El docente debe convocar a los representantes legales de los estudiantes a por lo menos dos (2) reuniones al año para determinar estrategias conjuntas, a fin de promover el mejoramiento académico de sus representados. Se debe dejar constancia escrita de las recomendaciones y sugerencias que se formulen para el mejoramiento académico.
        </p>
        
        @if (count($mensajes)>0)
        <p>Listado de notificaciones</p>
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="tableMensaje">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo de comunicado</th>
                        <th scope="col">Fecha y hora</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=0)
                    @foreach ($mensajes as $msg)
                    @php($i++)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                       
                        <td>
                            {{ $msg->tipo }}
                        </td>
                        <td>
                            {{ $msg->created_at }}
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
        <br><br>
    
        <table style="border-collapse: collapse; border: none;">
            
            <tr>
                <td class="noBorder" style="text-align: center;">
                    <p>
                        ............................. <br>
                        N: <strong>{{ $estudiante->user->nombres_representante }}</strong> <br>
                        C.I: <strong>{{ $estudiante->user->identificacion_representante }}</strong> <br>
                        <strong>REPRESENTANTE</strong>
                    </p>

                </td>
                <td class="noBorder" style="text-align: center;">
                    <p>
                        ............................. <br>
                        N: <strong>{{ $estudiante->user->name }}</strong> <br>
                        C.I: <strong>{{ $estudiante->user->identificacion }}</strong> <br>
                        <strong>ALUMNO</strong>
                    </p>

                </td>
            </tr>

            <tr>
                <td class="noBorder" colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class="noBorder" style="text-align: center;">
                    <p>
                        Dr: Juan Paredes<br>
                        <strong>Vicerrector</strong>
                    </p>

                </td>
                <td class="noBorder" style="text-align: center;">
                    <p>
                        Psic: Cristina Vivas<br>
                        <strong>DECE</strong>
                    </p>
                </td>
            </tr>


        </table>
</body>
</html>