@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('cursos',$tipo,$periodo))

@section('content')
<div class="container">
  <div class="card">
      <div class="card-header">
          
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $errors->any()?'':'active' }}" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                        Cursos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $errors->any()?'active':'' }}" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        Asignar paralelo a curso
                    </a>
                </li>
            </ul>
      </div>
      <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ $errors->any()?'':'show active' }}" id="home" role="tabpanel" aria-labelledby="home-tab">
                    
                    <div class="row">
                    @foreach ($cursos as $cur)
                    <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg orange">
                                            <th scope="col" colspan="3">
                                                <strong class="text-white">{{ $cur->nombre }}</strong>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($cur->paralelos($cur->curso_periodos->id)->paralelos)>0)
                                            @foreach ($cur->paralelos($cur->curso_periodos->id)->paralelos as $paralelo)
                                            <tr>
                                                <th scope="row">{{ $paralelo->nombre }}</th>
                                                
                                                <td>
                                                    <div class="btn-group btn-group-sm float-right" role="group" aria-label="...">
                                                    <a href="{{ route('estudiantes',$paralelo->id) }}" class="btn amber" data-toggle="tooltip" data-placement="top" title="Listado de estudiantes">Estudiantes</a>
                                                    @can('actualizar', $periodo)
                                                        <button type="button" class="btn btn-unique" data-url="{{ route('eliminarParalelo',$paralelo->id) }}" onclick="eliminar(this);" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @endcan
                                                </div>
                                                </td>    
                                            </tr>
                                            @endforeach  
                                        @else
                                        <tr class="bg orange lighten-4">
                                            <td>
                                                <strong>Sin paralelos</strong>
                                            </td>
                                        </tr>
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                    </div>
                        
                        
                    @endforeach    
                    </div>

                </div>
                <div class="tab-pane fade {{ $errors->any()?'show active':'' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                   @can('actualizar', $periodo)
                    <form action="{{ route('paralelosGuardar') }}" method="POST">
                        @csrf 
                        <input type="hidden" name="periodo" value="{{ $periodo->id }}" required>
                        <input type="hidden" value="{{ $tipo }}" name="tipo" required>
                        <div class="form-group">
                            <label for="" class="mb-1">Selecione curso/s<i class="text-danger">*</i></label><br>
                            @foreach ($cursos as $cur_ck)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="curso_periodos[]" id="curso_periodos{{ $cur_ck->id }}" value="{{ $cur_ck->curso_periodos->id }}">
                                    <label class="form-check-label" for="curso_periodos{{ $cur_ck->id }}">{{ $cur_ck->nombre }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="paralelo">Selecione paralelo</label>
                            <select class="form-control" name="paralelo" id="paralelo">
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="C">C</option>
                              <option value="D">D</option>
                            </select>
                        </div>
                        <button class="btn btn-amber">Guardar</button>
                    </form>
                    @else
                    <div class="alert alert-warning" role="alert">
                        <strong>No asignar paralelo a curso en este período</strong>
                    </div>
                    @endcan

                </div>
            </div>
          
      </div>
  </div>
</div>

@prepend('scriptsHeader')
    {{--  confirm  --}}
    <link rel="stylesheet" href="{{ asset('admin/jquery-confirm-v3.3.4/jquery-confirm.min.css') }}">
    <script src="{{ asset('admin/jquery-confirm-v3.3.4/jquery-confirm.min.js') }}"></script>
@endprepend

@push('scriptsFooter')
   <script>
        function eliminar(arg){
            $.confirm({
                title: 'Confirme!',
                content: 'Está seguro de eliminar paralelo!',
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
        $('#menuPeriodo').addClass('active');
   </script>
@endpush

@endsection
