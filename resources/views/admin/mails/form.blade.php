@extends('admin.template.partials.main')
@section('title', 'Contacto')

@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="page-header">
                        <h3 class="text-center text-muted">Contacta Con Admins</h3>
                    </div>

                    <div class="row">
                        <div class="container">
                            {!! Form::Open(['route' => 'send', 'method' => 'POST']) !!}

                                <div class="row">
                                    <div class="col-md-6 col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            {!! form::label('email', 'Correo Electrónico') !!}
                                            {!! form::email('email', null, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! form::label('subject', 'Asunto') !!}
                                            {!! form::text('subject', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        {!! form::label('body', 'Mensaje') !!}
                                        {!! form::textarea('body', null, ['class' => 'form-control contenido']) !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        {!! form::submit('Enviar', ['class' => 'btn btn-primary btn-lg']) !!}
                                    </div>
                                </div>
                            {!! Form::Close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(".contenido").trumbowyg({
            lang: 'es'
        });
    </script>
@endsection