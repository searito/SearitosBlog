@extends('front.main')
@section('frontitle', $article->title)

@section('content')
    <div class="row">
        <section class="posts col-md-9">
            <div class="migas">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                        {{ $article->title }}
                    </li>
                </ol>
            </div>

            <div class="row">
                <div class="col-md-2 hidden-xs">
                    <div class="avatar" style="background-image: url({{ '../'.$article->user->imgprofile }})">
                    </div>
                </div>

                <div class="col-md-10 col-xs-12">
                    <h3 class="text-center text-primary">
                        {{ $article->title }}<br>
                        <small> Enviado Por: {{ $article->user->nick }}</small>
                    </h3><br><br>
                </div>
            </div>

            <div class="row">
                <article class="post clearfix">
                    <div class="col-md-4">
                        @foreach($article->images as $img)
                            <a class="" href="../img/articles/{{ $img->name }}" data-lightbox="example-set" data-title="{{ $img->article->title }}">
                                <img class="img-responsive img-thumbnail" src="../img/articles/{{ $img->name }}"/>
                            </a>
                        @endforeach
                    </div>

                    <div class="col-md-8 text-justify vcenter">
                        {!! $article->content !!}
                    </div>
                </article>
            </div>


            <div class="row">
                <div class="col-md-12">
                    @foreach($article->tags as $tag)
                        <span class="label label-primary">
                            <i class="fa fa-tag"> </i> {{ $tag->name }}
                        </span>
                    @endforeach


                    <h3 class="">Comentarios</h3>

                    <div id="disqus_thread"></div>
                    <script>

                        /**
                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                        /*
                         var disqus_config = function () {
                         this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                         this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                         };
                         */
                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = 'https://searitos-blog.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                </div>
            </div>
        </section>

        <aside class="col-md-3 hidden-xs hidden-sm">
            @include('front.partials.aside')
        </aside>
    </div>

    <div class="row">
        @include('front.partials.footer')
    </div>
@endsection

@section('js')
@endsection