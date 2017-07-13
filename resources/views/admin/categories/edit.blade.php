@extends('admin.template.main')
@section('title', 'Editar Categoría '.$category->name)
@section('header', 'Editar Categoría '.$category->name)

@section('content')

    {!! Form::open(['route' => ['categories.update', $category], 'method' => 'PUT'])!!}
    <div class="form-group">
        {!! Form::label('name', 'Nombre: ') !!}
        {!! Form::text('name', $category->name, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Nombre De La Categoría', 'required']) !!}
        <div class="">
            <span class="label label-danger">{{$errors->first('name')}}</span>
        </div>
    </div>

    <div class="form-group">
        {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close()!!}

@endsection