@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('editarUsuario',$user))
@section('content')
<div class="container">
  <div class="card">
      <div class="card-header">
           Complete información
      </div>
      <div class="card-body">
            <form method="POST" action="{{ route('actualizarUsuario') }}">
                    @csrf

                    <input type="hidden" value="{{ $user->id }}" name="usuario">
                    <div class="md-form md-outline">
                        <label for="name" class="">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$user->name) }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="md-form md-outline">
                        <label for="email" class="">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="md-form md-outline">
                        <label for="password" class="">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="md-form md-outline">
                        <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>

                    
                    <hr>
                    <p>Asignar roles</p>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">Rol</th>
                                <th scope="col">Asignar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $rol)
                                    <tr>
                                        <th scope="row">{{ $rol->name }}</th>
                                        <td>
                                            <input class="opcionPermisos" name="roles[{{ $rol->id }}]" {{ $user->hasRole($rol)?'checked':'' }} {{ old('roles.'.$rol->id)==$rol->id ?'checked':'' }} value="{{ $rol->id }}" type="checkbox"   data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger" data-size="xs">
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-deep-purple">
                        {{ __('Register') }}
                    </button>
                        
                </form>
      </div>

  </div>
</div>

@prepend('scriptsHeader')

   

@endprepend

@push('scriptsFooter')
    <script>
        

        $('#menuUsuarios').addClass('active');
   


    
    </script>
@endpush

@endsection
