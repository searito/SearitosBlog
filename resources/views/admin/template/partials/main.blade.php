<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'BlogCF') | Panel De Admón</title>

    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/tuneup.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery/chosen/chosen.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery/trumbowyg/dist/ui/trumbowyg.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery/lightbox2-master/dist/css/lightbox.min.css') }}">


    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

    <link rel="shortcut icon" href="{{asset('img/mikuchibi.png')}}">
</head>
<body>
<nav class="navbar navbar-inverse sidebar" role="navigation">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <span class="text-white lobster fmediana">Searito's Blog</span>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <div class="profile-userpic avatarmdm hidden-xs" style="background-image: url({{ '../' .Auth::user()->imgprofile }})">
                </li>

                <li>
                    <h3 class="text-white text-capitalize text-center lobster">{{ Auth::user()->nick }}</h3>
                </li>


                @if(Auth::user()->admin())
                <li class="active">
                    <a href="{{ route('admin.home') }}">Dashboard
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-dashboard" aria-hidden="true"></span>
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{ route('admin.profile') }}">Mi Perfil
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-user-circle" aria-hidden="true"></span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('front.index') }}" target="_blank">
                        Página Principal
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-eye" aria-hidden="true"></span>
                    </a>
                </li>


                @if(Auth::user()->admin())
                <li>
                    <a href="{{ route('users.index') }}">Usuarios
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-users" aria-hidden="true"></span>
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{ route('categories.index') }}">Categorías
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-folder-open" aria-hidden="true"></span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('tags.index') }}">Tags
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-tags" aria-hidden="true"></span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('articles.index') }}">Artículos
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-newspaper-o" aria-hidden="true"></span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('images.index') }}">Imágenes
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-camera-retro" aria-hidden="true"></span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('contact') }}">Contacto
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-envelope" aria-hidden="true"></span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}">Salir
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-power-off" aria-hidden="true"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<div class="main">
    @include('flash::message')
    @yield('content')
    @include('admin.template.partials.errors')
</div>

    <script src="{{asset('plugins/jquery/js/jquery.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('plugins/jquery/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('plugins/jquery/chosen/chosen.proto.js')}}"></script>
    <script src="{{ asset('plugins/jquery/trumbowyg/dist/trumbowyg.js') }}"></script>
    <script src="{{ asset('plugins/jquery/lightbox2-master/dist/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery/gridify/javascript/gridify.js') }}"></script>


    <script>
        function htmlbodyHeightUpdate(){
            var height3 = $( window ).height()
            var height1 = $('.nav').height()+50
            height2 = $('.main').height()
            if(height2 > height3){
                $('html').height(Math.max(height1,height3,height2)+10);
                $('body').height(Math.max(height1,height3,height2)+10);
            }
            else
            {
                $('html').height(Math.max(height1,height3,height2));
                $('body').height(Math.max(height1,height3,height2));
            }

        }
        $(document).ready(function () {
            htmlbodyHeightUpdate()
            $( window ).resize(function() {
                htmlbodyHeightUpdate()
            });
            $( window ).scroll(function() {
                height2 = $('.main').height()
                htmlbodyHeightUpdate()
            });
        });
    </script>

    @yield('js')
</body>
</html>