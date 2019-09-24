@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('usuarios'))
@section('content')
<div class="container">
  <div class="card">
      <div class="card-header">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $errors->any()?'':'active' }}" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                        Listado
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $errors->any()?'active':'' }}" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        Crear nuevo usuario
                    </a>
                </li>
            </ul>
      </div>
      <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ $errors->any()?'':'show active' }}" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="table-responsive">
                        {!! $dataTable->table()  !!}
                    </div>
                </div>
                <div class="tab-pane fade {{ $errors->any()?'show active':'' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form method="POST" action="{{ route('guardarUsuario') }}">
                                @csrf
        
                                
                                <div class="md-form md-outline">
                                    <label for="name" class="">{{ __('Name') }}<i class="text-danger">*</i></label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="md-form md-outline">
                                    <label for="email" class="">{{ __('E-Mail Address') }}<i class="text-danger">*</i></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

        
                                <div class="md-form md-outline">
                                    <label for="password" class="">{{ __('Password') }}<i class="text-danger">*</i></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                                <div class="md-form md-outline">
                                    <label for="password-confirm" class="">{{ __('Confirm Password') }}<i class="text-danger">*</i></label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                                                        <input class="opcionPermisos" name="roles[{{ $rol->id }}]" {{ old('roles.'.$rol->id)==$rol->id ?'checked':'' }} value="{{ $rol->id }}" type="checkbox"   data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger" data-size="xs">
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
        
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                    
                            </form>

                </div>
            </div>
          
      </div>

  </div>
</div>

@prepend('scriptsHeader')
  {{--  datatable  --}}
<link rel="stylesheet" type="text/css" href="{{ asset('admin/DataTables/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('admin/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

{{--  confirm  --}}
<link rel="stylesheet" href="{{ asset('admin/jquery-confirm-v3.3.4/jquery-confirm.min.css') }}">
<script src="{{ asset('admin/jquery-confirm-v3.3.4/jquery-confirm.min.js') }}"></script>
{{--  block  --}}
<script src="{{ asset('js/blockui.min.js') }}"></script>



    

@endprepend

@push('scriptsFooter')
    <script>
        

        $('#menuUsuarios').addClass('active');
        function eliminar(arg){
            $.confirm({
                title: 'Confirme!',
                content: 'Está seguro de eliminar usuario!',
                type: 'blue',
                icon: 'far fa-sad-cry',
                theme: 'modern',
                closeIcon: true,
                closeIconClass: 'fas fa-times',
                buttons: {
                    confirmar: {
                        text: 'Confirmar', // text for button
                        btnClass: 'btn-primary', // class for the button
                        action: function(heyThereButton){
                            $.blockUI({message:'<h1>Espere por favor.!</h1>'});
                            $.post( $(arg).data('url'),{user:$(arg).data('id')})
                            .done(function( data ) {
                                if(data.success){
                                    $('#dataTableBuilder').DataTable().draw(false);
                                    $.notify(""+data.success, "success");
                                }
                                if(data.default){
                                    $.notify(""+data.default, "info");
                                }
                                
                            }).always(function(){
                                $.unblockUI();
                            }).fail(function(){
                                $.notify("Ocurrio un error", "error");
                            });
                        }
                    },
                    
                    cancelar: {
                        text: 'Cancelar', // text for button
                        btnClass: 'btn-secondary', // class for the button
                        action: function(heyThereButton){
                        }
                    }
                }
            });
        }


    
    </script>
    {!! $dataTable->scripts() !!}
@endpush

@endsection
