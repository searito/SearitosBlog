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

    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

    <link rel="shortcut icon" href="{{asset('img/mikuchibi.png')}}">
</head>
<body>
    <div class="container-fluid">
        <div class="col-md-2">
            @include('admin.template.partials.nav')
        </div>

        <div class="col-md-10">
            <div class="container">
                <section class="container">
                    <h1 class="text-center text-danger lobster fgrande">Searito's Blog</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="text-center text-danger lobster">@yield('header', 'Home')</h3></div>
                        <div class="panel-body">
                            @include('flash::message')
                            @yield('content')
                            @include('admin.template.partials.errors')
                        </div>
                    </div>
                </section>

                <footer style="margin-top: 1%;">
                    <nav class="navbar navbar-inverse container">
                        <p class="pie">Sear Clímaco &copy; | 2017 </p>
                    </nav>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{asset('plugins/jquery/js/jquery.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('plugins/jquery/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('plugins/jquery/chosen/chosen.proto.js')}}"></script>
    <script src="{{ asset('plugins/jquery/trumbowyg/dist/trumbowyg.js') }}"></script>

    @yield('js')
</body>
</html>
