@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Fechas</div>

                <div class="card-body">
                   @foreach ($fecha->mensajes as $msg)
                       <p>{{ $msg->estudiante->user->name }}</p>
                       <p>{{ $msg->tipo }}</p>
                       <p>{{ $msg->created_at }}</p>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@prepend('scriptsHeader')
    
@endprepend

@push('scriptsFooter')
    
@endpush

@endsection
