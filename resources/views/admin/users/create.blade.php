@extends('admin.template.main')
@section('title', 'Crear Usuarios')
@section('header', 'Registrar Usuario')

@section('content')


    <!-- CREAR FORMULARIO CON LARAVEL COLLECTIVE, EQUIVALENTE A ETIQUETAS ?php, NO DEVUELVE NADA A PANTALLA-->

    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                {!! Form::label('name', 'Nombre:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Nombre Acá']) !!}
                <div class="col-md-offset-1">
                    <span class="label label-danger">{{$errors->first('name')}}</span>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Contraseña:') !!}
                {!! Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => '********']) !!}
                <div class="col-md-offset-1">
                    <span class="label label-danger">{{$errors->first('password')}}</span>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('nick', 'Nickname:') !!}
                {!! Form::text('nick', null, ['class' => 'form-control', 'placeholder' => 'Alias']) !!}
                <div class="col-md-offset-1">
                    <span class="label label-danger">{{$errors->first('nick')}}</span>
                </div>
            </div>
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-5">
            <div class="form-group">
                {!! Form::label('email', 'Correo Electrónico:') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'yo@mi.com']) !!}
                <div class="col-md-offset-1">
                    <span class="label label-danger">{{$errors->first('email')}}</span>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('type', 'Tipo De Usuario') !!}
                {!! Form::select('type', ['' => 'Selecciona Un Nivel', 'member' => 'Usuario Normal', 'admin' => 'Administrador'], null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-5"></div>

        <div class="col-xs-12 col-md-2">
            <div class="form-group">
                {!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-md-5"></div>
    </div>

    {!! Form::close() !!}

@endsection