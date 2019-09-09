@extends('layouts.app',['title'=>'Roles'])

@section('breadcrumbs', Breadcrumbs::render('roles'))



@section('content')

<div class="container">

<div class="card">
    <div class="card-header">
        <form action="{{ route('guardarRol') }}" method="post">
            @csrf
            
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('rol') is-invalid @enderror" name="rol" placeholder="Nuevo rol" value="{{ old('rol') }}" aria-label="Rol" aria-describedby="button-addon2" required>
                @error('rol')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="input-group-append">
                    <button class="btn btn-md btn-deep-purple m-0 px-3 py-2 z-depth-0 waves-effect" type="submit" id="button-addon2">Guardar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {!! $dataTable->table()  !!}
        </div>
    </div>
</div>
</div>

@push('scriptsHeader')
{{--  datatable  --}}
<link rel="stylesheet" type="text/css" href="{{ asset('admin/DataTables/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('admin/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

{{--  confirm  --}}
<link rel="stylesheet" href="{{ asset('admin/jquery-confirm-v3.3.4/jquery-confirm.min.css') }}">
<script src="{{ asset('admin/jquery-confirm-v3.3.4/jquery-confirm.min.js') }}"></script>
{{--  block  --}}
<script src="{{ asset('js/blockui.min.js') }}"></script>
@endpush

@prepend('scriptsFooter')
    <script>
        $('#menuRoles').addClass('active');

      

        function eliminar(arg){
            $.confirm({
                title: 'Confirme!',
                content: 'Está seguro de eliminar rol!',
                type: 'blue',
                icon: 'far fa-sad-cry',
                theme: 'modern',
                closeIcon: true,
                closeIconClass: 'fas fa-times',
                buttons: {
                    confirmar: function () {
                        $.blockUI({message:'<h1>Espere por favor.!</h1>'});
                        $.post( $(arg).data('url'), { id: $(arg).data('id') })
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
                            $.notify("Ocurrio un error", "danger");
                        });
                    },
                    cancelar: function () {
                        
                    }
                }
            });
        }

        
    </script>
    {!! $dataTable->scripts() !!}
    
@endprepend

@endsection
