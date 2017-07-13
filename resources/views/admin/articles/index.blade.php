@extends('admin.template.partials.main')
@section('title', 'Artículos')
@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="page-header">
                        <h3 class="text-center text-muted">Módulo Artículos</h3>
                    </div>

                    <button type="button" class="btn btn-primary col-md-offset-1" data-toggle="modal" data-target="#createArticle" title="Crear Artículo">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </button>

                    <div class="modal fade" id="createArticle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-center secondary-text" id="myModalLabel">Crear Artículo</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        {!! Form::Open(['route' => 'articles.store', 'method' => 'POST', 'files' => true]) !!}
                                            <div class="form-group">
                                                {!! Form::label('title', 'Título', ['class' => 'pull-left']) !!}
                                                {!! Form::text('title', null, ['class' => 'form-control', 'required', 'autofocus', 'placeholder' => 'Título Del Artículo']) !!}

                                                <div class="pull-right">
                                                    <span class="label label-danger">{{$errors->first('title')}}</span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="form-group">
                                                        {!! form::label('tags', 'Tags '.'&nbsp;', ['class' => 'pull-left']) !!}
                                                        {!! form::select('tags[]', $tags, $myTags, ['class' => 'form-control select-tag', 'multiple']) !!}
                                                    </div>

                                                    <div class="form-group">
                                                        {!! Form::label('category_id', 'Categoría'.'&nbsp;', ['class' => 'pull-left']) !!}
                                                        {!! Form::select('category_id', $categories, null,
                                                            ['class' => 'form-control select-category', 'placeholder' => 'Selecciona Una Opción', 'required']) !!}
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-xs-6 col-sm-6">
                                                    <div id="list"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                {!! form::label('image', 'Imagen'.'&nbsp;', ['class' => 'pull-left']) !!}
                                                {!! form::file('image', ['id' => 'files']) !!}

                                                <div class="pull-right">
                                                    <span class="label label-danger">{{$errors->first('image')}}</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                {!! form::textarea('content', null, ['class' => 'form-control txt-content']) !!}

                                                <div class="">
                                                    <span class="label label-danger">{{$errors->first('content')}}</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                {!! form::submit('Crear', ['class' => 'btn btn-primary btn-block']) !!}
                                            </div>
                                        {!! Form::Close() !!}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!------------------------------------------------------- BUSCADOR -------------------------------->

                    {!! Form::open(['route' => 'articles.index', 'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}
                    <div class="input-group">
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Buscar Un Artículo', 'aria-describedby' => 'search']) !!}
                        <span class="input-group-addon" id="search">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </span>
                    </div>
                    {!! Form::close() !!}

                    <div class="row">
                        <p>&nbsp;</p><br>
                    </div>


                    <div class="row">
                        <div class="table-responsive">
                            <div class="col-md-1 hidden-xs hidden-sm"></div>

                            <div class="col-md-10 col-sm-12 col-xs-12">
                                @if(Auth::user()->admin())
                                <table class="table table-fill table-condensed">
                                    <theah>
                                        <th class="text-center" style="vertical-align: middle">Título</th>
                                        <th class="text-center" style="vertical-align: middle">Categoría</th>
                                        <th class="text-center" style="vertical-align: middle">Posteado Por</th>
                                        <th class="text-center" style="vertical-align: middle">Fecha / Hora</th>
                                        <th class="text-center" style="vertical-align: middle">Acción</th>
                                    </theah>
                                    <tbody>
                                    @foreach($articles as $art)
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle;">
                                                {{ $art->title }}
                                            </td>

                                            <td class="text-center" style="vertical-align: middle;">
                                                {{ $art->category->name }}
                                            </td>

                                            <td class="text-center" style="vertical-align: middle;">
                                                {{ $art->user->nick }}
                                            </td>

                                            <td class="text-center" style="vertical-align: middle;">
                                                {{ $art->created_at }}
                                            </td>

                                            <td class="text-center" style="vertical-align: middle;">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit{{ $art->id }}" title="Editar">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </button>

                                                <a href="{{route('articles.destroy', $art->id)}}" class="btn btn-danger" title="Eliminar Artículo"
                                                   onclick="return confirm('Deseas Eliminar Este Artículo?')">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>


                                                <!----------------- MODAL EDIT ---------------------------------------->

                                                <div class="modal fade" id="modalEdit{{ $art->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title text-center secondary-text" id="myModalLabel">
                                                                    Editar Artículo De {{ $art->user->nick }}
                                                                </h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! Form::Open(['route' => ['articles.update', $art], 'method' => 'PUT']) !!}
                                                                    <div class="form-group">
                                                                        {!! Form::label('title', 'Título', ['class' => 'pull-left']) !!}
                                                                        {!! Form::text('title', $art->title, ['class' => 'form-control', 'required', 'autofocus', 'placeholder' => 'Título Del Artículo']) !!}

                                                                        <div class="pull-right">
                                                                            <span class="label label-danger">{{$errors->first('title')}}</span>
                                                                        </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="form-group">
                                                                            {!! form::label('tags', 'Tags', ['class' => 'pull-left']) !!}
                                                                            {!! form::select('tags[]', $tags, $myTags, ['class' => 'form-control select-tag', 'multiple']) !!}
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                                                        <div class="form-group">
                                                                            {!! Form::label('category_id', 'Categoría', ['class' => 'pull-left']) !!}
                                                                            {!! Form::select('category_id', $categories, $art->category->id,
                                                                                ['class' => 'form-control select-category', 'required']) !!}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group pull-left text-left">
                                                                    {!! form::textarea('content', $art->content, ['class' => 'form-control txt-content']) !!}
                                                                    <div class="pull-right">
                                                                        <span class="label label-danger">{{$errors->first('content')}}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    {!! form::submit('Actualizar', ['class' => 'btn btn-primary btn-block']) !!}
                                                                </div>
                                                                {!! Form::Close() !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="table-responsive text-center">
                            {!! $articles->render() !!}
                        </div>
                    </div>

                    @else
                        <div class="row">
                            <div class="table-responsive">
                                <div class="col-md-1 hidden-sm hidden-xs"></div>

                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <table class="table table-fill table-condensed">
                                        <thead>
                                            <th class="text-center" style="vertical-align: middle">Título</th>
                                            <th class="text-center" style="vertical-align: middle">Categoría</th>
                                            <th class="text-center" style="vertical-align: middle">Fecha / Hora</th>
                                            <th class="text-center" style="vertical-align: middle">Acción</th>
                                        </thead>
                                        <tbody>
                                            @foreach($userPost as $up)
                                                <tr>
                                                    <td class="text-center" style="vertical-align: middle;">
                                                        {{ $up->title }}
                                                    </td>

                                                    <td class="text-center" style="vertical-align: middle;">
                                                        {{ $up->name }}
                                                    </td>

                                                    <td class="text-center" style="vertical-align: middle;">
                                                        {{ $up->created_at }}
                                                    </td>

                                                    <td class="text-center" style="vertical-align: middle;">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditBy{{ $up->id }}" title="Editar">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </button>

                                                        <a href="{{route('articles.destroy', $up->id)}}" class="btn btn-danger" title="Eliminar Artículo"
                                                           onclick="return confirm('Deseas Eliminar Este Artículo?')">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </a>

                                                    <!-------------------------- MODAL EDITAR ------------------------------------------>
                                                        <div class="modal fade" id="modalEditBy{{ $up->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title secondary-text text-center" id="myModalLabel">Editar Publicación</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        {!! Form::Open(['route' => ['articles.update', $up->id], 'method' => 'PUT']) !!}
                                                                        <div class="form-group">
                                                                            {!! Form::label('title', 'Título', ['class' => 'pull-left']) !!}
                                                                            {!! Form::text('title', $up->title, ['class' => 'form-control', 'required', 'autofocus', 'placeholder' => 'Título Del Artículo']) !!}

                                                                            <div class="pull-right">
                                                                                <span class="label label-danger">{{$errors->first('title')}}</span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    {!! form::label('tags', 'Tags', ['class' => 'pull-left']) !!}
                                                                                    {!! form::select('tags[]', $tags, $myTags, ['class' => 'form-control select-tag', 'multiple']) !!}
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    {!! Form::label('category_id', 'Categoría', ['class' => 'pull-left']) !!}
                                                                                    {!! Form::select('category_id', $categories, $up->category_id,
                                                                                        ['class' => 'form-control select-category', 'required']) !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group pull-left text-left">
                                                                            {!! form::textarea('content', $up->content, ['class' => 'form-control txt-content']) !!}
                                                                            <div class="pull-right">
                                                                                <span class="label label-danger">{{$errors->first('content')}}</span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            {!! form::submit('Actualizar', ['class' => 'btn btn-primary btn-block']) !!}
                                                                        </div>
                                                                        {!! Form::Close() !!}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="table-responsive text-center">
                                {!! $userPost->render() !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(".select-tag").chosen({
            width:250,
            placeholder_text_multiple: 'Selecciona Un Máximo de 3 Tags',
            max_selected_options: 3,
            search_contains: true,
            no_results_text: 'No hay Coincidencias',
        });

        $(".select-category").chosen({
            width: 250
        });

        $(".txt-content").trumbowyg();

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
                            '<img class="img-responsive img-thumbnail modal-img pull-right" src="', e.target.result,'" title="', escape(theFile.name), '"/>'
                        ].join('');
                    };
                })(f);

                reader.readAsDataURL(f);
            }
        }

        document.getElementById('files').addEventListener('change', archivo, false);

    </script>
@endsection