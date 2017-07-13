@extends('admin.template.main')
@section('title', 'Actualizar Información')
@section('header', 'Actualizar Datos De '. $users->name)

@section('content')

    <!-- CREAR FORMULARIO CON LARAVEL COLLECTIVE, EQUIVALENTE A ETIQUETAS ?php, NO DEVUELVE NADA A PANTALLA-->

    {!! Form::open(['route' => ['users.update',$users->id], 'method' => 'PUT', 'files' => true]) !!}
    <div class="row">
        <div class="col-md-5">
            <img src="{{url($users->imgprofile)}}" class="img-thumbnail img-responsive pull-right" alt="La Cagamos" height="507" width="370">
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-5">
            <div class="form-group">
                {!! Form::label('name', 'Nombre:') !!}
                {!! Form::text('name', $users->name, ['class' => 'form-control', 'required', 'autofocus', 'placeholder' => 'Nombre Acá']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('nick', 'Nickname:') !!}
                {!! Form::text('nick', $users->nick, ['class' => 'form-control', 'placeholder' => 'Alias']) !!}
                <div class="col-md-offset-1">
                    <span class="label label-danger">{{$errors->first('nick')}}</span>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Correo Electrónico:') !!}
                {!! Form::text('email', $users->email, ['class' => 'form-control', 'required', 'placeholder' => 'yo@mi.com']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('type', 'Tipo De Usuario') !!}
                {!! Form::select('type', ['member' => 'Miembro', 'admin' => 'Administrador'], $users->type,
                    ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Actualizar Imagen') !!}
                {!! Form::file('image') !!}
                <div class="">
                    <span class="label label-danger">{{$errors->first('image')}}</span>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-md-5"></div>

        <div class="col-xs-12 col-md-2">
            <div class="form-group">
                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-md-5"></div>
    </div>

    {!! Form::close() !!}

@endsection