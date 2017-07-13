<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contacto</title>

    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/tuneup.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery/chosen/chosen.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery/trumbowyg/dist/ui/trumbowyg.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

    <link rel="shortcut icon" href="{{asset('img/mikuchibi.png')}}">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text-success">Atención</h3>
                    </div>

                    <div class="panel-body">
                        <h4 class="text-justify text-capitalize">
                           Mensaje Enviado Correctamente...
                        </h4>
                    </div>

                    <div class="panel-footer">
                        <a href="{{ route('contact') }}" class="btn btn-primary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>