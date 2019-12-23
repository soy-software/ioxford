@extends('layouts.app',['title'=>'Fechas'])
@section('breadcrumbs', Breadcrumbs::render('reportesMensajes',$paralelo))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Fechas</div>

                <div class="card-body">
                   @foreach ($fechas as $fecha)
                       <li>
                        <a href="{{ route('listaMensajes',$fecha->id) }}" data-toggle="tooltip" data-placement="top" title="Ver listado de mensajes">
                            {{ $fecha->fecha }}
                       </a>
                       </li>
                   @endforeach
                </div>          
                <div class="card-footer text-muted">
                        {{ $fechas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@prepend('scriptsHeader')
    
@endprepend

@push('scriptsFooter')
    <script>
        $('#menuPeriodo').addClass('active');
    </script>
@endpush

@endsection
