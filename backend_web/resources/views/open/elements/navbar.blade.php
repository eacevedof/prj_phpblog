<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('open.home') }}">Eduardo A. F.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('open.home.aboutme') }}">Sobre mí</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('open.home.contact') }}">Contacto</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        Blog
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/blog/php/">php</a>
                        <a class="dropdown-item" href="/blog/js">js</a>
                        <a class="dropdown-item" href="/blog/sql">sql</a>
                        <a class="dropdown-item" href="/blog/python">python</a>
                    </ul>
                </li>
                @if (env('APP_ENV')!='production')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="nav-admin" role="button" data-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="nav-admin">
                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                        <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                    </ul>
                </li>
                @endif
            </ul>
            @include("open/forms/form-search")
        </div>
    </div>
</nav>
