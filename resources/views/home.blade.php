@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
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
