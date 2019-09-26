@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('reportesMensajes',$paralelo))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Fechas</div>

                <div class="card-body">
                   @foreach ($paralelo->fechas as $fecha)
                       <a href="{{ route('listaMensajes',$fecha->id) }}">
                            {{ $fecha->fecha }}
                       </a>
                   @endforeach
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
