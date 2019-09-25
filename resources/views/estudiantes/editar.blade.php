@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('editarEstudiante',$est))

@section('content')
<div class="container">
    @can('actualizar', $est->paralelo->cursoPeriodo->periodo)
        
    
    <form method="POST" action="{{ route('actualizarEstudiante') }}">
        @csrf
        <div class="card">
            <div class="card-header">
                Actualice información
            </div>
            <div class="card-body">
                <input type="hidden" name="estudiante" value="{{ $est->id }}">
                <div class="md-form md-outline mt-0">
                    <label for="nombresApellidos" class="">Nombres y Apellidos de estudiante<i class="text-danger">*</i></label>
                    <input id="nombresApellidos" type="text" class="form-control @error('nombresApellidos') is-invalid @enderror" name="nombresApellidos" value="{{ old('nombresApellidos',$est->user->name) }}" required autocomplete="nombresApellidos" autofocus>

                    @error('nombresApellidos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="md-form md-outline">
                    <label for="identificacionEstudiante" class="">Identificación de estudiante<i class="text-danger">*</i></label>
                    <input id="identificacionEstudiante" type="text" class="form-control @error('identificacionEstudiante') is-invalid @enderror" name="identificacionEstudiante" value="{{ old('identificacionEstudiante',$est->user->identificacion) }}" required autocomplete="identificacionEstudiante">

                    @error('identificacionEstudiante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="md-form md-outline">
                    <label for="nombresApellidosRepresentante" class="">Nombres y Apellidos de representante<i class="text-danger">*</i></label>
                    <input id="nombresApellidosRepresentante" type="text" class="form-control @error('nombresApellidosRepresentante') is-invalid @enderror" name="nombresApellidosRepresentante" value="{{ old('nombresApellidosRepresentante',$est->user->nombres_representante) }}" required autocomplete="nombresApellidosRepresentante">

                    @error('nombresApellidosRepresentante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="md-form md-outline">
                    <label for="identificacionRepresentante" class="">Identificación de representante <i class="text-danger">*</i></label>
                    <input id="identificacionRepresentante" type="text" class="form-control @error('identificacionRepresentante') is-invalid @enderror" name="identificacionRepresentante" value="{{ old('identificacionRepresentante',$est->user->identificacion_representante) }}" required autocomplete="identificacionRepresentante">

                    @error('identificacionRepresentante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="md-form md-outline">
                    <label for="celularRepresentante" class="">Número de celular de representante(+593 ecuador)<i class="text-danger">*</i></label>
                    <input id="celularRepresentante" type="number" class="form-control @error('celularRepresentante') is-invalid @enderror" name="celularRepresentante" value="{{ old('celularRepresentante',$est->user->celular_representante) }}" required autocomplete="celularRepresentante">
                    <small id="emailHelp" class="form-text text-muted">Debe especificar el código de país. Formato: (593)998808775, no añada el cero(0) en el número. Ejemplo: 593998808775</small>
                    @error('celularRepresentante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form md-outline">
                    <label for="emailRepresentante" class="">Email de representante</label>
                    <input id="emailRepresentante" type="email" class="form-control @error('emailRepresentante') is-invalid @enderror" name="emailRepresentante" value="{{ old('emailRepresentante',$est->user->email_representante) }}" autocomplete="emailRepresentante">

                    @error('emailRepresentante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">
                    {{ __('Actualizar') }}
                </button>
            </div>
        </div>
    </form>
    @else
    <div class="alert alert-primary" role="alert">
        <strong>No puede actualizar estudiante en este período</strong>
    </div>
    @endcan
</div>

@prepend('scriptsHeader')

@endprepend

@push('scriptsFooter')
   <script>
       
        $('#menuPeriodo').addClass('active');

   </script>
@endpush

@endsection
