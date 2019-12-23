@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <img src="{{ asset('img/dece.jpeg') }}" class="card-img-top" alt="...">
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
