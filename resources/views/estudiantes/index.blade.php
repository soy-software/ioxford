@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('estudiantes',$paralelo))

@section('content')
<div class="container-fluid">
    <div class="alert alert-warning alert-dismissible" style="display: none;" role="alert">
       <div class="listError"></div>
        <button type="button" class="close" onclick="quitarAlert(this);">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

  <div class="card">
      <div class="card-header">
            <a class="float-right" href="{{ route('reportesMensajes',$paralelo->id) }}" data-toggle="tooltip" data-placement="top" title="Reportes de mensajes enviados">
                <i class="fas fa-clipboard"></i> Reportes
            </a>
            @can('actualizar', $paralelo->cursoPeriodo->periodo)
            <a class="float-right mr-3" href="{{ route('importarEstudianteExcel',$paralelo->id) }}" data-toggle="tooltip" data-placement="top" title="Importar estudiante desde excel">
                    <i class="fas fa-file-import"></i> Importar estudiante
            </a>
            
            <a class="float-right mr-3" href="{{ route('nuevoEstudiante',$paralelo->id) }}" data-toggle="tooltip" data-placement="top" title="Nuevo estudiante" >
                <i class="fas fa-user-plus"></i> Nuevo estudiante
            </a>
            @endcan
            Listado de estudiantes
      </div>
      <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="{{ route('enviarMensaje') }}" method="POST" id="enviarMensajeForm">
                        @csrf
                        <input type="hidden" name="paralelo" value="{{ $paralelo->id }}" required>
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
                                                        
                                                        
                                                        <a href="{{ route('mensajeXestudiante',$est->estudiante->id) }}" class="btn purple darken-3 text-white" data-toggle="tooltip" data-placement="top" title="Generar carta de compromiso">
                                                            <i class="fas fa-sticky-note"></i>
                                                        </a>
                                                        


                                                        @can('actualizar', $paralelo->cursoPeriodo->periodo)
                                                            
                                                        
                                                        <a href="{{ route('editarEstudiante',$est->estudiante->id) }}" class="btn btn-amber" data-toggle="tooltip" data-placement="top" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-unique" data-url="{{ route('retirarEstudiante',$est->estudiante->id) }}" onclick="eliminar(this);" data-toggle="tooltip" data-placement="top" title="Quitar de paralelo">
                                                            <i class="fas fa-user-minus"></i>
                                                        </button>

                                                        @endcan


                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    @can('enviarMensaje', $paralelo)
                                                        <input type="checkbox" name="estudiante[{{ $est->estudiante->id }}]" value="{{ $est->estudiante->id }}" {{ old('estudiante.'.$est->estudiante->id)==$est->estudiante->id ?'checked':'' }}>
                                                    @endcan

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
                                    <p class="mb-1"><strong>Plataforma</strong></p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="PLATAFORMA1" checked disabled >
                                        <label class="form-check-label" for="PLATAFORMA1">
                                            Mensaje de texto <i class="fas fa-sms"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  id="PLATAFORMA2" checked disabled>
                                        <label class="form-check-label" for="PLATAFORMA2">
                                            Correo electrónico <i class="fas fa-envelope-open-text"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="PLATAFORMA3" disabled checked>
                                        <label class="form-check-label" for="PLATAFORMA3">
                                            Whatsapp <i class="fab fa-whatsapp text-success"></i>
                                        </label>
                                    </div>
                                    
                                    
                                </div>
                                <div class="card card-body mb-2">
                                    <p class="mb-1"><strong>Descripción solo para mensaje de texto</strong></p>
                                    <textarea name="texto" disabled rows="4" class="form-control" maxlength="140">Sr, Representante el estudiante (....). Ha incurrido una falta en: (....), acercarse al DECE SAN FRANCISCO DE ASIS</textarea>
                                </div>
                                <div class="card card-body mb-2">
                                    <p class="mb-1"><strong>Detalle descripción extra</strong></p>
                                    <textarea name="extra" rows="4" class="form-control" maxlength="140" placeholder="Redactar.."></textarea>
                                    <small id="emailHelp" class="form-text text-muted">
                                        Solo se enviara a correo electrónico
                                    </small>
                                </div>
                                <div class="card card-body mb-2">
                                    <p class="mb-1"><strong class="@error('tipoMensaje') text-danger @enderror">Seleccione tipo de comunicado</strong></p>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="tipoMensaje[0]" value="Ninguna" id="TIPO0" {{ old('tipoMensaje.0')=='Ninguna'?'checked':'' }} >
                                        <label class="form-check-label" for="TIPO0">
                                            Ninguno
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="tipoMensaje[1]" value="Bajo rendimiento" id="TIPO1" {{ old('tipoMensaje.1')=='Bajo rendimiento'?'checked':'' }} >
                                        <label class="form-check-label" for="TIPO1">
                                            Bajo rendimiento
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="tipoMensaje[2]" value="Comportamiento" id="TIPO2" {{ old('tipoMensaje.2')=='Comportamiento'?'checked':'' }}>
                                        <label class="form-check-label" for="TIPO2">
                                            Comportamiento
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Asistencia" id="TIPO3" name="tipoMensaje[3]" {{ old('tipoMensaje.3')=='Asistencia'?'checked':'' }}>
                                        <label class="form-check-label" for="TIPO3">
                                            Asistencia
                                        </label>
                                    </div>

                                </div>
                                @can('enviarMensaje', $paralelo)
                                    <button class="btn btn-amber btn-block" type="submit">Enviar mensaje</button>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          
      </div>
  </div>
</div>


{{--  modal CARTA  --}}


@prepend('scriptsHeader')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/DataTables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('admin/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{--  confirm  --}}
    <link rel="stylesheet" href="{{ asset('admin/jquery-confirm-v3.3.4/jquery-confirm.min.css') }}">
    <script src="{{ asset('admin/jquery-confirm-v3.3.4/jquery-confirm.min.js') }}"></script>
    {{-- block --}}
    <script src="{{ asset('js/blockui.min.js') }}"></script>
@endprepend

@push('scriptsFooter')
   <script>
       
        $('#menuPeriodo').addClass('active');
        
        function quitarAlert(){
            $('.alert').hide();
            $(".listError").html(''); 
        }
   
        $("#enviarMensajeForm").submit(function(e) {

            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            quitarAlert();
            $.confirm({
                title: 'Confirme!',
                content: 'Está seguro de enviar mensaje/s!',
                type: 'orange',
                icon: 'far fa-sad-cry',
                theme: 'modern',
                closeIcon: true,
                closeIconClass: 'fas fa-times',
                buttons: {
                    confirmar: {
                        text: 'Confirmar', // text for button
                        btnClass: 'btn-amber', // class for the button
                        action: function(heyThereButton){
                            $.blockUI({message:'<img src="{{ asset('img/loading.gif') }}" class="img-fluid" alt="">'});
                            $.post( url,form.serialize())
                            .done(function( data ) {
                                console.log(data)
                                if(data.success){
                                    $.notify(""+data.success, "success");
                                    $("#enviarMensajeForm")[0].reset();
                                }

                                if(data.info){
                                    $.notify(""+data.info, "info");
                                }

                            }).always(function(){
                                $.unblockUI();
                            }).fail(function(data,err){
                                $('.alert').show();
                                var errores='';
                                var datAux = data.responseJSON;
                                $.each(datAux.errors, function() {
                                    $.each(this, function(k, v) {
                                        errores+='<li class="font-weight-semibold">' + v + '</li>';
                                    });
                                });
                
                                if (errores) {
                                    $(".listError").append(errores);
                                }else if (err) {
                                    $(".listError").append('<li class="font-weight-semibold">'+err+'</li>');
                                }
                            });
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
        
        
        });

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
                type: 'orange',
                icon: 'far fa-sad-cry',
                theme: 'modern',
                closeIcon: true,
                closeIconClass: 'fas fa-times',
                buttons: {
                    confirmar: {
                        text: 'Confirmar', // text for button
                        btnClass: 'btn-amber', // class for the button
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
