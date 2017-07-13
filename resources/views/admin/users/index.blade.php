@extends('admin.template.partials.main')
@section('title', 'Lista De Usuarios')

@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="page-header">
                        <h3 class="text-center text-muted">Módulo Usuarios</h3>
                    </div>

                    <!-------------------------------- PROBANDO MODALES ----------------------------------------------->
                    <button type="button" class="btn btn-primary col-md-offset-1" data-toggle="modal" data-target="#createUser" title="Agregar Usuario">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </button>


                    <!-- Modal -->
                    <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h3 class="modal-title text-center secondary-text" id="myModalLabel">Crear Usuario</h3>
                                </div>

                                <div class="modal-body">
                                    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
                                        <div class="form-group">
                                            {!! Form::label('name', 'Nombre:') !!}
                                            {!! Form::text('name', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Raúl Álvarez']) !!}
                                            <div class="pull-right">
                                                <span class="label label-danger">{{$errors->first('name')}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('password', 'Contraseña:') !!}
                                            {!! Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => '********']) !!}
                                            <div class="pull-right">
                                                <span class="label label-danger">{{$errors->first('password')}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('nick', 'Nickname:') !!}
                                            {!! Form::text('nick', null, ['class' => 'form-control', 'placeholder' => 'AuronPlay']) !!}
                                            <div class="pull-right">
                                                <span class="label label-danger">{{$errors->first('nick')}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('email', 'Correo Electrónico:') !!}
                                            {!! Form::text('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'auronplay@gmail.com']) !!}
                                            <div class="pull-right">
                                                <span class="label label-danger">{{$errors->first('email')}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('type', 'Tipo De Usuario') !!}
                                            {!! Form::select('type', ['' => 'Selecciona Un Nivel', 'member' => 'Usuario Normal', 'admin' => 'Administrador'], null, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::submit('Registrar', ['class' => 'btn btn-primary btn-block']) !!}
                                        </div>
                                    {!! Form::close() !!}
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-------------------------------- FIN PROBANDO MODALES ------------------------------------------->

                    {!! Form::open(['route' => 'users.index', 'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}
                    <div class="input-group">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar Usuario', 'aria-describedby' => 'search']) !!}
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
                            <div class="col-md-1 hidden-sm hidden-xs"></div>

                            <div class="col-md-10 col-sm-12 col-xs-12">
                                <table class="table table-fill table-condensed">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="vertical-align: middle">Imagen</th>
                                            <th class="text-center" style="vertical-align: middle">Nombre</th>
                                            <th class="text-center" style="vertical-align: middle">Nickname</th>
                                            <th class="text-center" style="vertical-align: middle">Email</th>
                                            <th class="text-center" style="vertical-align: middle">Rol</th>
                                            <th class="text-center" style="vertical-align: middle">Acción</th>
                                        </tr>

                                        <tbody class="table-hover">
                                            @foreach($users as $user)
                                                <tr>
                                                    <td class="text-center">
                                                        <img src="{{url($user->imgprofile)}}" class="img-responsive img-thumbnail" width="40" height="70">
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle"> {{ $user->name }} </td>
                                                    <td class="text-center" style="vertical-align: middle">{{ $user->nick }}</td>
                                                    <td class="text-center" style="vertical-align: middle"> {{ $user->email }} </td>
                                                    <td class="text-center" style="vertical-align: middle">
                                                        @if($user->type =='admin' )
                                                            <span class="label label-success">{{ $user->type }}</span>
                                                        @else
                                                            <span class="label label-primary">{{ $user->type }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle">
                                                        <!--a href="{{route('users.edit', $user->id)}}" class="btn btn-primary" title="Actualizar">
                                                            <span class="glyphicon glyphicon-refresh"></span>
                                                        </a-->

                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit{{ $user->id }}" title="Editar">
                                                             <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </button>

                                                        <div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title secondary-text" id="myModalLabel">
                                                                            Datos Personales De {{ $user->nick }}
                                                                        </h4>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        {!! Form::Open(['route' => ['users.update',$user->id], 'method' => 'PUT', 'files' => true]) !!}
                                                                            <div class="container-fluid">
                                                                                <div class="col-md-5 col-sm-6 col-xs-6">
                                                                                    <img src="{{url($user->imgprofile)}}" class="img-thumbnail img-responsive pull-left" alt="La Cagamos">
                                                                                </div>

                                                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                                                    <div class="form-group">
                                                                                        {!! Form::label('name', 'Nombre:', ['class' => 'pull-left']) !!}
                                                                                        {!! Form::text('name', $user->name, ['class' => 'form-control', 'required']) !!}
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        {!! Form::label('nick', 'Nickname:', ['class' => 'pull-left']) !!}
                                                                                        {!! Form::text('nick', $user->nick, ['class' => 'form-control', 'placeholder' => 'Alias']) !!}
                                                                                        <div class="pull-right">
                                                                                            <span class="label label-danger">{{$errors->first('nick')}}</span>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        {!! Form::label('email', 'Correo Electrónico:', ['class' => 'pull-left']) !!}
                                                                                        {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        {!! Form::label('type', 'Tipo De Usuario', ['class' => 'pull-left']) !!}
                                                                                        {!! Form::select('type', ['member' => 'Miembro', 'admin' => 'Administrador'], $user->type,
                                                                                            ['class' => 'form-control']) !!}
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        {!! Form::label('image', 'Actualizar Imagen', ['class' => 'pull-left']) !!}
                                                                                        {!! Form::file('image') !!}
                                                                                        <div class="pull-right">
                                                                                            <span class="label label-danger">{{$errors->first('image')}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="form-group">
                                                                                        {!! Form::submit('Actualizar', ['class' => 'btn btn-primary btn-block']) !!}
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        {!! Form::Close() !!}
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <a href="{{route('users.destroy', $user->id)}}" class="btn btn-danger" title="Eliminar"
                                                           onclick="return confirm('Deseas Eliminar Este Usuario?')">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </thead>
                                </table>
                            </div>

                            <div class="col-md-1 hidden-sm hidden-xs"></div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="table-responsive text-center">
                            {!! $users->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
