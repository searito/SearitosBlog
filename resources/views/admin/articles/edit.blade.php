@extends('admin.template.main')
@section('title', 'Editar Artículos')
@section('header', 'Editar - '.$article->title)

@section('content')
    {!! Form::Open(['route' => ['articles.update', $article], 'method' => 'PUT']) !!}
    <div class="row">
        <div class="col-md-1"></div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('title', 'Título') !!}
                {!! Form::text('title', $article->title, ['class' => 'form-control', 'required', 'autofocus', 'placeholder' => 'Título Del Artículo']) !!}

                <div class="">
                    <span class="label label-danger">{{$errors->first('title')}}</span>
                </div>
            </div>

            <div class="form-group">
                {!! form::label('tags', 'Tags') !!}
                {!! form::select('tags[]', $tags, $myTags, ['class' => 'form-control select-tag', 'multiple']) !!}
            </div>
        </div>

        <div class="col-md-2">
            <output id="list"></output>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('category_id', 'Categoría') !!}
                {!! Form::select('category_id', $categories, $article->category->id,
                    ['class' => 'form-control select-category', 'required']) !!}
            </div>
        </div>

        <div class="col-md-1"></div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>

        <div class="col-md-10">
            <div class="form-group">
                {!! form::label('content', 'Contenido') !!}
                {!! form::textarea('content', $article->content, ['class' => 'form-control txt-content']) !!}

                <div class="">
                    <span class="label label-danger">{{$errors->first('content')}}</span>
                </div>
            </div>
        </div>

        <div class="col-md-1"></div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="form-group">
                {!! form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>

    {!! Form::Close() !!}
@endsection


@section('js')
    <script>
        $(".select-tag").chosen({
            placeholder_text_multiple: 'Selecciona Un Máximo de 3 Tags',
            max_selected_options: 3,
            search_contains: true,
            no_results_text: 'No hay Coincidencias'
        });

        $(".select-category").chosen();

        $(".txt-content").trumbowyg({
            lang: 'es'
        });


        function archivo(evt) {
            var files = evt.target.files; // FileList object

            // Obtenemos la imagen del campo "file".
            for (var i = 0, f; f = files[i]; i++) {
                //Solo admitimos imágenes.
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();

                reader.onload = (function(theFile) {
                    return function(e) {
                        // Insertamos la imagen
                        document.getElementById("list").innerHTML = [
                            '<img class="img-responsive img-thumbnail visual" src="', e.target.result,'" title="', escape(theFile.name), '"/>'
                        ].join('');
                    };
                })(f);

                reader.readAsDataURL(f);
            }
        }

        document.getElementById('files').addEventListener('change', archivo, false);
        // });
    </script>
@endsection