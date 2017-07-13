@extends('front.main')
@section('frontitle', 'Ver Artículo')

@section('content')
    <div class="col-md-8">
        @foreach($content as $c)
            <div class="jumbotron">
                <h3 class="text-center">
                    {{ $c->title }}
                    <small><br>Creado Por: {{ $c->nick }}</small>
                </h3>
            </div>

            <div class="jumbotron">
                <div class="container-fluid">
                    <div class="col-md-8">
                        <div class="text-justify">
                             {{ $c->content }}
                         </div>
                     </div>

                     <div class="col-md-4">
                         <img src="../img/articles/{{ $c->name }}" title="{{ $c->title }}" class="img-responsive img-thumbnail">
                     </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="col-md-4">
        @include('front.partials.aside')
    </div>
@endsection