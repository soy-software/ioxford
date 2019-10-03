@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-primary">
                    <h1 class="logo text-white">UNIDAD EDUCATIVA ----</h1>
                </div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    {{--  <img src="{{ asset('img/dece.jpg') }}" alt="" class="img-fluid img-thumbnail">  --}}
                    <img src="{{ asset('img/foto.jpg') }}" alt="" class="img-fluid">
                

                </div>
            </div>
        </div>
    </div>
</div>

@prepend('scriptsHeader')
    
@endprepend

@push('scriptsFooter')
    <script>
        $('#menuInicio').addClass('active');
    </script>
@endpush

@endsection
