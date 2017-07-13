@extends('admin.template.main')
@section('title', 'Agregar Artículo')
@section('header', 'Crear Artículo')

@section('content')
    {!! Form::Open(['route' => 'articles.store', 'method' => 'POST', 'files' => true]) !!}
        <div class="row">
            <div class="col-md-1"></div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('title', 'Título') !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'required', 'autofocus', 'placeholder' => 'Título Del Artículo']) !!}

                    <div class="">
                        <span class="label label-danger">{{$errors->first('title')}}</span>
                    </div>
                </div>

                <div class="form-group">
                    {!! form::label('tags', 'Tags') !!}
                    {!! form::select('tags[]', $tags, null, ['class' => 'form-control select-tag', 'multiple']) !!}
                </div>
            </div>

            <div class="col-md-2">
                <output id="list"></output>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('category_id', 'Categoría') !!}
                    {!! Form::select('category_id', $categories, null,
                        ['class' => 'form-control select-category', 'placeholder' => 'Selecciona Una Opción', 'required']) !!}
                </div>

                <div class="form-group">
                    {!! form::label('image', 'Imagen') !!}
                    {!! form::file('image', ['id' => 'files']) !!}

                    <div class="">
                        <span class="label label-danger">{{$errors->first('image')}}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-1"></div>
        </div>

        <div class="row">
            <div class="col-md-1"></div>

            <div class="col-md-10">
                <div class="form-group">
                    {!! form::label('content', 'Contenido') !!}
                    {!! form::textarea('content', null, ['class' => 'form-control txt-content']) !!}

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
                    {!! form::submit('Agregar', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    
    {!! Form::Close() !!}
@endsection


@section('js')
    <script>
        //$(document).ready(function (e) {
         /*   $(".image").customFile({
                type: 'image',
                image: {
                    minSize: [200, 100],
                    maxSize: [1080, 1080]
                },
                multiple: false
            });*/

            $(".select-tag").chosen({
                placeholder_text_multiple: 'Selecciona Un Máximo de 3 Tags',
                max_selected_options: 3,
                search_contains: true,
                no_results_text: 'No hay Coincidencias'
            });

            $(".select-category").chosen();

           /* $(".txt-content").trumbowyg({
                lang: 'es'
            });*/

           $(".txt-content").wysihtml5();


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