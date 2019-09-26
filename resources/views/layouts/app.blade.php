<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'U.E.OXFORD') }}</title>

  <meta name="description" content="Unidad Educativa Oxford">
  <meta name="keywords" content="Unidad,Educativa,Oxford,Salcedo,Escuela,Colegio,Institución">
  <meta name="author" content="OXFORD">
  
  <!-- OpenGraph metadata-->
  <meta property="og:locale" content="es" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="U.E.OXFORD" />
  <meta property="og:description" content="Unidad Educativa Oxford" />
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

  <!-- JQuery -->
  <script type="text/javascript" src="{{ asset('admin/MDB-Free_4.8.8/js/jquery-3.4.1.min.js') }}"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ asset('admin/MDB-Free_4.8.8/js/popper.min.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset('admin/MDB-Free_4.8.8/js/bootstrap.min.js') }}"></script>
  <link href="{{ asset('css/logo.css') }}" rel="stylesheet">
  {{--  extras  --}}
  <script src="{{ asset('js/notify.min.js') }}"></script>
  
  @stack('scriptsHeader')

  <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <style>
        .logo{
            font-family: 'Prata', serif;
            font-style: italic;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-white shadow-sm blue darken-3">
            <div class="container">
                    <a class="navbar-brand logo" href="{{ url('/') }}">
                        {{ config('app.name', 'U.E.OXFORD') }}
                    </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                        
                        <li class="nav-item" id="menuInicio">
                            <a class="nav-link" href="{{ route('home') }}">
                                Inicio
                            </a>
                        </li>
                        
                        
                        @role('DECE')

                        <li class="nav-item" id="menuRoles">
                            <a class="nav-link" href="{{ route('roles') }}">
                                Roles
                            </a>
                        </li>

                        @endrole

                        @can('Usuarios', ioxford\User::class)
                            <li class="nav-item" id="menuUsuarios">
                                <a class="nav-link" href="{{ route('usuarios') }}">
                                    Usuarios
                                </a>
                            </li>
                        @endcan

                        <li class="nav-item" id="menuPeriodo">
                            <a class="nav-link" href="{{ route('periodos') }}">
                                Período
                            </a>
                        </li>
                            

                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link border border-light rounded waves-effect waves-light" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a>
                            </li>
                            {{--  @if (Route::has('register'))
                                <li class="nav-item ml-2">
                                    <a class="nav-link border border-light rounded waves-effect waves-light" href="{{ route('register') }}"><i class="fas fa-user-edit"></i> {{ __('Register') }}</a>
                                </li>
                            @endif  --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fas fa-user"></i>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('miPerfil') }}">
                                        <i class="fas fa-user-circle"></i> Mi perfil
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>

                                   

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('breadcrumbs')
            @if ($errors->any())
                <div class="container">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        @foreach ($errors->all() as $error)
                            <li>
                                <strong>{{ $error }}</strong>
                                
                            </li>
                        @endforeach
                        
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

  <!-- SCRIPTS -->
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ asset('admin/MDB-Free_4.8.8/js/mdb.min.js') }}"></script>
  @stack('scriptsFooter')

    @foreach (['success', 'warn', 'info', 'error'] as $msg)
        @if(Session::has($msg))
            <script>
                $.notify("{{ Session::get($msg) }}","{{ $msg }}");
            </script>
        @endif
    @endforeach
    
    <script>
        $('[data-toggle="tooltip"]').tooltip()
        $('table').on('draw.dt', function() {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>

</body>

</html>
