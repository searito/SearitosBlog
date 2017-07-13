<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Permisos Insuficientes</title>

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/tuneup.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.css') }}">

    <link rel="shortcut icon" href="{{asset('img/mikuchibi.png')}}">
</head>
<body>
    <div class="content cajaUp">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-danger">
                <div class="panel-heading text-center">
                    <h3 class="">
                        <i class="fa fa-hand-stop-o"></i>
                            Acceso Restringido
                        <i class="fa fa-hand-stop-o"></i>
                    </h3>
                </div>

                <div class="panel-body">
                    <img src="{{ asset('img/restricted.jpg') }}" alt="Error" class="img-responsive center-block">
                    <hr>

                    <strong class="text-center">
                        <p class="text-center">
                            Ud No Posee Permisos Necesarios Para Acceder A Esta Area...
                        </p>

                        <p>
                            <a href="{{ route('front.index') }}" class="btn btn-link">
                                <i class="fa fa-undo"></i>
                                Volver A Inicio
                            </a>
                        </p>
                    </strong>
                </div>
            </div>
        </div>
    </div>
</body>
</html>