


<div class="modal fade" id="estudiante_{{ $est->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <form method="POST" action="{{ route('actualizarEstudiante') }}">
        @csrf
        
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ $est->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="estudiante" value="{{ $est->estudiante->id }}">
                <div class="md-form md-outline mt-0">
                    <label for="nombresApellidos" class="">Nombres y Apellidos de estudiante<i class="text-danger">*</i></label>
                    <input id="nombresApellidos" type="text" class="form-control @error('nombresApellidos') is-invalid @enderror" name="nombresApellidos" value="{{ old('nombresApellidos',$est->name) }}" required autocomplete="nombresApellidos" autofocus>

                    @error('nombresApellidos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="md-form md-outline">
                    <label for="identificacionEstudiante" class="">Identificación de estudiante<i class="text-danger">*</i></label>
                    <input id="identificacionEstudiante" type="text" class="form-control @error('identificacionEstudiante') is-invalid @enderror" name="identificacionEstudiante" value="{{ old('identificacionEstudiante',$est->identificacion) }}" required autocomplete="identificacionEstudiante">

                    @error('identificacionEstudiante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="md-form md-outline">
                    <label for="nombresApellidosRepresentante" class="">Nombres y Apellidos de representante<i class="text-danger">*</i></label>
                    <input id="nombresApellidosRepresentante" type="text" class="form-control @error('nombresApellidosRepresentante') is-invalid @enderror" name="nombresApellidosRepresentante" value="{{ old('nombresApellidosRepresentante',$est->nombres_representante) }}" required autocomplete="nombresApellidosRepresentante">

                    @error('nombresApellidosRepresentante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="md-form md-outline">
                    <label for="identificacionRepresentante" class="">Identificación de representante <i class="text-danger">*</i></label>
                    <input id="identificacionRepresentante" type="text" class="form-control @error('identificacionRepresentante') is-invalid @enderror" name="identificacionRepresentante" value="{{ old('identificacionRepresentante',$est->identificacion_representante) }}" required autocomplete="identificacionRepresentante">

                    @error('identificacionRepresentante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="md-form md-outline">
                    <label for="celularRepresentante" class="">Número de celular de representante(+593 ecuador)<i class="text-danger">*</i></label>
                    <input id="celularRepresentante" type="number" class="form-control @error('celularRepresentante') is-invalid @enderror" name="celularRepresentante" value="{{ old('celularRepresentante',$est->celular_representante) }}" required autocomplete="celularRepresentante">
                    <small id="emailHelp" class="form-text text-muted">Debe especificar el código de país. Formato: (593)998808775, no añada el cero(0) en el número. Ejemplo: 593998808775</small>
                    @error('celularRepresentante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form md-outline">
                    <label for="emailRepresentante" class="">Email de representante</label>
                    <input id="emailRepresentante" type="email" class="form-control @error('emailRepresentante') is-invalid @enderror" name="emailRepresentante" value="{{ old('emailRepresentante',$est->email_representante) }}" autocomplete="emailRepresentante">

                    @error('emailRepresentante')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    {{ __('Actualizar') }}
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                
            </div>
        </div>
    </form>
  </div>
</div>