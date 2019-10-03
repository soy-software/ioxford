@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('periodos'))
@section('content')
<div class="container">
  <div class="card">
      <div class="card-header">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $errors->any()?'':'active' }}" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                        Períodos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $errors->any()?'active':'' }}" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        Crear nuevo período
                    </a>
                </li>
            </ul>
      </div>
      <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ $errors->any()?'':'show active' }}" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @if (count($periodos)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Fecha de inicio</th>
                                            <th scope="col">Fecha de final</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($i=0)
                                        @foreach ($periodos as $per)
                                        @php($i++)
                                            <tr>
                                                <th scope="row">
                                                    {{ $i }}
                                                </th>
                                                <th scope="row">
                                                    {{ $per->nombre }}
                                                </th>
                                                <td>
                                                    {{ $per->fecha_inicio }}
                                                </td>
                                                <td>
                                                    {{ $per->fecha_final }}
                                                </td>
                                                
                                                <td>
                                                    @can('Períodos', ioxford\Models\Periodo::class)
                                                        <input type="checkbox" value="{{ $per->id }}" class="toggle-estado" {{ $per->estado=='Proceso'?'checked':'' }} data-toggle="toggle" data-on="Proceso" data-off="Finalizado" data-onstyle="success" data-offstyle="danger" data-size="sm">    
                                                    @else
                                                    <span class="badge badge-{{ $per->estado=='Proceso'?'success':'danger' }}">{{ $per->estado }}</span>
                                                    @endcan
                                                </td>
                                                
                                                <td class="text-right">
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                        @can('actualizar', $per)
                                                            <a href="{{ route('editarPeriodo',$per->id) }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Editar">Editar</a>
                                                        @endcan

                                                        @can('Preparatoría', ioxford\Models\Periodo::class)
                                                            <a href="{{ route('cursos',['tipo'=>'PRE','periodo'=>$per->id]) }}" class="btn primary-color-dark text-white" data-toggle="tooltip" data-placement="top" title="Preparatoría">
                                                                Preparatoría
                                                            </a>    
                                                        @endcan
                                                        
                                                        @can('Básica elemental', ioxford\Models\Periodo::class)
                                                            <a href="{{ route('cursos',['tipo'=>'BE','periodo'=>$per->id]) }}" class="btn primary-color text-white" data-toggle="tooltip" data-placement="top" title="Básica elemental">
                                                                B.elemental
                                                            </a>    
                                                        @endcan
                                                        
                                                        @can('Básica media', ioxford\Models\Periodo::class)
                                                            <a href="{{ route('cursos',['tipo'=>'BM','periodo'=>$per->id]) }}" class="btn info-color text-white" data-toggle="tooltip" data-placement="top" title="Básica media">
                                                                B.media
                                                            </a>
                                                        @endcan
                                                       
                                                        @can('Básica superior', ioxford\Models\Periodo::class)
                                                            <a href="{{ route('cursos',['tipo'=>'BS','periodo'=>$per->id]) }}" class="btn green text-white" data-toggle="tooltip" data-placement="top" title="Básica superior">
                                                                B.superior
                                                            </a>    
                                                        @endcan
                                                        
                                                        @can('Bachillerato', ioxford\Models\Periodo::class)
                                                            <a href="{{ route('cursos',['tipo'=>'BA','periodo'=>$per->id]) }}" class="btn green lighten-1 text-white" data-toggle="tooltip" data-placement="top" title="Bachillerato">
                                                                Bachillerato
                                                            </a>    
                                                        @endcan
                                                        

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $periodos->links() }}
                        @else
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <strong>No existe periodos, por favor crear uno</strong>
                            </div>
                        @endif
                </div>
                <div class="tab-pane fade {{ $errors->any()?'show active':'' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @can('crear', ioxford\Models\Periodo::class)
                    
                    <form method="POST" action="{{ route('periodosGuardar') }}">
                        @csrf

                        <div class="md-form md-outline">
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>
                            <label for="nombre">Nombre del período<i class="text-danger">*</i></label>
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Fecha de incio<i class="text-danger">*</i></label>
                            <div class="input-group date" id="fecha_inicio_date" data-target-input="nearest">
                                <input type="text" name="fecha_inicio" id="fecha_inicio" class="form-control datetimepicker-input @error('fecha_inicio') is-invalid @enderror" value="{{ old('fecha_inicio') }}" data-target="#fecha_inicio_date" required/>
                                <div class="input-group-append" data-target="#fecha_inicio_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('fecha_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                        </div>

                        <div class="form-group">
                            <label for="">Fecha de finalización<i class="text-danger">*</i></label>
                            <div class="input-group date" id="fecha_final_date" data-target-input="nearest">
                                <input type="text" name="fecha_final" id="fecha_final" value="{{ old('fecha_final') }}" class="form-control datetimepicker-input @error('fecha_final') is-invalid @enderror" data-target="#fecha_final_date" required/>
                                <div class="input-group-append" data-target="#fecha_final_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('fecha_final')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>

                    @else
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Sin acceso</strong>
                    </div>
                    @endif

                </div>
            </div>
          
      </div>

  </div>
</div>

@prepend('scriptsHeader')
    <script src="{{ asset('admin/date/moment/moment-with-locales.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admin/date/css/tempusdominus-bootstrap-4.min.css') }}">
    <script src="{{ asset('admin/date/js/tempusdominus-bootstrap-4.min.js') }}"></script>


    {{--  toogle  --}}
    <link href="{{ asset('admin/bootstrap4-toggle-3.5.0/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
    <script src="{{ asset('admin/bootstrap4-toggle-3.5.0/js/bootstrap4-toggle.min.js') }}"></script>

    

@endprepend

@push('scriptsFooter')
    <script>
        $('#fecha_final_date').datetimepicker({
            format: 'L',
            locale:'es',
            format: 'YYYY-MM-DD'
        });

        $('#fecha_inicio_date').datetimepicker({
            format: 'L',
            locale:'es',
            format: 'YYYY-MM-DD'
        });

        $('.toggle-estado').change(function() {
            var per=$(this).val();
            
            $.post("{{ route('estadoPeriodo') }}",{periodo:per})
            .done(function(data) {
                if(data.ok){
                    $.notify(data.ok,"success");
                    location.replace("{{ route('periodos') }}");
                }
                
            })
            .fail(function(error) {
                $.notify("Ocurrrio un error","error");
            })
            .always(function() {
                
            });
        });

        $('#menuPeriodo').addClass('active');


       

    </script>
@endpush

@endsection
