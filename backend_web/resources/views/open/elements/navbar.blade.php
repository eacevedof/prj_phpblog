<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-opentop" aria-controls="nav-opentop" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-opentop">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ $catslug=="home" ? "active" : "" }}" href="{{ route('open.home.index') }}">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $catslug=="blog" ? "active" : "" }}" href="{{ route('open.blog.index') }}">
                        Blog
                    </a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('open.home.aboutme') }}">Sobre mí</a>
                </li>
                -->
                @include("open.elements.submenublog")
                @include("open.elements.submenuservice")
                <li class="nav-item">
                    <a class="nav-link {{ $catslug=="contact" ? "active" : "" }}" href="{{ route('open.home.contact') }}">Contacto</a>
                </li>
                @if(env("APP_ENV")==="test" || env("APP_ENV")==="local")
                    <li class="nav-item">
                        <a class="nav-link" href="/idiomas">
                            App Idiomas
                        </a>
                    </li>
                @endif
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="nav-admin" role="button" data-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="nav-admin">
                        <a class="dropdown-item" href="/adm">Admin</a>
                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                        <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                    </ul>
                </li>
                @endauth
            </ul>
            @include("open.forms.form-search")
        </div>
    </div>
</nav>
