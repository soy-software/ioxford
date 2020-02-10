@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('mensajeXestudiante',$estudiante))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    @role('DECE')
                    <button type="button" class="btn btn-amber float-right" data-url="{{ route('imprimirCartaCompromiso',$estudiante->id) }}" onclick="imprimirCartaCompromiso(this);">Imprimir carta de compromiso</button>
                    @endrole
                    Lista de faltas incurridas del estudiante: <strong>{{ $estudiante->user->name }}</strong>
                </div>

                <div class="card-body">
                    @if (count($estudiante->mensajes)>0)

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="tableMensaje">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Estudiante</th>
                                    <th scope="col">Identificacíon</th>
                                    <th scope="col">Representante</th>
                                    <th scope="col">Identificación representante</th>
                                    <th scope="col">Email representante</th>
                                    <th scope="col">Celular representante</th>
                                    <th scope="col">Tipo de comunicado</th>
                                    <th scope="col">Fecha y hora</th>
                                    <th scope="col">Imprimir carta de compromiso</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=0)
                                @foreach ($estudiante->mensajes as $msg)
                                @php($i++)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>
                                        {{ $msg->estudiante->user->name }}
                                    </td>
                                    <td>
                                        {{ $msg->estudiante->user->identificacion }}
                                    </td>
                                    <td>
                                        {{ $msg->estudiante->user->nombres_representante }}
                                    </td>
                                    <td>
                                        {{ $msg->estudiante->user->identificacion_representante }}
                                    </td>
                                    <td>
                                        {{ $msg->estudiante->user->email_representante }}
                                    </td>
                                    <td>
                                        {{ $msg->estudiante->user->celular_representante }}
                                    </td>
                                    <td>
                                        {{ $msg->tipo }}
                                    </td>
                                    <td>
                                        {{ $msg->created_at }}
                                    </td>
                                    <td>
                                        @can('enviarMensaje', $estudiante->paralelo)
                                        <input type="checkbox" value="{{ $msg->id }}" class="toggle-estado" {{ $msg->estado==true?'checked':'' }} data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>

                    @else
                        <div class="alert alert-primary" role="alert">
                            <strong>No existe mensajes</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


{{--  modal  --}}
<div class="modal fade bd-example-modal-lg" id="modalCartaCompromiso" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" id="iframeCartaCompromiso" src="" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>


@prepend('scriptsHeader')

{{--  toogle  --}}
<link href="{{ asset('admin/bootstrap4-toggle-3.5.0/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
<script src="{{ asset('admin/bootstrap4-toggle-3.5.0/js/bootstrap4-toggle.min.js') }}"></script>

@endprepend

@push('scriptsFooter')
    <script>
        $('#menuPeriodo').addClass('active');

        function imprimirCartaCompromiso(arg){
            $('#modalCartaCompromiso').modal('show');
            $('#iframeCartaCompromiso').attr('src',$(arg).data('url'));
        }

        $('.toggle-estado').change(function() {
            var per=$(this).val();

            $.post("{{ route('estadoMensaje') }}",{mensaje:per})
            .done(function(data) {
                if(data.ok){
                    $.notify(data.ok,"success");
                }

            })
            .fail(function(error) {
                $.notify("Ocurrrio un error","error");
            })
            .always(function() {

            });
        });

    </script>
@endpush

@endsection
