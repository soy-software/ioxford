@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('importarEstudianteExcel',$paralelo))

@section('content')
<div class="container">
    
    @can('actualizar', $periodo)
    
    <form method="POST" enctype="multipart/form-data" action="{{ route('importarEstudiante') }}">
        @csrf    
        <div class="card">
            <div class="card-header">
                Importar excel
            </div>
            <div class="card-body">
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
                        
                <input type="hidden" name="paralelo" value="{{ $paralelo->id }}" required>
                <div class="form-group my-1 ml-1">
                    <label for="exampleFormControlFile1">Selecione archivo .excel</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="archivo" required>
                </div>
                    
                
                        
            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-amber">Importar estudiantes</button>
            </div>
        </div>
    </form>
    @else
    <div class="alert alert-warning" role="alert">
        <strong>No puede crear estudiantes en este período</strong>
    </div>
    @endcan

@prepend('scriptsHeader')

@endprepend

@push('scriptsFooter')
    <script>
        
        $('#menuPeriodo').addClass('active');

    </script>
@endpush

@endsection
    