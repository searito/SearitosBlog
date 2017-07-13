@extends('admin.template.partials.main')
@section('title')
    Home
@endsection

@section('content')
    <div class="container-fluid fblanco">
        <div class="row">
            <h2 class="text-center">Dashboard</h2>
        </div>

        <div class="row profile">
            <div class="col-md-3 col-sm-6">
                <a href="#" class="info-tiles tiles-green has-footer">
                    <div class="tiles-heading">
                        <div class="pull-left">Artículos</div>
                        <div class="pull-right">
                            <div id="tileorders" class="sparkline-block">
                                <canvas width="39" height="13" style="display: inline-block; width: 39px; height: 13px; vertical-align: top;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="tiles-body">
                        <div class="pull-left">
                            <i class="fa fa-newspaper-o fa-3x" aria-hidden="true"></i>
                        </div>
                        <div class="text-center">{{ $articles->count() }}</div>
                    </div>

                    <div class="tiles-footer">
                        <div class="pull-left"></div>
                    </div>
                </a>
            </div>


            <div class="col-md-3 col-sm-6">
                <a href="#" class="info-tiles tiles-blue has-footer">
                    <div class="tiles-heading">
                        <div class="pull-left">Categorías</div>
                        <div class="pull-right">
                            <div id="tileorders" class="sparkline-block">
                                <canvas width="39" height="13" style="display: inline-block; width: 39px; height: 13px; vertical-align: top;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="tiles-body">
                        <div class="pull-left">
                            <i class="fa fa-folder-open-o fa-3x text-white" aria-hidden="true"></i>
                        </div>
                        <div class="text-center">{{ $categories->count() }}</div>
                    </div>

                    <div class="tiles-footer">
                        <div class="pull-left"></div>
                    </div>
                </a>
            </div>


            <div class="col-md-3 col-sm-6">
                <a href="#" class="info-tiles tiles-grape has-footer">
                    <div class="tiles-heading">
                        <div class="pull-left">Tags</div>
                        <div class="pull-right">
                            <div id="tileorders" class="sparkline-block">
                                <canvas width="39" height="13" style="display: inline-block; width: 39px; height: 13px; vertical-align: top;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="tiles-body">
                        <div class="pull-left">
                            <i class="fa fa-tags fa-3x text-white" aria-hidden="true"></i>
                        </div>

                        <div class="text-center">{{ $tags->count() }}</div>
                    </div>

                    <div class="tiles-footer">
                        <div class="pull-left"></div>
                    </div>
                </a>
            </div>


            <div class="col-md-3 col-sm-6">
                <a href="#" class="info-tiles tiles-inverse has-footer">
                    <div class="tiles-heading">
                        <div class="pull-left">Usuarios</div>
                        <div class="pull-right">
                            <div id="tileorders" class="sparkline-block">
                                <canvas width="39" height="13" style="display: inline-block; width: 39px; height: 13px; vertical-align: top;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="tiles-body">
                        <div class="pull-left">
                            <i class="fa fa-users fa-3x text-white" aria-hidden="true"></i>
                        </div>
                        <div class="text-center">{{ Auth::user()->count() }}</div>
                    </div>

                    <div class="tiles-footer">
                        <div class="pull-left"></div>
                    </div>
                </a>
            </div>
        </div>


        <div class="row profile">
            <div class="col-md-6">
                <h3 class="text-center">Últimas Publicaciones</h3>

                <div class="global">
                    <div class="col-md-1"></div>

                    <div class="col-md-11">
                        <dl class="dl-unsul">
                            @foreach($lastfive as $last)
                                <dd>
                                    <h5 class="pull-left secondary-text">{{ $last->title }}</h5>

                                    <p class="small pull-right text-capitalize">
                                        <span class="glyphicon glyphicon-time"></span>
                                        {{ $last->created_at->diffForHumans() }}  Por: {{ $last->user->nick }}
                                    </p>
                                </dd>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <h3 class="text-center"> {{ $activities->count() }} Usuario(s) En Línea</h3>

                <div class="global">
                    <div class="col-md-2"></div>

                    <div class="col-md-9">
                        @foreach($activities as $act)
                            <div class="span12">
                                <ul class="thumbnail">
                                    <div class="span5 clearfix">
                                        <img src="{{ '../'.$act->user->imgprofile}}"
                                             class="img-responsive pull-left span2 clearfix"
                                             style="margin-right: 10px; height: 90px;">

                                        <i class="fa fa-circle pull-right conected-icon" aria-hidden="true"></i>

                                        <div class="caption pull-left">
                                            <h5 class="secondary-text">{{ $act->user->name }}</h5>
                                            <h5 class="">{{ $act->user->email }}</h5>
                                            <small class="text-success">{{ $act->user->type}}</small>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>

                    <div class="col-md-1"></div>
            </div>
        </div>


        <div class="row profile">
            <h3 class="text-center">Gráfica De Pubicaciones "Diarias"</h3>

            <div class="container-fluid" id="poll_div">
                {!! $lava->render('AreaChart', 'Publications', 'poll_div', true) !!}
            </div>
        </div>
    </div>
@endsection