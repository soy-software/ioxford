@extends('layouts.app',['title'=>'Inicio'])
@section('breadcrumbs', Breadcrumbs::render('inicio'))
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                

                <div class="card-body text-center">
                   
                  <!--Carousel Wrapper-->
                  <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
                    <!--Indicators-->
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                      <li data-target="#carousel-example-1z" data-slide-to="2"></li>
                    </ol>
                    <!--/.Indicators-->
                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">
                      <!--First slide-->
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('img/inicio.jpeg') }}" alt="First slide">
                      </div>
                      <!--/First slide-->
                      <!--Second slide-->
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('img/inicio2.jpeg') }}" alt="Second slide">
                      </div>
                      <!--/Second slide-->
                      <!--Third slide-->
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('img/sf.jpeg') }}" alt="Third slide">
                      </div>
                      <!--/Third slide-->
                    </div>
                    <!--/.Slides-->
                    <!--Controls-->
                    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                    <!--/.Controls-->
                  </div>
                  <!--/.Carousel Wrapper-->

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
