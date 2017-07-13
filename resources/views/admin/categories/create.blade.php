@extends('admin.template.main')
@section('title', 'Agregar Categoría')
@section('header', 'Crear Catagoría')

@section('content')

    {!! Form::open(['route' => 'categories.store', 'method' => 'POST'])!!}
        <div class="form-group">
            {!! Form::label('name', 'Nombre: ') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Nombre De La Categoría', 'required']) !!}
            <div class="">
                <span class="label label-danger">{{$errors->first('name')}}</span>
            </div>
        </div>

        <div class="form-group">
            {!! Form::submit('Agregar', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close()!!}

@endsection