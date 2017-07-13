@extends('admin.template.partials.main')
@section('title', 'Imágenes')

@section('content')
    
    <div class="row">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="page-header">
                        <h3 class="text-center text-muted">Galería De Imágenes</h3>
                    </div>

                    <div class="row">
                        <div class="container grid">
                            @foreach($images as $img)
                                 <a class="" href="../img/articles/{{ $img->name }}" data-lightbox="example-set" data-title="{{ $img->article->title }}">
                                    <img class="img-responsive img-thumbnail" src="../img/articles/{{ $img->name }}"/>
                                 </a>
                            @endforeach
                        </div>            
                    </div>

                    <div class="row">
                        <div class="table-responsive text-center">
                            {!! $images->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        /*$(window).load(function() {
            var options =
                {
                    srcNode: 'img',             // grid items (class, node)
                    margin: '20px',             // margin in pixel, default: 0px
                    width: '250px',             // grid item width in pixel, default: 220px
                    max_width: '',              // dynamic gird item width if specified, (pixel)
                    resizable: true,           // re-layout if window resize
                    transition: 'all 0.5s ease' // support transition for CSS3, default: all 0.5s ease
                }
            $('.grid').gridify(options);
        });*/

        window.onload = function(){
            var options =
                {
                    srcNode: 'img',             // grid items (class, node)
                    margin: '20px',             // margin in pixel, default: 0px
                    width: '250px',             // grid item width in pixel, default: 220px
                    max_width: '',              // dynamic gird item width if specified, (pixel)
                    resizable: true,            // re-layout if window resize
                    transition: 'all 0.5s ease' // support transition for CSS3, default: all 0.5s ease
                }
            document.querySelector('.grid').gridify(options);
        }
    </script>
@endsection