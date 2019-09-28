<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: http://ogp.me/ns#">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>{{ config('app.name', 'U.E.OXFORD') }}</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/oxford.ico') }}">
  <meta name="description" content="Unidad Educativa Oxford - Salcedo">
  <meta name="keywords" content="Unidad,Educativa,Oxford,Salcedo,Escuela,Colegio,Institución">
  <meta name="author" content="OXFORD">

  <!-- OpenGraph metadata-->
  <meta property="og:locale" content="es" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="U.E.OXFORD" />
  <meta property="og:description" content="Unidad Educativa Oxford - Salcedo" />
  <meta property="og:url" content="{{ url('/') }}" />
  <meta property="og:site_name" content="U.E.OXFORD" />
  <meta property="og:image" content="{{ asset('img/oxford.png') }}" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('fontawesome-free-5.10.1-web/css/all.min.css') }}">
  <!-- Bootstrap core CSS -->
  <link href="{{ asset('admin/MDB-Free_4.8.8/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="{{ asset('admin/MDB-Free_4.8.8/css/mdb.min.css') }}" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="{{ asset('admin/MDB-Free_4.8.8/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/logo.css') }}" rel="stylesheet">

  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      .navbar:not(.top-nav-collapse) {
        background: #929FBA !important;
      }
    }

    .logo{
        font-family: 'Prata', serif;
        font-style: italic;
        font-weight: bold;
        
    }

    .letras_slider {
        text-shadow: 2px 2px #000000;
      }

  </style>
  
</head>

<body>

  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
      <div class="container">

        <!-- Brand -->
        <a class="navbar-brand logo" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" height="30" class="d-inline-block align-top img-thumbnail" width="30" alt="mdb logo">
            U.E.OXFORD
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ url('/') }}">Inicio
                <span class="sr-only">(current)</span>
              </a>
            </li>
          
            {{--  <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">La institucíon</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Historía</a>
                    <a class="dropdown-item" href="#">Misión y Visión</a>
                    <a class="dropdown-item" href="#">Organigrama</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Ofertas acádemicas</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Preparatoría</a>
                        <a class="dropdown-item" href="#">Básica elemental</a>
                        <a class="dropdown-item" href="#">Básica media</a>
                        <a class="dropdown-item" href="#">Básica superior</a>
                        <a class="dropdown-item" href="#">Bachillerato</a>
                        <a class="dropdown-item" href="#">Propuesta pedagógica</a>
                    </div>
                </li>

            <li class="nav-item">
              <a class="nav-link" href="" target="_blank">Comunidad educativa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" target="_blank">Noticias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" target="_blank">Contactos</a>
            </li>  --}}


          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="https://www.facebook.com/UEOxford/" class="nav-link" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
        
            <li class="nav-item">
                
                @auth
                    <a href="{{ url('/home') }}" class="nav-link border border-light rounded">
                        <i class="fas fa-folder-open"></i> 
                        Administración
                    </a>
                @else
                <a href="{{ route('login') }}" class="nav-link border border-light rounded">
                    <i class="fas fa-sign-in-alt"></i> Acceder
                </a>
                @endauth

            </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

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
          <div class="view" style="background-image: url('https://scontent.fatf1-1.fna.fbcdn.net/v/t1.0-9/71281170_1399526753549675_4525449749502885888_o.jpg?_nc_cat=109&_nc_oc=AQmYZPnVWpCpNo_D_GhRPJhCRw71VdnK3ttNWMGIuco1kQcAMI9n8_D8PhXxqvWsPrd-wWtqC-l-U5D0AuJKwW32&_nc_ht=scontent.fatf1-1.fna&oh=a13ba9cf375ac9758cdf087514fd900e&oe=5DFB43A7'); background-repeat: no-repeat; background-size: cover;">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

              <!-- Content -->
              <div class="text-center white-text mx-5 wow fadeIn">
                <h1 class="mb-4">
                  <strong class="letras_slider">RENOVAMOS NUESTRA IMAGEN</strong>
                </h1>

                <p class="letras_slider">
                  <strong>Manteniendo el mismo compromiso con la comunidad y la mejor calidad</strong>
                </p>

                <p class="mb-4 d-none d-md-block letras_slider">
                  <strong>FORMAMOS HOY LOS EMPRENDEDORES DEL MAÑANA</strong>
                </p>
              </div>
              <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

          </div>
        </div>
        <!--/First slide-->

        <!--Second slide-->
        <div class="carousel-item">
          <div class="view" style="background-image: url('https://scontent.fatf1-1.fna.fbcdn.net/v/t1.0-9/71209085_1399526403549710_3842730385309958144_o.jpg?_nc_cat=110&_nc_oc=AQmtK__9UP51SPvjuflQ-DpbZ0vSRAkwYTrYMfy2jS6rbJkLu5R1wce8G4EByQ8xWsfzdMieuw_btV05oSBXemky&_nc_ht=scontent.fatf1-1.fna&oh=46bd77b05f62bff790ae123cd53b5bb7&oe=5DFE6C02'); background-repeat: no-repeat; background-size: cover;">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

              <!-- Content -->
           
              <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

          </div>
        </div>
        <!--/Second slide-->

        <!--Third slide-->
        <div class="carousel-item">
          <div class="view" style="background-image: url('https://scontent.fatf1-1.fna.fbcdn.net/v/t1.0-9/70653376_1395918197243864_5166439713959051264_o.jpg?_nc_cat=107&_nc_oc=AQlztAVmEO4O5fUBuAlURGyhIbLBOj071HgYDpxu4aVjaHvPw0CsENeHYiabgGOvkTNnzm7PHQ9pS_7Kl28qxuST&_nc_ht=scontent.fatf1-1.fna&oh=e61f2536cdf6b1133d682f676628946e&oe=5E37D6C0'); background-repeat: no-repeat; background-size: cover;">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

              <!-- Content -->
             
              <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

          </div>
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

  </header>

  <!--Main layout-->
  <main>
    <div class="container">

      <!--Section: Main info-->
      <section class="mt-5 wow fadeIn">

        <!--Grid row-->
        <div class="row">

          <!--Grid column-->
          <div class="col-md-6 mb-4">

            <img src="http://ueoxford.org/images/titulos/quienes_somos/historia-de-la-institucion.jpg" class="img-fluid z-depth-1-half"
              alt="">

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-6 mb-4">

            <!-- Main heading -->
            <h3 class="h3 mb-3">¿CÓMO NACÍO ESTA INSTITUCIÓN?</h3>
            <p class="text-justify">
                Hace dieciocho años un par de jóvenes estudiantes de la Universidad Técnica Particular de Loja, realizaron un proyecto de graduación sobre la creación de una Institución Educativa con un modelo pedagógico propio pensando en una educación de Excelencia.
            </p>
            <p class="text-justify">
                    Una vez terminado y sustentado el trabajo habiéndose hecho acreedores a la más alta calificación y las felicitaciones por parte del jurado y los tutores, los mismos que les aconsejaron poner en práctica, por ser un excelente proyecto.
            </p>
            <!-- Main heading -->
            <!-- CTA -->
            <a href="#" class="btn btn-outline-primary btn-sm btn-block">
                Ver la historía completa ...
                <i class="fas fa-quote-right"></i>
            </a>
            

          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

      </section>
      <!--Section: Main info-->

      <hr class="my-5">

      <!--Section: Main features & Quick Start-->
      <section>

        <h3 class="h3 text-center mb-5">LA INSTITUCIÓN</h3>

        <!--Grid row-->
        <div class="row wow fadeIn">

          <!--Grid column-->
          <div class="col-lg-6 col-md-12 px-4">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Misión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                    aria-selected="false">Visión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                    aria-selected="false">Organigrama</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active text-justify" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>
                        Somos una comunidad educativa comprendida con la institución, que distingue por su solidaridad, espíritu de superación, y que intenta lograr coherencia con sus derechos, deberes; en la que los estudiantes evidencien su formación integral y excelencia académica, a través de parámetros de medición de calidad a nivel nacional y compromiso consigo mismo y con los demás.
                    </p>
                </div>
                <div class="tab-pane fade text-justify" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <p>
                        “Soñamos con una institución con tradición y mística a partir de una unidad educativa comprometida, conformada por docentes, funcionarios, y representantes, que en conjunto desarrolle la formación en valores y excelencia académica. La Unidad Educativa que, además, incentive los esfuerzos y capacidades individuales, artísticas, investigativas, deportivas y culturales para formar personas lideres creadores de sus  propios pensamientos y aporten con un alto grado de compromiso a los nuevos desafíos del país y de la sociedad.  
                    </p>
                </div>
                <div class="tab-pane fade text-justify" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <img src="http://ueoxford.org/images/contenido/1-QUIENES_SOMOS/docentes/2.jpg" class="img-fluid" alt="">
                </div>
            </div>

          </div>
          <!--/Grid column-->

          <!--Grid column-->
          <div class="col-lg-6 col-md-12">

            <p class="h5 text-center mb-4">MIRA NUESTRO VIDEO</p>
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/bp_8lfVWzbo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>
          <!--/Grid column-->

        </div>
        <!--/Grid row-->

      </section>
      <!--Section: Main features & Quick Start-->

      <hr class="my-5">

      <!--Section: Not enough-->
      <section>

        <h2 class="my-5 h3 text-center">OFERTAS ACÁDEMICAS</h2>

        <!--First row-->
        <div class="row features-small mb-5 mt-3 wow fadeIn">

          <!--First column-->
          <div class="col-md-4">
            <!--First row-->
            <div class="row">
              <div class="col-2">
                <i class="fas fa-user-graduate fa-3x text-primary"></i>
              </div>
              <div class="col-10">
                <h6 class="feature-title"><strong>Preparatoría</strong></h6>
                <p class="grey-text text-justify">
                    Las raíces de la educación son amargas, pero la fruta es dulce
                </p>
                <div style="height:15px"></div>
              </div>
            </div>
            <!--/First row-->

            <!--Second row-->
            <div class="row">
              <div class="col-2">
                    <i class="fas fa-user-graduate fa-3x text-primary"></i>
              </div>
              <div class="col-10">
                <h6 class="feature-title"><strong>Básica elemental</strong></h6>
                <p class="grey-text text-justify">
                    La educación es el arma más poderosa que puedes usar para cambiar el mundo
                </p>
                <div style="height:15px"></div>
              </div>
            </div>
            <!--/Second row-->
            
            <!--Third row-->
            <div class="row">
              <div class="col-2">
                    <i class="fas fa-user-graduate fa-3x text-primary"></i>
              </div>
              <div class="col-10">
                <h6 class="feature-title"><strong>Básica media</strong></h6>
                <p class="grey-text text-justify">
                    La educación es un ornamento en la prosperidad y un refugio en la adversidad.
                </p>
                <div style="height:15px"></div>
              </div>
            </div>
            <!--/Third row-->

          </div>
          <!--/First column-->

          <!--Second column-->
          <div class="col-md-4 flex-center">
            <img src="https://scontent.fatf1-1.fna.fbcdn.net/v/t1.0-9/70083198_1386196938215990_2162140722113806336_n.jpg?_nc_cat=102&_nc_oc=AQkoh87qBtCzyUq9X7gCvq9syzVYHVk2w0xYt-QAR3mv-aic1Zu1iHi9qIH6oNvoN1wOQNxx37wvxOKJzlKmIvlJ&_nc_ht=scontent.fatf1-1.fna&oh=885fd52275a17088790e9c1b0604c207&oe=5E312AE5" alt="MDB Magazine Template displayed on iPhone"
              class="z-depth-0 img-fluid">
          </div>
          <!--/Second column-->

          <!--Third column-->
          <div class="col-md-4 mt-2">
            <!--First row-->
            <div class="row">
              <div class="col-2">
                    <i class="fas fa-user-graduate fa-3x green-text"></i>
              </div>
              <div class="col-10">
                <h6 class="feature-title"><strong>Básica superior</strong></h6>
                <p class="grey-text text-justify">
                    La educación no es preparación para la vida; la educación es la vida en si misma.
                </p>
                <div style="height:15px"></div>
              </div>
            </div>
            <!--/First row-->

            <!--Second row-->
            <div class="row">
              <div class="col-2">
                    <i class="fas fa-user-graduate fa-3x green-text"></i>
              </div>
              <div class="col-10">
                <h6 class="feature-title"><strong>Bachillerato</strong></h6>
                <p class="grey-text text-justify">
                    Desarrolla una pasión por aprender. Si lo haces, nunca dejarás de crecer.
                </p>
                <div style="height:15px"></div>
              </div>
            </div>
            <!--/Second row-->
            
            <!--Third row-->
            <div class="row">
              <div class="col-2">
                    <i class="fas fa-user-graduate fa-3x green-text"></i>
              </div>
              <div class="col-10">
                <h6 class="feature-title"><strong>Propuesta pedagógica</strong></h6>
                <p class="grey-text text-justify">
                    La única persona que esta educada es la que ha aprendido cómo aprender y cambiar.
                </p>
                <div style="height:15px"></div>
              </div>
            </div>
            <!--/Third row-->
          </div>
          <!--/Third column-->

        </div>
        <!--/First row-->

      </section>
      <!--Section: Not enough-->

      <hr class="mb-5">

      <!--Section: More-->
      <section>

        <h2 class="my-5 h3 text-center">NOTICIAS</h2>
        <div class="alert alert-primary border border-primary" role="alert">
            <strong>NO TENEMOS NINGUNA NOTICIA POR EL MOMENTO</strong>
        </div>
       

      </section>
      <!--Section: More-->

    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="page-footer text-center font-small mt-4 wow fadeIn">

    <!--Call to action-->
    <div class="pt-4">
      <a class="btn btn-outline-white" href="#">
          CONTACTENOS
        <i class="fas fa-edit ml-2"></i>
      </a>
      <a class="btn btn-outline-white" href="{{ route('login') }}"  role="button">
        ACCEDER
        <i class="fas fa-sign-in-alt ml-2"></i>
      </a>
    </div>
    <!--/.Call to action-->

    <hr class="my-4">

    <!-- Social icons -->
    <div class="pb-4">
      <a href="https://www.facebook.com/UEOxford/" target="_blank">
        <i class="fab fa-facebook-f mr-3"></i>
      </a>
    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
      © {{ date('Y') }} Copyright:
      <a href="{{ url('/') }}" class="logo"> {{ config('app.name','U.E.OXFORD') }} </a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="{{ asset('admin/MDB-Free_4.8.8/js/jquery-3.4.1.min.js') }}"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ asset('admin/MDB-Free_4.8.8/js/popper.min.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset('admin/MDB-Free_4.8.8/js/bootstrap.min.js') }}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ asset('admin/MDB-Free_4.8.8/js/mdb.min.js') }}"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>
</body>

</html>
