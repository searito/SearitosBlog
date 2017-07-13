@extends('admin.template.main')
@section('title', 'Crear Tag')
@section('header', 'Crear Tag')
@section('content')

    {!! Form::open(['route' => 'tags.store', 'method' => 'POST']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre Del Tag', 'autofocus', 'required']) !!}

            <div class="">
                <span class="label label-danger">{{$errors->first('name')}}</span>
            </div>
        </div>

    <div class="form-group">
        {!! Form::submit('Almacenar', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@endsection