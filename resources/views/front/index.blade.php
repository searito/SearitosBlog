@extends('front.main')

@section('content')
    <div class="row">
        <section class="posts col-md-9">
            <div class="migas">
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-home" aria-hidden="true"></i> Home
                    </li>
                </ol>
            </div>

            @foreach($articles as $art)
                <article class="post clearfix post-preview">
                    <a href="{{ route('front.view.article', $art->slug) }}" class="thumb pull-left">
                        @foreach($art->images as $img)
                            <img src="{{ asset('img/articles/'.$img->name) }}" title="{{ $art->title }}" alt="Error" class="img-responsive img-thumbnail margen-right">
                        @endforeach

                    </a>

                    <h2 class="post-title">
                        <a href="{{ route('front.view.article', $art->slug) }}">{{ $art->title }}</a>
                    </h2>

                    <p>
                        <span class="post-fecha text-capitalize">{{ $art->created_at->diffForHumans() }}</span>, Posteado Por:
                        <a href="#" class="lobster"><span class="post-autor">{{ $art->user->nick }}</span></a>
                    </p>

                    <p class="post-contenido text-justify">
                        {!! str_limit($art->content, 300)!!}
                    </p>
                    
                    <div class="contenedor-botones">
                        <a href="{{ route('front.view.article', $art->slug) }}" class="btn btn-primary">
                            <i class="fa fa-eye" aria-hidden="true"></i> Leer Más
                        </a>
                    </div>
                </article>
            @endforeach
        </section>

        <aside class="col-md-3 hidden-xs hidden-sm">
            @include('front.partials.aside')
        </aside>
    </div>

    <div class="row">
        <nav>
            <div class="table-responsive text-center">
                {!! $articles->render() !!}
            </div>
        </nav>
    </div>

    <div class="row">
        @include('front.partials.footer')
    </div>
@endsection