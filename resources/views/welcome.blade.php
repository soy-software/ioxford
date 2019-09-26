<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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

        <link href="{{ asset('css/logo.css') }}" rel="stylesheet">
        <!-- Fonts -->

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .logo{
                font-family: 'Prata', serif;
                font-style: italic;
                font-weight: bold;
            }
        </style>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Administración</a>
                    @else
                        <a href="{{ route('login') }}">Iniciar sesión</a>

                        {{--  @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif  --}}
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="links logo">
                    UNIDAD EDUCATIVA
                </div>
                <div class="title m-b-md logo">
                    OXFORD
                </div>
            </div>
        </div>
    </body>
</html>
