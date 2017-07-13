<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <h1 class="text-muted text-center lobster">Searito's Blog</h1>
                <div class="profile-userpic avatarmdm" style="background-image: url({{ '../' .Auth::user()->imgprofile }})">
                </div>

                <div class="profile-usertitle">
                    <div class="profile-usertitle-name text-capitalize">
                        {{ Auth::user()->nick }}
                    </div>

                    <div class="profile-usertitle-job text-capitalize">
                        {{ Auth::user()->type }}
                    </div>
                </div>

                <div class="profile-userbuttons">
                    <a href="{{ route('admin.profile') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-user-circle" aria-hidden="true"></i> Mi Perfil
                    </a>

                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        Salir
                    </a>
                </div>

                <div class="profile-usermenu">
                    <ul class="nav">
                        @if(Auth::user()->type == 'admin')
                            <li class="active">
                                <a href="{{ route('admin.home') }}">
                                    <i class="fa fa-home" aria-hidden="true"></i> Home
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ route('front.index') }}" target="_blank">
                                <i class="fa fa-book" aria-hidden="true"></i> Página Principal
                            </a>
                        </li>

                        @if(Auth::user()->admin())
                            <li>
                                <a href="{{ route('users.index') }}">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    Usuarios
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ route('categories.index') }}">
                                <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                Categorías
                            </a>
                        </li>

                        <li>
                            <a href="{{  route('articles.index') }}">
                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                Artículos
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('images.index') }}">
                                <i class="fa fa-camera-retro" aria-hidden="true"></i>
                                Imágenes
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('tags.index') }}">
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                Tags
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('contact') }}">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                Contacto
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>