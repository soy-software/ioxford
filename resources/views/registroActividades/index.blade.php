@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('registroActividades'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
          
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-amber btn-sm" class="" href="{{ route('limpiarRegistroActividades') }}">Vaciar registro de actividades</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">Causado por</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Tabla</th>
                                    <th scope="col">Fecha y hora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registroActividades as $ga)
                                        <tr>
                                            <th scope="row">
                                                {{ $ga->causer->email??'' }}
                                            </th>
                                            <td>
                                                {{ $ga->description??'' }}
                                            </td>
                                            <td>
                                                {{ $ga->subject_type??'' }}
                                            </td>
                                            <td>
                                                {{ $ga->created_at }}
                                            </td>
                                            
                                        </tr>      
                                    @endforeach
                                    
        
                                </tbody>
                            </table>
                        </div>
                    </div>    
                </div>

        </div>
    </div>
</div>

@prepend('scriptsHeader')
    
@endprepend

@push('scriptsFooter')
    <script>
        $('#menuRegActividades').addClass('active');
    </script>
@endpush

@endsection
