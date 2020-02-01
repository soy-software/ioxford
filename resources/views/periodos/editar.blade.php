@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('editarPeriodo',$per))
@section('content')
<div class="container">
  <div class="card">
      <div class="card-header">
          Complete información
      </div>
      <div class="card-body">
            @can('actualizar', $per)
              
          
            <form method="POST" action="{{ route('periodosActualizar') }}">
                @csrf
                <input type="hidden" name="periodo" value="{{ $per->id }}">
                <div class="md-form md-outline">
                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre',$per->nombre) }}" required autocomplete="nombre" autofocus>
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
                        <input type="text" name="fecha_inicio" id="fecha_inicio" class="form-control datetimepicker-input @error('fecha_inicio') is-invalid @enderror" value="{{ old('fecha_inicio',$per->fecha_inicio) }}" data-target="#fecha_inicio_date" required/>
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
                        <input type="text" name="fecha_final" id="fecha_final" value="{{ old('fecha_final',$per->fecha_final) }}" class="form-control datetimepicker-input @error('fecha_final') is-invalid @enderror" data-target="#fecha_final_date" required/>
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
                        <button type="submit" class="btn btn-amber">
                            Actualizar
                        </button>
                    </div>
                </div>
            </form>
            @else
            <div class="alert alert-primary" role="alert">
                <strong>No puede actualizar período</strong>
            </div>

            @endcan
          
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
