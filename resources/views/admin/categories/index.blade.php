@extends('admin.template.partials.main')
@section('title', 'Categorías')

@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="page-header">
                        <h3 class="text-center text-muted">Módulo Categorías</h3>
                    </div>

                    <button type="button" class="btn btn-primary col-md-offset-1" data-toggle="modal" data-target="#createCategory" title="Crear Categoría">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                    </button>

                    <div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h3 class="modal-title text-center secondary-text" id="myModalLabel">Crear Categoría</h3>
                                </div>

                                <div class="modal-body">
                                    {!! Form::open(['route' => 'categories.store', 'method' => 'POST'])!!}
                                    <div class="form-group">
                                        {!! Form::label('name', 'Nombre: ') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Nombre De La Categoría', 'required']) !!}
                                        <div class="">
                                            <span class="label label-danger">{{$errors->first('name')}}</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::submit('Agregar', ['class' => 'btn btn-primary btn-block']) !!}
                                    </div>
                                    {!! Form::close()!!}
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {!! Form::open(['route' => 'categories.index', 'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}
                    <div class="input-group">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar Categoría', 'aria-describedby' => 'search']) !!}
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
                            <div class="col-md-2 hidden-sm hidden-xs"></div>

                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <table class="table table-fill table-condensed">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="vertical-align: middle">Nombre De Categoría</th>
                                        <th class="text-center" style="vertical-align: middle">Acción</th>
                                    </tr>
                                    </thead>

                                    <tbody class="table-hover">
                                    @foreach($categories as $cat)
                                        <tr>
                                            <td class="text-center" style="vertical-align:middle;">{{$cat->name}}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit{{ $cat->id }}" title="Editar">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </button>

                                                <div class="modal fade" id="modalEdit{{ $cat->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title secondary-text text-center" id="myModalLabel">Editar Categoría {{ $cat->name }}</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! Form::open(['route' => ['categories.update', $cat], 'method' => 'PUT'])!!}
                                                                <div class="form-group">
                                                                    {!! Form::label('name', 'Nombre: ', ['class' => 'pull-left']) !!}
                                                                    {!! Form::text('name', $cat->name, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Nombre De La Categoría', 'required']) !!}
                                                                    <div class="pull-right">
                                                                        <span class="label label-danger">{{$errors->first('name')}}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    {!! Form::submit('Actualizar', ['class' => 'btn btn-primary btn-block']) !!}
                                                                </div>
                                                                {!! Form::close()!!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <a href="{{route('categories.destroy', $cat->id)}}" class="btn btn-danger" title="Eliminar Categoría"
                                                   onclick="return confirm('Deseas Eliminar Esta Categoría?')">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
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
                            {!! $categories->render() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection