@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('estudiantes',$paralelo))

@section('content')
<div class="container-fluid">
  <div class="card">
      <div class="card-header">
            <a class="float-right" href="{{ route('importarEstudianteExcel',$paralelo->id) }}" data-toggle="tooltip" data-placement="top" title="Importar estudiante desde excel">
                <i class="far fa-file-excel"></i> Importar estudiante
            </a>
            <a class="float-right mr-3" href="{{ route('nuevoEstudiante',$paralelo->id) }}" data-toggle="tooltip" data-placement="top" title="Nuevo estudiante" >
                <i class="fas fa-plus"></i> Nuevo estudiante
            </a>
            Listado de estudiantes
      </div>
      <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="{{ route('enviarMensaje') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    @if(count($paralelo->estudiantes)>0)
                                    <table class="table table-bordered table-sm" id="estudiante">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Identificación</th>
                                                <th scope="col"># Representante</th>
                                                <th scope="col">email</th>
                                                <th scope="col">
                                                    Acciones
                                                </th>
                                                <th scope="col" class="@error('estudiante') text-danger @enderror"><strong>Selecionar</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php($i=0)
                                        @foreach ($paralelo->estudiantes as $est)
                                        @php($i++)
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <td>{{ $est->name }}</td>
                                                <td>{{ $est->identificacion }}</td>
                                                <td>{{ $est->celular_representante }}</td>
                                                <td>{{ $est->email_representante }}</td>
                                                <td>
                                                    
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                        
                                                        <a href="{{ route('editarEstudiante',$est->estudiante->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-unique" data-url="{{ route('retirarEstudiante',$est->estudiante->id) }}" onclick="eliminar(this);" data-toggle="tooltip" data-placement="top" title="Quitar de paralelo">
                                                            <i class="fas fa-user-minus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    
                                                    <input type="checkbox" name="estudiante[{{ $est->estudiante->id }}]" value="{{ $est->estudiante->id }}" {{ old('estudiante.'.$est->estudiante->id)==$est->estudiante->id ?'checked':'' }}>

                                                </td>
                                                
                                            </tr> 
                                        
                                        @endforeach
                                            
                                        
                                        </tbody>
                                    </table>
                                    @else
                                    <div class="alert alert-primary" role="alert">
                                        <strong>Sin estudiantes</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                    
                                <div class="card card-body mb-2">
                                    <p class="mb-1"><strong>Detalle de mensaje</strong></p>
                                    <textarea disabled name="texto" rows="3" class="form-control" maxlength="140">Sr, Representante el estudiante VILMER DAVID CRIOLLO CHAN. Ha incurrido una falta en: Bajo rendimiento, por favor acercarse al DECE-OXFORD</textarea>
                                </div>
                                <div class="card card-body mb-2">
                                    <p class="mb-1"><strong>Seleccione plataforma</strong></p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="PLATAFORMA1" checked disabled >
                                        <label class="form-check-label" for="PLATAFORMA1">
                                            Mensaje de texto
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  id="PLATAFORMA2" checked disabled>
                                        <label class="form-check-label" for="PLATAFORMA2">
                                            Correo eléctronico
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="PLATAFORMA3" disabled>
                                        <label class="form-check-label" for="PLATAFORMA3">
                                            Whatsapp
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="PLATAFORMA4" disabled>
                                        <label class="form-check-label" for="PLATAFORMA1">
                                            Messenger
                                        </label>
                                    </div>
                                    
                                </div>
                                <div class="card card-body mb-2">
                                    <p class="mb-1"><strong class="@error('tipoMensaje') text-danger @enderror">Seleccione tipo de comunicado</strong></p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="tipoMensaje[0]" value="Bajo rendimiento" id="TIPO1" {{ old('tipoMensaje.0')=='Bajo rendimiento'?'checked':'' }} >
                                        <label class="form-check-label" for="TIPO1">
                                            Bajo rendimiento
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="tipoMensaje[1]" value="Comportamiento" id="TIPO2" {{ old('tipoMensaje.1')=='Comportamiento'?'checked':'' }}>
                                        <label class="form-check-label" for="TIPO2">
                                            Comportamiento
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Asistencia" id="TIPO3" name="tipoMensaje[2]" {{ old('tipoMensaje.2')=='Asistencia'?'checked':'' }}>
                                        <label class="form-check-label" for="TIPO3">
                                            Asistencia
                                        </label>
                                    </div>
                                </div>
                                    

                              
                                    
                                <button class="btn btn-primary btn-block" type="submit">Enviar mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          
      </div>
  </div>
</div>

@prepend('scriptsHeader')
<link rel="stylesheet" type="text/css" href="{{ asset('admin/DataTables/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('admin/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{--  confirm  --}}
    <link rel="stylesheet" href="{{ asset('admin/jquery-confirm-v3.3.4/jquery-confirm.min.css') }}">
    <script src="{{ asset('admin/jquery-confirm-v3.3.4/jquery-confirm.min.js') }}"></script>
@endprepend

@push('scriptsFooter')
   <script>
       
        $('#menuPeriodo').addClass('active');
        function editar(arg){
            var id=$(arg).data('id');
            $('#estudiante_'+id).modal('show');
        }

        $('#estudiante').DataTable({
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

        function eliminar(arg){
            $.confirm({
                title: 'Confirme!',
                content: 'Está seguro de quitar estudiante!',
                type: 'blue',
                icon: 'far fa-sad-cry',
                theme: 'modern',
                closeIcon: true,
                closeIconClass: 'fas fa-times',
                buttons: {
                    confirmar: {
                        text: 'Confirmar', // text for button
                        btnClass: 'btn-primary', // class for the button
                        action: function(heyThereButton){
                            window.location.replace($(arg).data('url'));
                        }
                    },
                    
                    cancelar: {
                        text: 'Cancelar', // text for button
                        btnClass: 'btn-secondary', // class for the button
                        action: function(heyThereButton){
                        }
                    }
                }
            });
        }

   </script>
@endpush

@endsection
