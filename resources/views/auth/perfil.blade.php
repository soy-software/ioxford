@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('miPerfil'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-primary">
                    <h1 class="logo text-white">Mi perfil</h1>
                </div>

                <div class="card-body">

                        <form method="POST" action="{{ route('actualizarMiPerfil') }}">
                                @csrf
                                    <div class="md-form md-outline">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$user->name) }}" required autocomplete="name" autofocus>
                                        <label for="name" class="">{{ __('Name') }}</label>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                
        
                                    <div class="md-form md-outline">
                                    
        
                                        <label for="email" class="">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}" required autocomplete="email" disabled>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                
        
                                <div class="md-form md-outline">
                                    
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                        <label for="password" class="">{{ __('Password') }}</label>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                </div>
        
                                <div class="md-form md-outline">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                        <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                                    
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Actualizar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                    
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
