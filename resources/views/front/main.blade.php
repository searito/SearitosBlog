<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('frontitle', 'Searitos Blog')</title>

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
    <!--    https://www.youtube.com/watch?v=xSTwyYDT-A8&index=1&list=PLhSj3UTs2_yUrzFL3f2zDwBCKMpAVBBz_         -->
<body class="fblanco">
    <header>
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navBlog">
                        <span class="sr-only">Desplegar / Ocultar Menú</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a href="{{ url('/') }}" class="navbar-brand lobster">Searito's Blog</a>
                </div>

                <div class="collapse navbar-collapse" id="navBlog">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="{{ url('/') }}">
                                <i class="fa fa-home" aria-hidden="true"></i> Inicio
                            </a>
                        </li>
                    </ul>


                    {!! Form::open(['route' => 'front.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left']) !!}
                    <div class="input-group">
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Buscar Un Artículo', 'aria-describedby' => 'search']) !!}
                        <span class="input-group-addon" id="search">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </span>
                    </div>
                    {!! Form::close() !!}


                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{ route('login') }}">
                                <i class="fa fa-sign-in" aria-hidden="true"></i> Sing-in
                            </a>
                        </li>

                        <li>
                            <a href="#registerModal" data-toggle="modal">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Registro
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center secondary-text" id="myModalLabel">Formulario De Registro</h4>
                    </div>

                    <div class="modal-body">
                        {!! Form::open(['route' => 'register', 'method' => 'POST']) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Nombre:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Raúl Álvarez']) !!}
                                <div class="pull-right">
                                    <span class="label label-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', 'Contraseña:') !!}
                                {!! Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => '********']) !!}
                                <div class="pull-right">
                                    <span class="label label-danger">{{$errors->first('password')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('newpass2', 'Confirmar Contraseña') !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'required', 'placeholder' => '********']) !!}

                                <div class="pull-right">
                                    <span class="label label-danger">{{$errors->first('password_confirmation')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('nick', 'Nickname:') !!}
                                {!! Form::text('nick', null, ['class' => 'form-control', 'placeholder' => 'AuronPlay']) !!}
                                <div class="pull-right">
                                    <span class="label label-danger">{{$errors->first('nick')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'Correo Electrónico:') !!}
                                {!! Form::text('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'auronplay@gmail.com']) !!}
                                <div class="pull-right">
                                    <span class="label label-danger">{{$errors->first('email')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Registrar', ['class' => 'btn btn-primary btn-block']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


    </header>


    <section class="jumbotron">
        <div class="container">
            <a href="{{ url('/') }}">
                <h1 class="lobster">Searito's Blog</h1>
            </a>
            <p>Primer Proyecto Desarrollado En Laravel</p>
        </div>
    </section>


    <section class="main container">
        @include('flash::message')
        @yield('content')
        @include('admin.template.partials.errors')
    </section>

    <script src="{{asset('plugins/jquery/js/jquery.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('plugins/jquery/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('plugins/jquery/chosen/chosen.proto.js')}}"></script>
    <script src="{{ asset('plugins/jquery/trumbowyg/dist/trumbowyg.js') }}"></script>
    <script src="{{ asset('plugins/jquery/lightbox2-master/dist/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery/gridify/javascript/gridify.js') }}"></script>
</body>
</html>