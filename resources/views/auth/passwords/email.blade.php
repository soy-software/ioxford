@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('restablecerContrasenia'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-warning">
                    {{--  <img src="{{ asset('img/oxford.png') }}" alt="" class="card-img-top">  --}}
                    Restablecer contraseña
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf


                        <div class="md-form md-outline">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-amber">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
