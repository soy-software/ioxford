@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('estudiantes',$paralelo))

@section('content')
<div class="container-fluid">
  <div class="card">
      <div class="card-header">
          
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $errors->any()?'':'active' }}" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                        Estudiantes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $errors->any()?'active':'' }}" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        Ingresar nuevo estudiante
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="importar-tab" data-toggle="tab" href="#importar" role="tab" aria-controls="importar" aria-selected="false">
                        Importar estudiantes desde excel
                    </a>
                </li>
            </ul>
      </div>
      <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ $errors->any()?'':'show active' }}" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                                            <th scope="col">
                                                Selecionar/Deselecionar
                                            </th>
                                            <th scope="col">Acciones</th>
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
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                        <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar" data-id="{{ $est->id }}" onclick="editar(this);">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-unique" data-url="{{ route('retirarEstudiante',$est->estudiante->id) }}" onclick="eliminar(this);" data-toggle="tooltip" data-placement="top" title="Quitar de paralelo">
                                                            <i class="fas fa-user-minus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="estudiante[]" value="{{ $est->id }}">
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
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">BAJO RENDIMIENTO</th>
                                                <th scope="col">COMPORTAMIENTO</th>
                                                <th scope="col">ASISTENCIA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="bajo rendimiento" name="bajoRendimiento">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="comportamiento" name="comportamiento">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="asistencia" name="asistencia">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button class="btn btn-primary btn-block" type="submit">Enviar mensaje</button>
                            </div>
                        </div>
                    </form>

                    @if(count($paralelo->estudiantes)>0)
                    @foreach ($paralelo->estudiantes as $est)
                    @include('estudiantes.editar',['est'=>$est])
                    @endforeach
                    @endif

                    
                    @if (session('abrirModal'))
                        <script>
                            $('#estudiante')
                        </script>
                    @endif
                    

                </div>

                <div class="tab-pane fade {{ $errors->any()?'show active':'' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                   @can('actualizar', $periodo)

                        <form method="POST" action="{{ route('guardarEstudiante') }}">
                            @csrf
                            <input type="hidden" name="paralelo" value="{{ $paralelo->id }}">
                            <div class="md-form md-outline">
                                <label for="nombresApellidos" class="">Nombres y Apellidos de estudiante<i class="text-danger">*</i></label>
                                <input id="nombresApellidos" type="text" class="form-control @error('nombresApellidos') is-invalid @enderror" name="nombresApellidos" value="{{ old('nombresApellidos') }}" required autocomplete="nombresApellidos" autofocus>

                                @error('nombresApellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="md-form md-outline">
                                <label for="identificacionEstudiante" class="">Identificación de estudiante<i class="text-danger">*</i></label>
                                <input id="identificacionEstudiante" type="text" class="form-control @error('identificacionEstudiante') is-invalid @enderror" name="identificacionEstudiante" value="{{ old('identificacionEstudiante') }}" required autocomplete="identificacionEstudiante">

                                @error('identificacionEstudiante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="md-form md-outline">
                                <label for="nombresApellidosRepresentante" class="">Nombres y Apellidos de representante<i class="text-danger">*</i></label>
                                <input id="nombresApellidosRepresentante" type="text" class="form-control @error('nombresApellidosRepresentante') is-invalid @enderror" name="nombresApellidosRepresentante" value="{{ old('nombresApellidosRepresentante') }}" required autocomplete="nombresApellidosRepresentante">

                                @error('nombresApellidosRepresentante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="md-form md-outline">
                                <label for="identificacionRepresentante" class="">Identificación de representante <i class="text-danger">*</i></label>
                                <input id="identificacionRepresentante" type="text" class="form-control @error('identificacionRepresentante') is-invalid @enderror" name="identificacionRepresentante" value="{{ old('identificacionRepresentante') }}" required autocomplete="identificacionRepresentante">

                                @error('identificacionRepresentante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="md-form md-outline">
                                <label for="celularRepresentante" class="">Número de celular de representante(+593 ecuador)<i class="text-danger">*</i></label>
                                <input id="celularRepresentante" type="number" class="form-control @error('celularRepresentante') is-invalid @enderror" name="celularRepresentante" value="{{ old('celularRepresentante','593') }}" required autocomplete="celularRepresentante">
                                <small id="emailHelp" class="form-text text-muted">Debe especificar el código de país. Formato: (593)998808775, no añada el cero(0) en el número. Ejemplo: 593998808775</small>
                                @error('celularRepresentante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="md-form md-outline">
                                <label for="emailRepresentante" class="">Email de representante</label>
                                <input id="emailRepresentante" type="email" class="form-control @error('emailRepresentante') is-invalid @enderror" name="emailRepresentante" value="{{ old('emailRepresentante') }}" autocomplete="emailRepresentante">

                                @error('emailRepresentante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                                
                        </form>
                    @else
                    <div class="alert alert-primary" role="alert">
                        <strong>No puede crear estudiantes en este período</strong>
                    </div>
                    @endcan

                </div>
                <div class="tab-pane fade" id="importar" role="tabpanel" aria-labelledby="importar-tab">
                    <div class="table-responsive">
                            
                        <p><strong class="text-danger">Importante:</strong> El archivo .excel debe cumplir con el formato establecido a continuación.</p>
                        
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        
                                        <th scope="col">Nombres y Apellidos de estudiante<i class="text-danger">*</i></th>
                                        <th scope="col">Identificación de estudiante<i class="text-danger">*</i></th>
                                        <th scope="col">Nombres y Apellidos de representante<i class="text-danger">*</i></th>
                                        <th scope="col">Identificación de representante<i class="text-danger">*</i></th>
                                        <th scope="col">Número de celular de representante(+593 ecuador)<i class="text-danger">*</i></th>
                                        <th scope="col">Email de representante</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                        <th scope="row">JENNY SORAYA DÍAZ ANTE</th>
                                        <td>0503870735</td>
                                        <td>JULIO DÍAZ</td>
                                        <td>0503652349</td>
                                        <td>593995446543</td>
                                        <td>julio_diaz@gmail.com</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>

                    <div class="card car-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('importarEstudiante') }}">
                            @csrf
                            <input type="hidden" name="paralelo" value="{{ $paralelo->id }}" required>
                            <div class="form-group my-1 ml-1">
                                <label for="exampleFormControlFile1">Selecione archivo .excel</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="archivo" required>
                            </div>
                            <button class="btn btn-primary">Importar estudiantes</button>
                        </form>
                    </div>

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
