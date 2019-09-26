@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('listaMensajes',$fecha))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Listado de estudiantes a quienes se ha enviado mensajes</div>

                <div class="card-body">
                    @if (count($fecha->mensajes)>0)
                        
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="tableMensaje">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Estudiante</th>
                                    <th scope="col">Tipo de comunicado</th>
                                    <th scope="col">Fecha y hora</th>
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

                   
                </div>
            </div>
        </div>
    </div>
</div>



@prepend('scriptsHeader')
<link rel="stylesheet" type="text/css" href="{{ asset('admin/DataTables/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('admin/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
@endprepend

@push('scriptsFooter')
    <script>
        
        $('#menuPeriodo').addClass('active');
        
        $('#tableMensaje').DataTable({
            "lengthChange": false,
            "paging": false,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });


    </script>
@endpush

@endsection
