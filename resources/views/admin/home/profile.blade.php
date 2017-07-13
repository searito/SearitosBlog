@extends('admin.template.partials.main')
@section('title', 'Mi Perfil')

@section('content')
    <div class="mainbody container-fluid">
        <div class="col-md-3 hidden-sm hidden-xs">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media">
                        <div align="center">
                            <img src="{{ '../'. $user->imgprofile }}" title="{{ $user->name }}" class="thumbnail img-responsive">
                        </div>

                        <div class="media-body">
                            <h3 class="text-center"><b>Datos Personales</b></h3>

                            <p>
                                <h4 class="text-left">Nombre: </h4>
                                <span class="secondary-text">{{ $user->name }}</span>
                            </p>

                            <p>
                                <h4 class="text-left">Nickname:</h4>
                                <span class="secondary-text">{{ $user->nick }}</span>
                            </p>

                            <p>
                                <h4 class="text-left">Email:</h4>
                                <span class="secondary-text">{{ $user->email }}</span>
                            </p>

                            <p>
                                <h4 class="text-left">Rol:</h4>
                                <span class="secondary-text text-capitalize">{{ $user->type }}</span>
                            </p>

                            <p>
                                <h4 class="text-left">Miembro Desde:</h4>
                                <span class="secondary-text text-capitalize">{{ $memberSince }} ({{ $user->created_at->diffForHumans() }})</span>
                            </p>
                            <hr>
                                <div class="row">
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalInfo">
                                        <i class="fa fa-edit" aria-hidden="true"> </i>
                                        Act. Mis Datos
                                    </button>
                                </div>

                                <div class="row">
                                    &nbsp;
                                </div>

                                <div class="row">
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalPass">
                                        <i class="fa fa-refresh" aria-hidden="true"> </i>
                                        Camb. Contraseña
                                    </button>
                                </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">


                    <!----------------------------- PRUEBA DEL FONDO -------------------------------------------------->
                    <div class="hidden-lg hidden-md col-xs-12 col-sm-12">
                        <nav class="navbar">
                            <div class="container-fluid">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="pull-left">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalInfo" title="Editar Mi Información">
                                            <i class="fa fa-edit" aria-hidden="true"> </i>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </button>&nbsp;
                                    </div>

                                    <div class="pull-left">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPass" title="Cambiar Contraseña">
                                            <i class="fa fa-refresh" aria-hidden="true"> </i>
                                            <i class="fa fa-key" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <!----------------------------- FIN PRUEBA DEL FONDO ---------------------------------------------->


                    <h2 class="text-center secondary-text">Mis Publicaciones</h2>
                    
                    <div class="col-sm-1"></div>

                    <div class="col-md-8 col-sm-8 col-sm-offset-1">
                        <div class="panel-group" id="acordeon">
                            <div class="modal fade">{!! $contador = 1 !!}</div>
                            @foreach($publications as $notas)
                                <div class="modal fade">{!! $contador ++ !!}</div>
                                <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#contenido{{ $contador }}" data-toggle="collapse" data-parent="#acordeon">
                                            {{ $notas->title }} <i class="fa fa-plus more-less" aria-hidden="true"></i>
                                        </a>
                                 </h4>
                                </div>

                                <div class="panel-collapse collapse" id="contenido{{ $contador }}">
                                    <div class="panel-body">
                                        <p>{!! $notas->content !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-------------------   MODAL PERFIL        ----------------------------------------------->

            <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfoLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" type="button" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="modalInfoLabel">Datos Personales</h4>
                        </div>

                        <div class="modal-body">
                            {!! Form::open(['route' => ['admin.infoupdate', Auth::user()->id], 'method' => 'POST', 'files' => true]) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Nombre') !!}
                                {!! Form::text('name', $user->name, ['class' =>'form-control', ]) !!}

                                <div class="pull-right">
                                    <span class="label label-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'Correo Electrónico') !!}
                                {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}

                                <div class="pull-right">
                                    <span class="label label-danger">{{$errors->first('email')}}</span>
                                </div>
                            </div>

                            @if(Auth::user()->type == 'admin')
                                <div class="form-group">
                                    {!! Form::label('type', 'Rol') !!}
                                    {!! Form::select('type', ['member' => 'Miembro', 'admin' => 'Administrador'], $user->type,
                                        ['class' => 'form-control']) !!}
                                </div>
                            @endif

                            <div class="form-group">
                                {!! Form::label('nick', 'Sobrenombre') !!}
                                {!! Form::text('nick', $user->nick, ['class' => 'form-control']) !!}

                                <div class="pull-right">
                                    <span class="label label-danger">{{$errors->first('nick')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('image', 'Actualizar Imagen') !!}
                                {!! Form::file('image') !!}

                                <div class="pull-right">
                                    <span class="label label-danger">{{$errors->first('image')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! form::submit('Actualizar', ['class' => 'btn btn-primary btn-block']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!----------------------------     MODAL PASSWORD  ---------------------------------------->

            <div class="modal fade" id="modalPass" tabindex="-1" role="dialog" aria-labelledby="modalPassLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" type="button" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="modalPassLabel">Cambiar Contraseña</h4>
                        </div>

                        <div class="modal-body">
                            {!! Form::open(['route' => ['admin.passupdate', Auth::user()->id], 'method' => 'POST']) !!}
                            <div class="form-group">
                                {!! Form::label('oldpass', 'Contraseña Actual') !!}
                                {!! Form::password('oldpass', ['class' => 'form-control', 'autofocus', 'required']) !!}

                                <div class="pull-right">
                                    <span class="label label-danger">{{$errors->first('oldpass')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('newpass1', 'Contraseña Nueva') !!}
                                {!! Form::password('password', ['class' => 'form-control', 'required']) !!}

                                <div class="pull-right">
                                    <span class="label label-danger">{{$errors->first('password')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('newpass2', 'Confirmar Contraseña') !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}

                                <div class="pull-right">
                                    <span class="label label-danger">{{$errors->first('password_confirmation')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! form::submit('Actualizar', ['class' => 'btn btn-primary btn-block']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

